<?php
require_once  "../include.php";
$act=$_REQUEST['act'];
if($act=="logout"){
    logout();
}elseif ($act=="addUser"){
    addUser();
}