<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/12
 * Time: 10:49
 */
function checkAdmin($sql)
{
    return fetchOne($sql);
}

//检查是否登录了
function checkLogined()
{
//    if ($_SESSION['adminId'] == ""&&$_COOKIE['adminId'==""]) {
        if ($_SESSION['adminId'] == ""&&$_COOKIE['adminId']=="") {
        alertMes("请先登陆", 'login.php');
    }
}

/*注销管理员*/
function logout(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminName'])){
        setcookie('adminName',"",time()-1);
    }
    if(isset($_COOKIE['adminId'])){
        setcookie('adminId',"",time()-1);
    }
    session_destroy();
    header("location:login.php");
}
/*增加管理员*/
function addAdmin(){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    $mes=insert("shop_admin",$arr);
    if(!$mes){
        alert("新纪录添加成功，选择继续添加<a href='addAdmin.php'>继续添加</a><a href='listAdmin.php'>查看管理员列表</a>");
    }
}
/*查询管理员*/
function getAdminByPage(){
    $row=fetchAll();
    return $row;
}