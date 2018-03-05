<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SPM <?php isset($title)?' | ' . $title:'Welcome'; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0/lux/bootstrap.min.css" rel="stylesheet" integrity="sha384-GxhP7S92hzaDyDJqbdpcHqV5cFflxAx0Yze/X7vUONp43KK1E8eUWaJIMkit3D0R" crossorigin="anonymous">

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link href="/css/style.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">SPM Conference Meeting Place</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout" value="logout">Logout</button>
        <?php endif; ?>
        <?php if (!isset($_SESSION['username'])): ?>
            <input class="form-control mr-sm-2" type="search" name="username" placeholder="Username" aria-label="Login">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="this.form.submit();">Login</button>
          </form>
        <?php endif; ?>
      </form>
    </div>
  </nav>
  <h1><?php print $title; ?></h1>
  <?php $this->view($view, $data); ?>
</div>

</body>
</html>