<?php
//POST数据库接收
$servername =$_POST["db_host"];
$username =$_POST["db_user"];
$password =$_POST["db_password"];
$database=$_POST["db_name"];
//POST接收网站数据
$web_title=$_POST["web_title"];//获取网站标题
$web_keyword=$_POST["web_keyword"];//获取网站标题
$web_description=$_POST["web_description"];//获取网站标题
//管理员信息获取
$admin_user=$_POST["admin_user"];
$admin_password=md5($_POST["admin_password"]);
$admin_qq=$_POST["admin_qq"];
$admin_email=$_POST["admin_email"];
//数据库文件处理
$_sql = file_get_contents('localhost.sql');
$_arr = explode(';', $_sql);//sql文件分割
//连接数据库
$conn =new mysqli($servername,$username,$password,$database);
//设置编码
$conn->set_charset("utf-8");
// 判断是否连接成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
//遍历执行sql语句
foreach ($_arr as $_value) {
$conn->query($_value.';');
}
//修改网站配置信息
$sql1="UPDATE xs_websystem SET web_title='{$web_title}',web_keyword='{$web_keyword}',web_description='{$web_description}' WHERE ID=1";
$result1=$conn->query($sql1);
//修改管理员信息
$sql2="UPDATE xs_admin SET username='{$admin_user}',password='{$admin_password}',QQ='{$admin_qq}',email='{$admin_email}' WHERE id=0";
$result2=$conn->query($sql2);
if($result1&&$result2)
{
header('location:successful.html');
$conn->close();
}else{
header('location:failure.html');
$conn->close();
}

?>