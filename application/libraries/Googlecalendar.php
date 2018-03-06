<?php
/**
 * Created by PhpStorm.
 * User: petiar
 * Date: 03/03/2018
 * Time: 00:54
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Googlecalendar {

  private $id = "6d9bnutuoo30dgnivq738hnnk0@group.calendar.google.com";
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
    return $this->id;
  }
  public function getCalendarClient()
  {
    $client = new Google_Client();
    $client->setApplicationName("SPM Conference Meeting Place");
    $client->setAuthConfig(__DIR__ . '/../config/' . ENVIRONMENT . '/' . self::CLIENT_SECRET_PATH);
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
      default:
        $timeMin = date(DATE_ATOM);
        $timeMax = date(DATE_ATOM, strtotime('last day of this month'));
        break;
    }
    $events = $this->service->events->listEvents($this->getId(),array('timeMin' => $timeMin, 'timeMax' => $timeMax));
    $items = array();
    foreach ($events->getItems() as $event) {
      $items[] = $this->buildEvent($event);
    }
    return $items;
  }
  public function getEvent($id)
  {
    return $this->buildEvent($this->service->events->get($this->getId(), $id));
  }

  private function buildEvent($event) {
    $this->CI->load->helper('date');
    $start = new DateTime($event->start->getDateTime());
    $end = new DateTime($event->end->getDateTime());

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