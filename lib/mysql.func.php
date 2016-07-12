<?php
/**
 * 数据库相关
 * @authors Your Name (you@example.org)
 * @date    2016-07-10 16:41:59
 * @version $Id$
 */
/*数据库连接操作*/
function connect(){
//    mysql.connect("localhost","root","" or die("数据库连接失败Error：".mysql_errno().":".mysql_error()));
//    $link=mysqli.connect("localhost","root","" or die("数据库连接失败Error：".mysqli_errno().":".mysqli_error()));
//    $link=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
    $link= new mysqli(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
// 检测连接
    if ($link->connect_error) {
        die("连接失败: " . $link->connect_error);
    }
    return $link;

}
/*数据库插入操作*/
function insert($table,$array){
    $keys=join("",array_keys($array));
    $vals="".join("",array_values($array))."";
    $sql="insert {$table}{$keys} values {$vals}";
    mysqli_query($sql);
    return mysqli_insert_id();
}
/*数据库更新操作
*update shop_admin set username= "king" where id=1*/
function update($table,$array,$where=null){
    foreach ($array as $key=>$val){
        if($str==null){
            $sep="";
        }else{
            $sep=",";
        }
        $str.=$sep.$key."='".$val."'";//username="king"
        $sql="update {$table} set {$str}".($where==null?null:"where").$where;
        mysqli_query($sql);
        return mysqli_affected_rows();
    }
}
/*删除操作*/
function delete($table,$where=null){
    $where=$where==null?null:"where".$where;
    $sql="delete from {$table}{$where}";
    mysqli_query($sql);
    return mysqli_affected_rows();
}
/*查找操作,查找一条记录*/
function fetchOne($sql,$result_type=MYSQLI_ASSOC){
    $result=mysqli_query(connect(),$sql);
    if ($result->num_rows > 0) {
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
//            echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["password"];
            return $row;
        }
    } else {
        echo "0 个结果";
    }
//    echo "row:".$row."end";

}
/*查找操作,获取所有记录*/
function fetchAll($sql,$result_type=MYSQLI_ASSOC){
    $result=mysqli_query($sql);
    while(@$row=mysqli_fetch_array($result,$result_type)){
        $rows[]=$row;
    }
    return $rows;
}
/*获取记录条数*/
function getResultNum($sql){
    $result=mysqli_query($sql);
    return mysql_num_rows($result);
}