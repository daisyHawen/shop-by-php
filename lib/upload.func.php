<?php
/**
 * 文件上传
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 16:42:43
 * @version $Id$
 */

function uploadFile($fileInfo,$allowExt=array('gif','jpeg','jpg','png','wbmp'),$maxSize=1048576,$imgFlag=true){
    //判断错误信息
    print_r($fileInfo);
    if($fileInfo['error']==UPLOAD_ERR_OK){
        $ext=getExt($fileInfo['name']);
        //判断非法类型
        if(!in_array($ext,$allowExt)){
            exit('非法文件类型');
        }
        //限制上传文件大小
        if($fileInfo['size']>$maxSize){
            exit("文件过大");
        }
        //验证是否是真正的图片类型
        if($imgFlag){
            $info=getimagesize($fileInfo['tmp_name']);
            if(!$info) {
                exit('不是真正的图片类型');
            }
        }
        //文件是否是通过HTTP POST方式上传的
        if(is_uploaded_file($fileInfo['tmp_name'])){
            $filename=getUniName().".".$ext;
            $path='uploads';
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
            $destination=$path."/".$filename;
            if(move_uploaded_file($fileInfo['tmp_name'],$destination)){
                $mes="文件上传成功";
            }
        }
        else{
            $mes="文件上传失败";
        }
    }else{
        switch ($fileInfo['error']){
            case 1:
                $mes="UPLOAD_ERR_INI_SIZE";
                break;
            case 2:
                $mes="UPLOAD_ERR_FORM_SIZE";
                break;
            case 3:
                $mes="UPLOAD_ERR_PARTIAL";
                break;
            case 4:
                $mes="UPLOAD_ERR_NO_FILE";
                break;
            case 6:
                $mes="UPLOAD_ERR_NO_TMP_DIR";
                break;
            case 7:
                $mes="UPLOAD_ERR_CANT_WRITE";
                break;
            case 8:
                $mes="UPLOAD_ERR_EXTENSION";
                break;
            case 9:
                $mes="U_PARSE_ERROR";
                break;
        }
    }
    echo $mes;
}