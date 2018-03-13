<?php
/**
 * Created by PhpStorm.
 * User: petiar
 * Date: 03/03/2018
 * Time: 00:54
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Googlecalendar {

  private $service;
  const CLIENT_SECRET_PATH = 'spm_secret.json';
  protected $CI;

  public function __construct()
  {
    $client = $this->getCalendarClient();
    $this->service = $this->getCalendarService($client);
    $this->CI =& get_instance();
  }
  public function getId() {
    return $this->CI->session->userdata('calendarid')?$this->CI->session->userdata('calendarid'):$this->CI->config->item('spm_calendar_id');
  }
  public function getCalendarClient()
  {
    $this->CI =& get_instance();
    $client = new Google_Client();
    $client->setApplicationName("SPM Conference Meeting Place");
    $client->setDeveloperKey($this->CI->config->item('spm_developer_key'));
    $client->addScope(array(Google_Service_Calendar::CALENDAR_READONLY));
    return $client;
  }
  public function getCalendarService($client)
  {
    $service = new Google_Service_Calendar($client);
    return $service;
  }
  public function getEvents() {
    switch ($this->CI->session->userdata('filter')) {
      case '3months':
        $timeMin = date(DATE_ATOM);
        $timeMax = date(DATE_ATOM, strtotime('+3 months'));
        break;
      case 'year':
        $timeMin = date(DATE_ATOM);
        $timeMax = date(DATE_ATOM, strtotime('Dec 31'));
        break;
      case 'nyear':
        $nextYear = date('Y') + 1;
        $timeMin = date(DATE_ATOM, strtotime('Jan 1 ' . $nextYear));
        $timeMax = date(DATE_ATOM, strtotime('Dec 31 ' . $nextYear));
        break;
      case 'month':
        $timeMin = date(DATE_ATOM);
        $timeMax = date(DATE_ATOM, strtotime('last day of this month'));
        break;
      case 'all':
      default:
        $timeMin = NULL;
        $timeMax = NULL;
    }
    switch ($this->CI->session->userdata('filter_conference')) {
      case 'on':
        $summary_filter = '/^Conference/';
        break;
      default:
        $summary_filter = '/(.)*/';
    }
    try {
      $events = $this->service->events->listEvents($this->getId(),array('timeMin' => $timeMin, 'timeMax' => $timeMax));
    }
    catch (Exception $e) {
      $message = json_decode($e->getMessage());
      show_error($message->error->message . '<pre>' . $this->CI->config->item('spm_developer_key') . '<br>' . $this->CI->config->item('spm_calendar_id') . '</pre>', $message->error->code, 'Google API error');
    }
    $items = array();
    foreach ($events->getItems() as $event) {
      $item = $this->buildEvent($event);
      if ($item) {
        if (preg_match($summary_filter, $item['summary'])) {
          $items[] = $item;
        }
      }
    }
    return $items;
  }
  public function getEvent($id)
  {
    return $this->buildEvent($this->service->events->get($this->getId(), $id));
  }

  private function buildEvent($event) {
    $this->CI->load->helper('date');
    if ($event->start) {
      $start = new DateTime($event->start->getDateTime());
    }
    else {
      // we can't display an event if it has not start date
      return array();
    }
    if ($event->end) {
      $end = new DateTime($event->end->getDateTime());
    }
    else {
      // we can't display an event if it has not start date
      return array();
    }


    $data = array(
      'id' => $event->getId(),
      'description' => $event->description,
      'location' => $event->location,
      'summary' => $event->summary,
      'start' => $start->format('d. m. Y'),
      'end' => $end->format('d. m. Y'),
    );

    $dates = date_range($start->format('Y-m-d'), $end->format('Y-m-d'));

    foreach ($dates as $date) {
      $data['days'][$date] = $date;
    }

    return $data;
  }

}