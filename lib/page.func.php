<?php
/**
 * 分页的
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 16:43:49
 * @version $Id$
 */
require_once "../include.php";
$sql="select * from shop_admin";
$totalRows=getResultNum($sql);
//每页显示的条数
$pageSize=2;
//totolPage==总页码数
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



function showPage($page,$totalPage,$sep="&nbsp;"){
    $url=$_SERVER['PHP_SELF'];
    $index=($page==1)?"首页":"<a href='{$url}?page=1'>\"首页</a>";
    $last=($page==$totalPage)?"尾页":"<a href='{$url}?page={$totalPage}'>尾页</a>";
    $prev=($page==1)?"上一页":"<a href='{$url}?page=".($page-1)."'>上一页</a>";
    $next=($page==$totalPage)?"下一页":"<a href='{$url}?page=".($page-1)."'>下一页</a>";
    $str="总共有{$totalPage}页/现在是第 {$page} 页";
    $p="";
    for($i=1;$i<=$totalPage;$i++){
        //当前页无连接
        if($page==$i){
            $p.="[{$i}]";
        }else{
            $p.="<a href='{$url}?page={$i}'>[{$i}]</a>";
        }
    }
    $pageStr=$str.$index.$sep.$prev.$sep.$p.$sep.$next.$sep.$last;
    return $pageStr;
}

//print_r(showPage($page,$pageSize));