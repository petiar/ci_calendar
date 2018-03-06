<?php
/**
 * Created by PhpStorm.
 * User: petiar
 * Date: 03/03/2018
 * Time: 01:06
 */

class Events extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if ($this->input->get('username')) {
      // lets sanitize the user input
      $username = $this->input->get('username', TRUE);
      $this->session->set_userdata(array('username' => $username));
    }
    if ($this->input->post('logout')) {
      $this->session->unset_userdata('username');
    }
  }

  public function index() {
    $this->load->library('googlecalendar');
    $this->load->model('rsvp_model');

    $data['view'] = 'events';
    $data['title'] = 'List of events';
    $data['data']['events'] = $this->googlecalendar->getEvents();
    $this->load->view('master', $data);
  }

  public function show($eventid) {
    $this->load->library('googlecalendar');
    $this->load->helper('date');
    $this->load->model('rsvp_model');

    $data['view'] = 'event';
    $event = $this->googlecalendar->getEvent($eventid);

    $data['data']['event'] = $event;
    $data['data']['rsvp'] = $this->rsvp_model->list_for_event($eventid);

    $data['title'] = $event['summary'];
    $this->load->view('master', $data);
  }

  public function subscribe($eventid, $id = NULL) {
    $this->load->library('googlecalendar');
    $this->load->library('form_validation');
    $this->load->helper('date');
    $this->load->model('rsvp_model');

    if (!$this->session->userdata('username')) {
      redirect('events');
    }

    if ($id) {
      if ($this->rsvp_model->can_edit($id)) {
        $stored_data = $this->rsvp_model->get($id);
        foreach ($stored_data as $property => $value) {
          $data['stored_data'][$property] = $value;
        }
      }
      else {
        redirect('events/show/' . $eventid);
      }
    }

    $this->form_validation->set_rules('firstname', 'First name', 'required');
    $this->form_validation->set_rules('lastname', 'Last name', 'required');
    $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
    $this->form_validation->set_rules('phone', 'Phone number', 'required');
    $this->form_validation->set_rules('address', 'Place of stay', 'required');

    if ($this->form_validation->run() != FALSE) {
      if ($this->rsvp_model->save()) {
        $this->session->set_flashdata('message', 'Your RSVP has been successfully recorded.');
      }
      redirect('events/show/' . $this->input->post('eventid'));
    }

    $event = $this->googlecalendar->getEvent($eventid);
    $data['view'] = 'subscribe';
    $data['title']['event'] = $event;

    $data['title'] = $event['summary'];
    $data['data']['event'] = $event;
    $this->load->view('master', $data);
  }

  public function confirm($eventid, $id) {
    $this->load->library('googlecalendar');
    $this->load->model('rsvp_model');
    $this->load->library('form_validation');

    if (($this->rsvp_model->can_edit($id)) || spm_is_admin()) {
      $event = $this->googlecalendar->getEvent($eventid);

      if ($this->input->post('confirm')) {
        $this->rsvp_model->delete($id);
        redirect('events/show/' . $eventid);
    }

      $data['view'] = 'confirm';
      $data['title'] = 'Confirm RSVP delete for ' . $event['summary'];
      $data['data']['event'] = $event;
      $this->load->view('master', $data);
    }
  }

}