<?php
session_start();

logout();

function logout(){
if (isset($_SESSION['email'])) {
  unset($_SESSION['email']);
  unset($_SESSION['name']);
  session_destroy();
  header('Location:../index.php');
  }
}
