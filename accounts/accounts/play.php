<?php

/*
 * A play area
 */


$string = '<script>alert(\' Bang!\')</script>';

$value = 3.145687952."<script>alert(\' Bang!\')</script>";

function filterString($string){
//    $string = filter_var(trim($string), FILTER_SANITIZE_STRING); // Encodes special chars
  $string = filter_var(trim($string), FILTER_SANITIZE_SPECIAL_CHARS); // Removes a small list of special chars
 // $string = filter_var(trim($string), FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Removes all special chars
    return $string;
}

function filterNumber($number){
 $number = filter_var(trim($number), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $number = filter_var($number, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
 return $number;
}

echo $string;
echo filterString($string).'<br>';
echo filterNumber($value);

?>