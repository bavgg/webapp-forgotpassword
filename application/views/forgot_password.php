<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
</head>

<body>

<h1><?php echo $title; ?></h1>

<?php
  echo form_open('forgot_password/verify');
  
  echo form_label('Enter your E-mail Address', 'txtEmail').'<br>';
  echo form_input('txtEmail', '', 'id="txtEmail"').'<br>';  
  
  echo form_submit('btnsubmit','Submit').'<br>';
  
  echo validation_errors();

  echo form_close();
?>

</body>
</html>