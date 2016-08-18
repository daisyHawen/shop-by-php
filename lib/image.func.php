<?php
/**
 * 与图片相关
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 16:42:43
 * @version $Id$
 */
require_once  'string.func.php';

//通过GD库制作画布
//需要在配置文件中将php_gd32前的注释消掉
function verifyImage($sess_name="verify",$type=1, $length=4){
    session_start();
    $width=80;
    $height=25;
    $image=imagecreatetruecolor($width, $height);
    $white=imagecolorallocate($image, 255, 255, 255);
    $black=imagecolorallocate($image,0, 0, 0);
    //用填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
    $chars=builRandomString($type,$length);
    $_SESSION[$sess_name]=$chars;
    for($i=0;$i<$length;$i++){
        $size=mt_rand(14,18);
        $angle=mt_rand(-15,15);
        $x=5+$i*$size;
        $y=mt_rand(20,26);
        $color=imagecolorallocate($image,mt_rand(50,90),mt_rand(80,200),mt_rand(90,180));
        $text=substr($chars,$i,1);
        imagettftext($image,$size,$angle,$x,$y,$color,"../fonts/SIMYOU.TTF",$text);
    }
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}
//verifyImage();

//通过GD压缩图片，生成缩略图
function thumb($filename,$destination=null,$scale=0.5,$dst_w=null,$dst_h=null,$isReservedSource=false){
//    $filename="des_big.jpg";
    list($src_w,$src_h,$imagetype)=getimagesize($filename);
    $mime=image_type_to_mime_type($imagetype);
//    echo $mime;

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