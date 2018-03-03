<?php

function get_days_from_form($post) {
  $days = array();
  foreach ($post as $key => $value) {
    if (substr($key, 0, 5) == 'date_') {
      $days[] = substr($key, 5);
    }
  }
  return $days;
}