<?php

session_start();
/*
 * Account Controller
 */

require 'model.php';

//Get a trigger key-value, regardless of how sent
if (isset($_POST['action'])) {
 $actionsent = $_POST['action'];
} elseif (isset($_GET['action'])) {
 $actionsent = $_GET['action'];
}

//Figure out what to do based on the request

switch ($actionsent) {

 // ***************** Update Events *****************
 case 'update':
  // Request for the Update form
  // Get the data for the view
  $custID = $_GET['cust']; // Sent with link
  $customerData = getCustomer($custID);
  $title = 'Update';
  include 'update.php';
  break;
 
 case 'Update':
  // Process the update
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $emailaddress = $_POST['emailaddress'];
  $password = $_POST['password'];
  $custID = $_POST['custID'];
  // validate the date
  
  // Check for errors, return to be fixed
  
  // No errors, process it
  $updateResult = updateCustomer($custID,$firstname, $lastname, $emailaddress, $password);
  // Find out the result, notify client
  if($updateResult){
   $message = '<p class="notice">The update for '.$firstname.' was successful.</p>';
  } else {
   $message = '<p class="notice">Sorry, the update for '.$firstname.' failed.</p>';
  }
  $customers = getCustomers();
  $title = 'Customers';
  include 'customers.php';
  break;

  // ***************** Delete Events *****************
 case 'delete':
  // Request for Delete form
  // Get the data for the view
  $custID = $_GET['cust'];
  $customerData = getCustomer($custID);
  $title = 'Delete';
  include 'delete.php';
  break;

 case 'Delete':
  // Process the delete
  $firstname = $_POST['firstname'];
  $custID = $_POST['custID'];
  
  // process it
  $deleteResult = deleteCustomer($custID);
  // Find out the result, notify client
  if($deleteResult){
   $message = '<p class="notice">The delete for '.$firstname.' was successful.</p>';
  } else {
   $message = '<p class="notice">Sorry, the delete for '.$firstname.' failed.</p>';
  }
  $customers = getCustomers();
  $title = 'Customers';
  include 'customers.php';
  break;

  // ***************** Show Customer Event *****************

 case 'customerlist':
  // Request for the existing customers
  $customers = getCustomers();
  $title = 'Customers';
  include 'customers.php';
  break;

 // ***************** Login & Logout Events *****************
  case 'login':
  // Deliver the login view
  $title = 'Login';
  include 'login.php';
  break;
 
 case 'Login':
  // Process the login attempt

  break;

 case 'logout':
  // Process the logout

  break;

   // ***************** Registration Events *****************

 case 'Register':
  // Process the registration
// Collect data
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $emailaddress = $_POST['emailaddress'];
  $password = $_POST['password'];
  // validate the date
  
  // Check for errors, return to be fixed
  
  // No errors, process it
  $insertResult = addCustomer($firstname, $lastname, $emailaddress, $password);
  // Find out the result, notify client
  if($insertResult){
   $message = '<p class="notice">Thank you '.$firstname.' you have been registered.</p>';
  } else {
   $message = '<p class="notice">Sorry, '.$firstname.' the registration failed.</p>';
  }
  include 'register.php';
  break;
 
  default:
  // Deliver the registration form
  $title = 'Register';
  include 'register.php';
  break;
}



