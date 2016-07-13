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
    if ($_SESSION['adminId'] == "") {
        alertMes("请先登陆", 'login.php');
    }
}
/*注销管理员*/
function logout(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    session_destroy();
    header("location:login.php");
}