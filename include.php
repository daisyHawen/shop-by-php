<?php
session_start();
define("ROOT",dirname(__FILE__));
//在包含在lib下的文件和core下面的文件就可以直接引入，不需要再写路径
set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.get_include_path());

require_once 'configs.php';
require_once 'image.func.php';
require_once 'common.func.php';
require_once 'string.func.php';
require_once 'mysql.func.php';
require_once 'page.func.php';
require_once 'admin.inc.php';
require_once 'cate.inc.php';