<?php
if(isset($_POST['submit'])){

    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (checkEmailExists($email)==FALSE){
      registerUser($username, $email, $password);
      echo "Registration Successful!";
      $loginlink = '../forms/login.html';
      echo "<br/><br/><a href=".$loginlink.">Back to Login</a>";
    } else {
      echo "Email already exists. Please use another email\n";
      $registerlink = '../forms/register.html';
      echo "<br/><br/><a href=".$registerlink.">Back to Register</a>";
    }

} else {
  echo "Try again!";}

function registerUser($username, $email, $password){
    $userfile = fopen("../storage/users.csv", "a");
    $userdata = array('username' => $username,'email' => $email, 'password' => $password);
    $regdata = implode(",",$userdata)."\n";
    //save data into the file
    fwrite($userfile,$regdata);
    fclose($userfile);
}

function checkEmailExists($email){
  $userfile = fopen("../storage/users.csv", "r");
  $exists = false;
  while(!feof($userfile)) {
      // Get each line
      while (($userdataline = fgetcsv($userfile)) !== false) {
        if ($userdataline[1] == $email){
            $exists = true;
        }
      } // end while for row check
  } // end while for end of file check
  fclose($userfile);
  return $exists;
}
