### About this application

This application allows users to subscribe to a public Google Calendar event.

### Create Google public calendar

This application needs a public Google Calendar to work with. Visit the Google Developer console
and create a new Google API project. Enable Google Calendar API for this project and create credentials for it.
Google will generate a credentials file. Name it `spm_secret.json` and place it in the appropriate config directory.

### Installation

1. Git clone or download this app from the github repository and run `composer install`.
2. Create database `calendar` and import the schema in the `rsvp.sql` file.

### Server Requirements

PHP version 5.6 or newer is recommended.
