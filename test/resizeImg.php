<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/17
 * Time: 17:28
 */
//$filename="des_big.jpg";
//$src_image=imagecreatefromjpeg($filename);
//list($src_w,$src_h)=getimagesize($filename);
//$scale=0.5;
//$dst_w=ceil($src_w*$scale);
//$dst_h=ceil($src_h*$scale);
//$dst_image=imagecreatetruecolor($dst_w,$dst_h);
//imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
//header("content-type:image/jpeg");
//imagejpeg($dst_image,'uploads/des_big.jpg');
//imagedestroy($src_image);
//imagedestroy($dst_image);
require_once "../lib/string.func.php";
require_once  "upload.func.php";
function thumb($filename,$destination=null,$scale=0.5,$dst_w=null,$dst_h=null,$isReservedSource=false){
//    $filename="des_big.jpg";
    list($src_w,$src_h,$imagetype)=getimagesize($filename);
    $mime=image_type_to_mime_type($imagetype);
    echo $mime;

    if(is_null($dst_w)||is_null($dst_h)){
        $dst_w=ceil($src_w*$scale);
        $dst_h=ceil($src_h*$scale);
    }

    $createFun=str_replace("/","createfrom",$mime);
    $outFun=str_replace("/",null,$mime);
    $src_image=$createFun($filename);
     //创建画布大小
    $dst_image=imagecreatetruecolor($dst_w,$dst_h);
     //设置缩放
    imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
    //判断路径是否存在，若不存在就创建
    if($destination&&!file_exists(dirname($destination))){
        mkdir(dirname($destination),0777,true);
    }
    //输出图片
    $dstFilename=$destination==null?getUniName().".".getExt($filename):$destination;
    $outFun($dst_image,$dstFilename);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    //是否删掉源文件，默认为不删掉
//    $isReservedSource=false;
    if(!$isReservedSource){
        unlink($filename);
    }
}
$filename="des_big.jpg";
thumb($filename,$destination="uploads/".$filename,$scale=1.5);
//
//
//
//
//    $filename="des_big.jpg";
//    list($src_w,$src_h,$imagetype)=getimagesize($filename);
//    $mime=image_type_to_mime_type($imagetype);
//    echo $mime;
////image/jpeg
//    $createFun=str_replace("/","createfrom",$mime);
//    $outFun=str_replace("/",null,$mime);
//    $src_image=$createFun($filename);
////创建画布大小
//    $dst_50_image=imagecreatetruecolor(50,50);
//    $dst_220_image=imagecreatetruecolor(220,220);
//    $dst_350_image=imagecreatetruecolor(350,350);
//    $dst_800_image=imagecreatetruecolor(800,800);
//
////设置缩放50*50，220*220，350*350，800*800
//    imagecopyresampled($dst_50_image,$src_image,0,0,0,0,50,50,$src_w,$src_h);
//    imagecopyresampled($dst_220_image,$src_image,0,0,0,0,220,220,$src_w,$src_h);
//    imagecopyresampled($dst_350_image,$src_image,0,0,0,0,350,350,$src_w,$src_h);
//    imagecopyresampled($dst_800_image,$src_image,0,0,0,0,800,800,$src_w,$src_h);
////输出图片
//    $outFun($dst_50_image,"uploads/050.jpg");
//    $outFun($dst_220_image,"uploads/220.jpg");
//    $outFun($dst_350_image,"uploads/350.jpg");
//    $outFun($dst_800_image,"uploads/800.jpg");
//    imagedestroy($src_image);
//    imagedestroy($dst_50_image);
//    imagedestroy($dst_220_image);
//    imagedestroy($dst_350_image);
//    imagedestroy($dst_800_image);

