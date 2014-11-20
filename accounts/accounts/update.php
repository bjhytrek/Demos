<?php session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?> | 336Demo.BlaineRobertson.net</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
  </head>
  <body>
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
          <h1>Update</h1>
          <?php
          if(isset($message)){
           echo '<p class="notice">'.$message.'</p>';
          }
          ?>
          
          <p>Only supply a password if you desire to reset the current one.</p>
          <form action="." method="post" id="updateform">
            <fieldset>
              <label for="firstname">Firstname:</label>
              <input type="text" name="firstname" id="firstname" value="<?php echo $customerData['firstName'] ?>">
              <label for="lastname">Lastname:</label>
              <input type="text" name="lastname" id="lastname" value="<?php echo $customerData['lastName'] ?>">
              <label for="emailaddress">Email Address:</label>
              <input type="email" name="emailaddress" id="emailaddress" value="<?php echo $customerData['emailAddress'] ?>">
              <label for="password">Password:</label>
              <input placeholder="New Password" type="password" name="password" id="password">
              <label>&nbsp;</label>
              <input type="submit" name="action" id="action" value="Update">
              <input type="hidden" name="custID" value="<?php echo $customerData['customerID'] ?>">
            </fieldset>
          </form>
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
