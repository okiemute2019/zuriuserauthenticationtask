<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $newpassword = $_POST['password'];

    resetPassword($email, $newpassword);
    echo "Password Reset Successful!";
    $loginlink = '../forms/login.html';
    echo "<br/><br/><a href=".$loginlink.">Back to Login</a>";
} else {echo "Error Resetting Password!";}

function resetPassword($email, $newpassword){
  //open file and check if the username exist inside
  //if it does, replace the password
    $userfile = fopen("../storage/users.csv", "r") or die("Unable to open file!");
    $userrecord = array();

    while(!feof($userfile)) {
        // Get each line
        while (($userdataline = fgetcsv($userfile)) !== false) {
          if ($userdataline[1] == $email){
            $userdataline[2] = $newpassword; // modify password
            $userrecord[] = $userdataline; // generate updated array
            break;
          } else {
            $userrecord[] = $userdataline; // generate updated array
            break;
          } // end if to replace data
        } // end while for row check
    } // end while for end of file check
    fclose($userfile);
    // update user file
    $updateduserfile = fopen("../storage/users.csv", "w") or die("Unable to open file!");
    foreach ($userrecord as $fields) {
      fputcsv($updateduserfile,$fields);
    }
    fclose($updateduserfile);
} // end of resetPassword function
