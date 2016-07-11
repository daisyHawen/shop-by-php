<?php
/**
 * 与字符串相关
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 16:41:33
 * @version $Id$
 */
//产生随机字符串

function builRandomString($type,$length)
{
    if ($type == 1) {
        $chars = join("", range(0, 9));
    } elseif ($type == 2) {
        $chars = join("", array_merge(range('a', 'z'), range('A', 'Z')));
    } elseif ($type == 3) {
        $chars = join("", array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9)));
    }
    if ($length > strlen($chars)) {
        exit("字符串长度不够");
    }
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}