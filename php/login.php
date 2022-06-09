<?php

session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

loginUser($email, $password);

  if (isset($_SESSION['email'])){
    header('Location:../dashboard.php');
  } else {
    echo "Invalid Username or Password!";
    $loginlink = '../forms/login.html';
    echo "<br/><br/><a href=".$loginlink.">Back to Login</a>";
  }
}

function loginUser($email, $password){
  $userfile = fopen("../storage/users.csv", "r") or die("Unable to open file!");
  while(!feof($userfile)) {
      // Get each line
      while (($userdataline = fgetcsv($userfile)) !== false) {
        if ($userdataline[1] == $email && $userdataline[2] == $password){
          $_SESSION['email'] = $userdataline[1];
          $_SESSION['name'] = $userdataline[0];
        }
      } // end while for row check
  } // end while for end of file check

  fclose($userfile);
}
