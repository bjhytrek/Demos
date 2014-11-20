<?php

/*
 * Account Model
 */

require $_SERVER['DOCUMENT_ROOT'] . '/library/library.php';

//Get a list of the currently registered individuals
function getCustomers() {
    $connection = conGtr2User();
    try {
     $sql = 'SELECT customers.customerID, lastName, firstName, emailAddress, line1, city, state, zipCode FROM customers LEFT JOIN addresses ON customers.customerID = addresses.customerID AND customers.billingAddressID = addresses.addressID ORDER BY lastName, firstName';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $customers = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $customers;
}

// Get data for a single individual
function getCustomer($custID) {
    $connection = conGtr2User();
    try {
     $sql = 'SELECT customers.customerID, lastName, firstName, emailAddress, line1, city, state, zipCode FROM customers LEFT JOIN addresses ON customers.customerID = addresses.customerID AND customers.billingAddressID = addresses.addressID WHERE customers.customerID = :customerID ORDER BY lastName, firstName';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':customerID', $custID, PDO::PARAM_INT);
        $stmt->execute();
        $customer = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $customer;
}

// Register a new individual
function addCustomer($firstname, $lastname, $emailaddress, $password) {
    $connection = conGtr2User();
    try {
        $sql = 'INSERT INTO customers (firstName, lastName, emailAddress, password) VALUES (:firstName, :lastName, :emailAddress, :password)';
 $stmt = $connection->prepare($sql);
 $stmt->bindParam(':firstName', $firstname, PDO::PARAM_STR);
 $stmt->bindParam(':lastName', $lastname, PDO::PARAM_STR);
 $stmt->bindParam(':emailAddress', $emailaddress, PDO::PARAM_STR);
 $stmt->bindParam(':password', $password, PDO::PARAM_STR);
 $stmt->execute();
 $insertRow = $stmt->rowCount();
 $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $insertRow;
}

// Update data for an individual
function updateCustomer($custID, $firstName, $lastName, $emailaddress, $password){
 $connection = conGtr2User();
 try {
  // Test if there is a value for a password (it is being reset)
  if(empty($password)){
        $sql = 'UPDATE customers SET firstName = :firstName, lastName = :lastName, emailAddress = :emailAddress WHERE customerID = :custID';
  } else {
   $sql = 'UPDATE customers SET firstName = :firstName, lastName = :lastName, emailAddress = :emailAddress, password = :password WHERE customerID = :custID';
  }
 $stmt = $connection->prepare($sql);
 $stmt->bindParam(':custID', $custID, PDO::PARAM_INT);
 $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
 $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
 $stmt->bindParam(':emailAddress', $emailaddress, PDO::PARAM_STR);
 if(!empty($password)){
 $stmt->bindParam(':password', $password, PDO::PARAM_STR);
 }
 $stmt->execute();
 $updateRow = $stmt->rowCount();
 $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $updateRow;

}

// Delete data for an individual
function deleteCustomer($custID){
 $connection = conGtr2Admin(); // Notice the new proxy (with delete privleges)
 try {
   $sql = 'DELETE FROM customers WHERE customerID = :custID';

 $stmt = $connection->prepare($sql);
 $stmt->bindParam(':custID', $custID, PDO::PARAM_INT);
 $stmt->execute();
 $deleteRow = $stmt->rowCount();
 $stmt->closeCursor();
    } catch (PDOException $ex) {
        return FALSE;
    }
    return $deleteRow;

}

// Login client
function loginCustomer($emailaddress, $password){
 $connection = conGtr2User();
 
 try{
  $sql = "SELECT customerID, firstName, lastName, emailAddress, password
FROM customers WHERE emailAddress = :emailaddress";
  
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':emailaddress', $emailaddress,PDO::PARAM_STR);
  $stmt->execute();
  $custInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
} catch (PDOException $exc){
    return FALSE;
}
// Returns the hashed password
return $custInfo;
}

// check for existing email as part of registration process
function getEmail($emailAddress){
 $connection = conGtr2User();
 try {
  $sql = "SELECT emailAddress FROM customers WHERE emailAddress = :emailAddress";
  $stmt = $connection->prepare($sql);
  $stmt->bindValue(':emailAddress', $emailAddress);
  $stmt->execute();
  $existingemail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
} catch (PDOException $exc){
    // Send to error page with message
    $message = 'Sorry, there was an internal error with the server.';
    $_SESSION['message'] = $message;
    header('location: /errordocs/500.php');
    exit;
}
// Note, we are not interested in the email, only if it exists
if(!empty($existingemail)){
   return TRUE;
  } else {
   return FALSE;
  }
}