<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?> | 336Demo.BlaineRobertson.net</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
  </head>
  <body id="customers">
    <div id="wrapper">
      <header role="banner">
        <div>
         <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
        </div>
      </header>
      <nav role="navigation">
        <div>
         <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/nav.php'; ?>
        </div>
      </nav>
      <main role="main">
        <div>
          <h1>Current Customers</h1>
          <?php
          if(isset($message)){
           echo $message;
          }
          ?>
          <table>
            <thead><tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email Address</th>
                <th>Street Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr></thead>
            <tbody>
             <?php
             foreach ($customers as $customer) {
              $customerdata = '<tr>';
               $customerdata .= '<td>'.$customer['lastName'].'</td>';
               $customerdata .= '<td>'.$customer['firstName'].'</td>';
               $customerdata .= '<td>'.$customer['emailAddress'].'</td>';
               $customerdata .= '<td>'.$customer['line1'].'</td>';
               $customerdata .= '<td>'.$customer['city'].'</td>';
               $customerdata .= '<td>'.$customer['state'].'</td>';
               $customerdata .= '<td>'.$customer['zipCode'].'</td>';
               $customerdata .= '<td><a href="/accounts?action=update&amp;cust='.$customer['customerID'].'">Edit</a></td>';
               $customerdata .= '<td><a href="/accounts?action=delete&amp;cust='.$customer['customerID'].'">Delete</a></td>';
              $customerdata .= '</tr>';
              echo $customerdata;
             }
             
             ?>
            </tbody>
          </table>
        </div>
      </main>
      <footer role="contentinfo">
        <div>
         <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
        </div>
      </footer>
    </div>
  </body>
</html>
