<?php

/*
 * Problem 3
 * Based on an input birthdate, determine if the individual is 13 years old or older
 */

// Section 1 solution
$birthdate = '1999-01-20'; // represents a birthdate
$born = new DateTime($birthdate); // new datetime object using birthdate
$today = new DateTime('today'); // new datetime object using today
$age = $born->diff($today)->y; // Find difference between dates in years

if ($age >= 13) {
  echo 'Person is at least 13 years old';
} else {
  echo 'Person is under age 13';
}

// Section 1 alternative solution
$date = '2001-10-21'; // represents a birthdate
$born = new DateTime($date); // new datetime object using birthdate
$today = new DateTime('today'); // new datetime object using today
$born->modify('13 years'); // adds 13 years to the $born value

if ($born > $today) {
// if the new born value is greater than today, the person is under 13
  echo 'Sorry, you are too young';
} else {
  echo 'You are older than 13';
}

// Section 2 solution
$value = '2001-10-21'; // represents the individuals date of birth
$birthdate = strtotime($value); // converts string to time stamp
$date = date('F j, Y'); // creates time stamp of today's date
$date = strtotime("$date -13 year"); // subtracts 13 years from today
If ($date >= $birthdate) {
  // today's date - 13 years is greater than or equal to the birthdate
  $message = 'Thank you for your purchase' . "<br>";
} else {
  $message = 'Must be older than 13 to purchase' . "<br>";
}
        