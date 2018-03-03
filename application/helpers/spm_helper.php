<?php

function spm_is_admin() {
  $ci =& get_instance();
  if ($ci->session->userdata('username')) {
    return $ci->session->userdata('username') == $ci->config->item('spm_superuser');
  }
  return FALSE;
}