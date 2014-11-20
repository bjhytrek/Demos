<?php

session_start();
/*
 * Account Controller
 */

require 'model.php';

//Get a trigger key-value, regardless of how sent
if (isset($_POST['action'])) {
 $actionsent = filterString($_POST['action']);
} elseif (isset($_GET['action'])) {
 $actionsent = filterString($_GET['action']);
}

//Figure out what to do based on the request

switch ($actionsent) {

 // ***************** Update Events *****************
 case 'update':
  // Request for the Update form
  // Get the data for the view
  $custID = filterNumber($_GET['cust']); // Sent with link
  $customerData = getCustomer($custID);
  $title = 'Update';
  include 'update.php';
  break;

 case 'Update':
  // Process the update
  $firstname = filterString($_POST['firstname']);
  $lastname = filterString($_POST['lastname']);
  $emailaddress = filterString($_POST['emailaddress']);
  $password = filterString($_POST['password']);
  $custID = filterNumber($_POST['custID']);
  // validate the data
    if(empty($firstname) || empty($lastname) || empty($emailaddress)){
   // message to tell the registrant something is wrong
   $message = 'Firstname, Lastname and Email fields are required. Please make sure that all fields have valid entries.';
  }
  // Check for errors, return to be fixed
  if(isset($message)){
   $errors = [$firstname, $lastname, $emailaddress, $custID]; // use to repopulate the form - including sending back the neccessary key
   include 'update.php'; // Send back to register for repair
   exit; // stop all further processing on this page
  }
  // No errors, process it
  // hash the new password, only if a new password has been submitted
  if(!empty($password)){
   $password = hashPassword($password);
  }
  $updateResult = updateCustomer($custID, $firstname, $lastname, $emailaddress, $password);
  // Find out the result, notify client
  if ($updateResult) {
   $message = '<p class="notice">The update for ' . $firstname . ' was successful.</p>';
  } else {
   $message = '<p class="notice">Sorry, the update for ' . $firstname . ' failed.</p>';
  }
  $customers = getCustomers();
  $title = 'Customers';
  include 'customers.php';
  break;

 // ***************** Delete Events *****************
 case 'delete':
  // Request for Delete form
  // Get the data for the view
  $custID = filterNumber($_GET['cust']);
  $customerData = getCustomer($custID);
  $title = 'Delete';
  include 'delete.php';
  break;

 case 'Delete':
  // Process the delete
  $firstname = filterString($_POST['firstname']);
  $custID = filterNumber($_POST['custID']);

  // process it
  $deleteResult = deleteCustomer($custID);
  // Find out the result, notify client
  if ($deleteResult) {
   $message = '<p class="notice">The delete for ' . $firstname . ' was successful.</p>';
  } else {
   $message = '<p class="notice">Sorry, the delete for ' . $firstname . ' failed.</p>';
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
// Get Data
  $emailaddress = filterString($_POST['emailaddress']);
  $password = filterString($_POST['password']);

  // Check the data
  if(empty($emailaddress) || empty($password)){
   $message = 'You must supply an email address and password.';
  }
  
  // If errors, return for repair
  if(isset($message)){
   include 'login.php';
   exit;
  }
  
  // Proceed with login attempt, if no errors
  // Get the data from the database based on the email address
  $loginData = loginCustomer($emailaddress, $password); 
  $hashedPassword = $loginData['password'];
  // Compare the passwords for a match
  $passwordMatch = comparePassword($password, $hashedPassword);

  // If there is a match, do the login
  if($passwordMatch){
   // Use the session for login data
   $_SESSION['loggedin'] = TRUE;
   $_SESSION['firstname'] = $loginData['firstName'];
   $_SESSION['customerID'] = $loginData['customerID'];
   // Indicate that the login was a success
   $message = $loginData['firstName'].', you have logged in.';
   $customers = getCustomers();
  $title = 'Customers';
   include 'customers.php';
   exit;
  } else {
  // There was not a match, tell the user 
   $message = 'I\'m sorry, but you could not be logged in.';
   $title = 'Login';
   include 'login.php';
   exit;
  }
  break;

 case 'logout':
  // Process the logout
  // Remove the login data from the session
   $_SESSION['loggedin'] = FALSE;
   $_SESSION['firstname'] = NULL;
   $_SESSION['customerID'] = NULL;
   session_destroy();
   // send to home page
   header('location: /');
  break;

 // ***************** Registration Events *****************

 case 'Register':
  // Process the registration
  // Collect data
  $firstname = filterString($_POST['firstname']);
  $lastname = filterString($_POST['lastname']);
  $emailaddress = filterString($_POST['emailaddress']);
  $password = filterString($_POST['password']);
  // validate the data
  if(empty($firstname) || empty($lastname) || empty($emailaddress) || empty($password)){
   // message to tell the registrant something is wrong
   $message = 'All fields are required. Please make sure that all fields have valid entries.';
  }
  // Check for errors, return to be fixed
  if(isset($message)){
   $errors = [$firstname, $lastname, $emailaddress]; // use to repopulate the form
   include 'register.php'; // Send back to register for repair
   exit; // stop all further processing on this page
  }
  // No errors found, process the registration
  
  // Check for existing email address
  $existingEmail = getEmail($emailaddress);
  if ($emailaddress) {
   $message = "Sorry, you cannot register using the provided Email address, please choose another or try logging in.";
   include 'register.php';
   exit;
  }

  // No prior email address found, proceed with the registration
  $password = hashPassword($password); // hash the password
  $insertResult = addCustomer($firstname, $lastname, $emailaddress, $password);
  // Find out the result, notify client
  if ($insertResult) {
   $message = '<p class="notice">Thank you ' . $firstname . ' you have been registered.</p>';
  } else {
   $message = '<p class="notice">Sorry, ' . $firstname . ' the registration failed.</p>';
  }
  include 'register.php';
  break;

 default:
  // Deliver the registration form
  $title = 'Register';
  include 'register.php';
  break;
}



