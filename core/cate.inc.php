<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/21
 * Time: 15:07
 */
function addCate(){
    $arr=$_POST;
    $mes=insert("shop_cate",$arr);
    if(!$mes){
        echo "新纪录添加成功，选择继续添加<a href='addCate.php'>继续添加</a>";
    }
}