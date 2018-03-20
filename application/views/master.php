<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SPM <?php isset($title) ? ' | ' . $title : 'Welcome'; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-MmFGSHKWNFDZYlwAtfeY6ThYRrYajzX+v7G4KVORjlWAG0nLhv0ULnFETyWGeQiU" crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="/css/style.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-faded bg-faded">
    <a class="navbar-brand" href="<?php print site_url(); ?>">SPM Conference Meeting Place</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php print site_url('events'); ?>">Events list</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="<?php print current_url(); ?>">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="nav-link">Logged in as <strong><?php print $_SESSION['username']; ?></strong></span>
            <?php endif; ?>
            <?php if (!isset($_SESSION['username']) && FALSE): // disabled ?>
            <input class="form-control mr-sm-2" type="search" name="username" placeholder="Username"
                   aria-label="Login">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="this.form.submit();">Login
            </button>
        </form>
        <?php endif; ?>
        </form>
    </div>
</nav>
</div>
<div class="container">
    <!--
    <form class="form-inline my-2 my-lg-0" method="post" action="<?php print site_url('events/setcalendarid'); ?>">
        CalendarID:&nbsp;<input style="width: 80%;" class="form-control mr-sm-2" name="calendarid" placeholder="Calendar ID" value="<?php print $this->session->userdata('calendarid')?$this->session->userdata('calendarid'):''; ?>"
               aria-label="Set">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="this.form.submit();">Set</button>
    </form>
    -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
                <h3 class="display-4"><?php print $title; ?></h3>
            </div>
        </div>
    </div>
    <?php $this->view($view, $data); ?>
</div>

</body>
</html>