<?php
require_once  "../include.php";
$act=$_REQUEST['act'];
if($act=="logout"){
    logout();
}elseif ($act=="addUser"){
    addUser();
}
elseif ($act="addAdmin"){
    $adminName=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    addAdmin($adminName,$password,$email);
}