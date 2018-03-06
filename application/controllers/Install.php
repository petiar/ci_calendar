<?php
/**
 * Created by PhpStorm.
 * User: petiar
 * Date: 03/03/2018
 * Time: 01:06
 */

class Install extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $query = <<<SQL
DROP TABLE IF EXISTS rsvp;
CREATE TABLE rsvp (
  id integer SERIAL,
  username varchar(16) NOT NULL,
  eventid varchar(64) NOT NULL,
  firstname varchar(32) NOT NULL,
  lastname varchar(32) NOT NULL,
  email varchar(64) NOT NULL,
  phone varchar(32) NOT NULL,
  speaker integer NOT NULL,
  connect integer NOT NULL,
  date_from date NOT NULL,
  date_to date NOT NULL,
  address text NOT NULL,
  comment text,
  PRIMARY KEY (id)
);
SQL;

    $this->db->query($query);
  }
}
