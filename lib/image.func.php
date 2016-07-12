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