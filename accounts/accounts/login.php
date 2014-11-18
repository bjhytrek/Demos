<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?> | 3361.BlaineRobertson.net</title>
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
          <h1>Login</h1>
          <form method="post" action="." id="loginfrm">
            <fieldset>
              <label for="emailaddress">Email Address</label>
              <input type="email" name="emailaddress" id="emailaddress">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password">
              <label>&nbsp;</label>
              <input type="submit" name="action" id="action" value="Login">
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
