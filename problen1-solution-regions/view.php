<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
      input, label{
        display: block;
      }
      .notice{
        font-weight: bold;
        font-style: italic;
      }
    </style>
  </head>
  <body>
    <h1>Registration</h1>
    <?php
    echo $message;
    ?>
    <form action="." method="post" id="regform">
      <fieldset>
        <label for="firstname">First name:</label>
        <input type="text" name="firstname" id="firstname">
        <label for="lastname">Last name:</label>
        <input type="text" name="lastname" id="lastname">
        <?php
    // Build the radio button group
        $regions = array(
       array('East', 'ET'),
       array('Central', 'CT'),
       array('South', 'ST'),
       array('West', 'WT'),
       array('Pacific', 'PC')
       );
        
       foreach ($regions as $region) {
         echo "<input type='radio' name='region' value='$region[1]'>$region[0]";
}
    ?>
        <label>&nbsp;</label>
        <input type="submit" name="action" id="action" value="Register">
      </fieldset>
    </form>
   
  </body>
</html>
