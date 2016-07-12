<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 16:44:49
 * @version $Id$
 */
function alertMes($mes,$url){
    echo "<script>alert('{$mes}');</script>";
    echo "<script>window.location.href='{$url}';</script>";
}