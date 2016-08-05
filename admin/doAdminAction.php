<?php
require_once  "../include.php";
$act=$_REQUEST['act'];
$id=$_REQUEST['id'];
if($act=="logout"){
    logout();
}elseif ($act=="addUser"){
    addUser();
}
elseif ($act=="addAdmin"){
   addAdmin();
}elseif ($act=="addCate"){
    addCate();
}elseif ($act=="editCate"){
    $where="id={$id}";
    printf($id);
    editCate($where);
}
elseif ($act=="delCate"){
    delCate();
}