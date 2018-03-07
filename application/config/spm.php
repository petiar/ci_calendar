<?php

// This is the regular expression which we can use to filter events we want to display.
// This will be aplied agains event summary field.
$config['spm_event_name_regexp'] = '/^Conference\:/';

$config['spm_application_name'] = 'SPM Events Calendar';
$config['spm_superuser'] = 'administrator';
// $config['spm_calendar_id'] = 'participatorymedicine.org_6j9ak1oh6bhdqidc2ph3clf4es@group.calendar.google.com'; // dev test public calendar
// $config['spm_calendar_id'] = '6d9bnutuoo30dgnivq738hnnk0@group.calendar.google.com'; // dev test public calendar
$config['spm_calendar_id'] = 'emailcentral%40participatorymedicine.org'; // production calendar
$config['spm_developer_key'] = 'AIzaSyCxgHQ4b423qsoWkIADcjRmvRTWXvZTguc';
