<?php

/* 
Process the registration
 */

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$region = $_POST['region'];

switch ($region) {
  case 'ET':
    $message = "<p class='notice'>Thanks $firstname for joining the East team.</p>";
    break;
case 'ST':
    $message = "<p class='notice'>Thanks $firstname for joining the South team.</p>";
    break;
  case 'CT':
    $message = "<p class='notice'>Thanks $firstname for joining the Central team.</p>";
    break;
  case 'WT':
    $message = "<p class='notice'>Thanks $firstname for joining the West team.</p>";
    break;
  case 'PC':
    $message = "<p class='notice'>Thanks $firstname for joining the Pacific team.</p>";
    break;
  default:
    $message = "<p class='notice'>Please register to join a team</p>";
    break;
    break;
}

include 'view.php';