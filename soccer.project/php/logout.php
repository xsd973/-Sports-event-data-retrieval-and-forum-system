<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
if(!$member_id){
    echo"<script>alert('你未登录，请不需要退出！');window.location.href='login.php';</script>";
    skip('loginadmin.php','error','你未登录，请不需要退出！');
}


        setcookie('member[name]','',time()-6000);
        setcookie('member[pw]','',time()-6000);
        echo"<script>alert('退出成功！');window.location.href='index.php';</script>";
        skip('login.php','ok','退出成功！');
 
//退出登录代码

?>