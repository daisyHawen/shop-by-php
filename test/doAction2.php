<?php
/**
 * Created by PhpStorm.
 * 多个文件上传函数的封装
 * User: Administrator
 * Date: 2016/8/17
 * Time: 16:24
 */
require_once '../lib/string.func.php';
require_once 'upload.func.php';
header("content-type:text/html;charset=utf-8");

//构建文件上传信息,返回重建的多文件数组
function buildInfo(){
    foreach($_FILES as $v){
        //若单文件，类型为字符串
        $i=0;
        if(is_string($v['name'])){
            $files[$i]=$v;
            $i++;
        }else{
            //处理多文件,类型为数组
            foreach ($v['name'] as $key=>$val){
                $files[$i]['name']=$val;
                $files[$i]['size']=$v['size'][$key];
                $files[$i]['type']=$v['type'][$key];
                $files[$i]['tmp_name']=$v['tmp_name'][$key];
                $files[$i]['error']=$v['error'][$key];
                $i++;
            }
        }
        return $files;
    }
}
//处理长传多文件
function uploadFiles(){
    $files=buildInfo();
    foreach ($files as $val){
        uploadFile($val);
    }
}
$info=uploadFiles();
print_r($info);