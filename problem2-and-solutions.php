<?php

/* 
 * Problem 2
 * Using this date - 2010-09-22 11:57:32 - convert it to 
 * be more human friendly when displayed in a web page.
 */

//Section 1 solution
$date = new DateTime('2010-09-22 11:57:32');
echo date_format($date, 'l, F d, Y');

// Section 2 solution
echo date('F d, Y', strtotime('2010-09-22 11:57:32'));

