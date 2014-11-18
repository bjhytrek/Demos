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
          <h1>Delete</h1>
          <?php
          if(isset($message)){
           echo $message;
          }
          ?>
          
          <p><strong>Be Careful! A Delete cannot be undone!</strong></p>
          <form action="." method="post" id="deleteform">
            <fieldset>
              <label for="firstname">Firstname:</label>
              <input type="text" name="firstname" id="firstname" value="<?php echo $customerData['firstName'] ?>" readonly>
              <label for="lastname">Lastname:</label>
              <input type="text" name="lastname" id="lastname" value="<?php echo $customerData['lastName'] ?>" readonly>
              <label for="emailaddress">Email Address:</label>
              <input type="email" name="emailaddress" id="emailaddress" value="<?php echo $customerData['emailAddress'] ?>" readonly>
              <label>&nbsp;</label>
              <input type="submit" name="action" id="action" value="Delete">
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
