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
function getAllCatePage(){

}
function getCateByPage($pageSize=2){
    $sql="select * from shop_cate";
    global $totalRows;
    $totalRows=getResultNum($sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
//接受传来的'page',如果没有传，就为1
    $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
    $offset=($page-1)*$pageSize;
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage){
        $page=$totalPage;
    }
    $sql="select * from shop_admin limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    return $rows;
}
function getCateById($id){
    $sql="select id,cName from shop_cate where id={$id}";
    return fetchOne($sql);
}
function editCate($where){
    $arr=$_POST["cName"];
    $table="shop_cate";
    if(!update($table,$arr,$where)){
        $mes="分类修改成功！<br/><a href='listCate.php'>查看分类</a>";
    }else{
        $mes="分类修改失败！<br/><a href='listCate.php'>查看分类</a>";
    }
    printf($mes);
}