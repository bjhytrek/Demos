<?php

/*
 * Library of custom functions
 */

/* ------------ Database Connection Functions --------------- */

//Connection to the guitar1 DB for proxy user
function conGtr1User() {
    $server = 'localhost';
    $username = '';
    $password = '';
    $database = '********_guitar1';
    $dsn = "mysql:host=$server; dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $congtr1 = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $exc) {
        return FALSE;
    }

    if (is_object($congtr1)) {
        return $congtr1;
    }
    return FALSE;
}

//Connection to the guitar1 DB for proxy admin
function conGtr1Admin() {
    $server = 'localhost';
    $username = '';
    $password = '';
    $database = '********_guitar1';
    $dsn = "mysql:host=$server; dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $congtr1admin = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $exc) {
        return FALSE;
    }

    if (is_object($congtr1admin)) {
        return $congtr1admin;
    }
    return FALSE;
}

//Connection to the guitar2 DB for proxy user
function conGtr2User() {
    $server = 'localhost';
    $username = '';
    $password = '';
    $database = '********_guitar2';
    $dsn = "mysql:host=$server; dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $congtr2 = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $exc) {
        return FALSE;
    }

    if (is_object($congtr2)) {
        return $congtr2;
    }
    return FALSE;
}

//Connection to the guitar2 DB for proxy admin
function conGtr2Admin() {
    $server = 'localhost';
    $username = '';
    $password = '';
    $database = '********_guitar2';
    $dsn = "mysql:host=$server; dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $congtr2admin = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $exc) {
        return FALSE;
    }

    if (is_object($congtr2admin)) {
        return $congtr2admin;
    }
    return FALSE;
}

/* ------------ Password Functions --------------- */

// Consult php.net for operations of any PHP function you don't understand

// Use with registration and update (if password is being updated)
function hashPassword($password) {
    $salt = '$6$rounds=9000$' . substr(md5(uniqid(rand(), true)), 0, 16); // SHA-512   
    return crypt($password, $salt); // Result is ~120 character password including salt
}

// Use with login, remember that the password must be queried out of the database first
function comparePassword($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}

/* ------------ Data Input Cleanup Functions --------------- */
// Three versions, use the one appropriate for what you want to do
function filterString($string){
    $string = filter_var(trim($string), FILTER_SANITIZE_STRING); // Encodes special chars
 // $string = filter_var(trim($string), FILTER_SANITIZE_SPECIAL_CHARS); // Removes a small list of special chars
 // $string = filter_var(trim($string), FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Removes all special chars
    return $string;
}

// Always sanitize first (remove potentially bad things), then validate remains for acceptability
function filterNumber($number){
 $number = filter_var(trim($number), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $number = filter_var($number, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
 return $number;
}

function validateEmail($email){
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    return $email;
}
