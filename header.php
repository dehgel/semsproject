<?php
require_once(dirname(__FILE__) . '/api/session.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart Energy Metering System | Dashboard</title>

 
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="admin/plugins/fullcalendar/main.css">
  <style>
    #lcdstyle span, #lcdstyle strong {
      color:#ecf1a0;
      font: size 18px;;
    }
    .top-left-label, .bottom-left-label, .top-right-label,.bottom-right-label  {
      color:#e8ffd3;
    }
    .top-left-value,.bottom-left-value,.top-right-value,.bottom-right-value {
      font-size: 26px;
      font-weight:600;
      color:#fff;
    }
    /* CSS for the preloader */
#preloader {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    top: 0;
    left: 0;
    z-index: 1000;
    transition: opacity 0.3s;
    opacity: 0;
    pointer-events: none;
}

#loader {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


    </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
    <!-- Preloader HTML -->
    <div id="preloader">
        <div id="loader"></div>
    </div>
<div class="wrapper">