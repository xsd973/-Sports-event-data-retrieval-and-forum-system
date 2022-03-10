<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();

if ($_POST['count']==1){
    $query="insert into dianz(news_id,user_id) values('{$_POST['news_id']}','{$_POST['member_id']}')";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        echo"点赞成功！";
    }
}else{
    $query="delete from dianz where news_id={$_POST['news_id']} and user_id={$_POST['member_id']}";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
        echo"取消点赞！";
    }
}
?>