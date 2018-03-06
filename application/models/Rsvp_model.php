<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rsvp_model extends CI_Model {
  public $username;
  public $id;
  public $eventid;
  public $firstname;
  public $lastname;
  public $email;
  public $phone;
  public $speaker;
  public $connect;
  public $address;
  public $date_from;
  public $date_to;
  public $comment;

  public function save() {
    $this->username = $this->input->post('username');
    $this->eventid = $this->input->post('eventid');
    $this->firstname = $this->input->post('firstname');
    $this->lastname = $this->input->post('lastname');
    $this->email = $this->input->post('email');
    $this->phone = $this->input->post('phone');
    $this->speaker = $this->input->post('speaker')?1:0;
    $this->connect = $this->input->post('connect')?1:0;
    $this->address = $this->input->post('address');
    $this->date_from = $this->input->post('date_from');
    $this->date_to = $this->input->post('date_to');
    $this->comment = $this->input->post('comment');

    if ($this->input->post('id')) {
      $this->id = $this->input->post('id');
      $this->db->where('id', $this->input->post('id'));
      $this->db->update('rsvp', $this);
    }
    else {
      $this->db->insert('rsvp', $this);
    }
    return $this->db->insert_id();
  }

  public function list_for_event($id) {
    return $this->db->get_where('rsvp', array('eventid' => $id))->result();
  }

  public function user_subscribed($id, $username = NULL) {
    if (!$username) {
      $username = $this->session->userdata('username');
    }
    $query = $this->db->get_where('rsvp', array('eventid' => $id, 'username' => $username));
    return $query->num_rows();
  }

  public function can_edit($id, $username = NULL) {
    if (spm_is_admin()) {
      return TRUE;
    }
    if (!$username) {
      $username = $this->session->userdata('username');
    }
    $query = $this->db->get_where('rsvp', array('id' => $id))->row();
    if (isset($query->username) && ($query->username == $username)) {
      return TRUE;
    }
    return FALSE;
  }

  public function get($id) {
    return $this->db->get_where('rsvp', array('id' => $id))->row();
  }

  public function get_event_id($id) {
    $query = $this->db->get_where('rsvp', array('id' => $id))->row();
    return $query?$query->eventid:FALSE;
  }

  public function delete($id) {
    $this->db->where(array('id' => $id));
    $query = $this->db->delete('rsvp');
    return $query;
  }

  public function count($eventid) {
    $this->db->where(array('eventid' => $eventid));
    return $this->db->count_all_results('rsvp');
  }
}