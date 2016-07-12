<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/12
 * Time: 10:49
 */
function checkAdmin($sql){
    return fetchOne($sql);
}