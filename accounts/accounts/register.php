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
         <h1>Registration</h1>
         <?php
         if(isset($message)){
         echo $message;
         }?>
         <form action="." method="post" id="regform">
           <fieldset>
             <label for="firstname">Firstname:</label>
             <input type="text" name="firstname" id="firstname">
             <label for="lastname">Lastname:</label>
             <input type="text" name="lastname" id="lastname">
             <label for="emailaddress">Email Address: (this will be your user name)</label>
             <input type="email" name="emailaddress" id="emailaddress">
             <label for="password">Password:</label>
             <input type="password" name="password" id="password">
             <label>&nbsp;</label>
             <input type="submit" name="action" id="action" value="Register">
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
