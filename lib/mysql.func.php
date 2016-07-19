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
    $conn=connect();
    $keys="".join(",",array_keys($array));
    $vals="'".join("','",array_values($array))."'";
//INSERT INTO shop_admin (username,password,email)VALUES (xxx,root,512309453@qq.com);
    $sql="INSERT INTO {$table} ({$keys})VALUES ({$vals})";
//    $sql="insert {$table}{$keys} values {$vals}";
    if ($conn->query($sql) === TRUE) {
//        echo "新记录插入成功";
        return null;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return $sql;
    }
//    return $result->fetch_assoc();
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
}
/*查找操作,获取所有记录*/
function fetchAll($sql,$result_type=MYSQLI_ASSOC){
    $conn=connect();
    $result=$conn->query($sql);
//    while(@$row=mysqli_fetch_array($result,$result_type)){
//        $rows[]=$row;
//    }
//    $rows=[];
    if ($result->num_rows > 0) {
        // 输出每行数据
        while($row = $result->fetch_assoc()) {
            $rows[]=$row;
//            return $row;
        }
    } else {
        echo "0 个结果";
    }
    return $rows;
}
/*获取记录条数*/
function getResultNum($sql){
    $conn=connect();
    $result=$conn->query($sql);
//    $result=mysqli_query($sql);
    $totalRows=$result->num_rows;
//    print_r($totalRows);
    return $totalRows;
}