<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');
// Handle different cases based on parameters

if (isset($_GET['seckey'])) {
    require_once('api/connectESP.php');
} elseif (
    isset($_GET['id']) && isset($_GET['status']) &&
    isset($_GET['kwh']) && isset($_GET['v']) && isset($_GET['c']) &&
    isset($_GET['pf']) ||
    isset($_POST['id']) && isset($_POST['status']) &&
    isset($_POST['kwh']) && isset($_POST['v']) && isset($_POST['c']) &&
    isset($_POST['pf'])
) {
    require_once('admin/api/InsertToDatabase.php');
} elseif (isset($_GET['esp_id'])) {
    require_once('admin/api/relayState.php');
} elseif (isset($_GET['connstate'])) {
    require_once('admin/api/autodisconnect.php');
} else {

    header('Location: login.html');
}

