<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();//连接数据库

if($member_id=is_login($link)){
	echo"<script>alert('你已经登录，请不要重复登录注册！');window.location.href='./index.php';</script>";
}

if(isset($_POST['button'])){
    $link=connect();
    escape($link,$_POST);//进行转义，防止乱码
    $userPass=$_POST['password'];
    $query="select * from member where email='{$_POST['email']}' and password='".md5($userPass)."'"; //查询账户信息
	$result=execute($link,$query);
	$data=mysqli_fetch_assoc($result);
	//下面为判断登录时的各种状况
    if(empty($_POST['email'])){
        echo"<script>alert('邮箱不得为空！');window.location.href='register.php';</script>";
    }
    if(empty($_POST['password'])){
        echo"<script>alert('密码不得为空！');window.location.href='register.php';</script>";
    }
    // if (isset($_REQUEST['code_num'])) {
	// 	session_start();
 
	// 	if (strtolower($_REQUEST['code_num'])==$_SESSION['code_num']) {
			
	// 	}else{
	// 		echo"<script>alert('验证码错误，请重新输入！');window.location.href='login.php';</script>";
    //     }
	// }
    if(mysqli_num_rows($result)==1){
		setcookie('member[email]',$_POST['email']);
		setcookie('member[pw]',md5($_POST['password']));
		echo"<script>alert('登录成功！');window.location.href='index.php';</script>";
    }else{
		echo"<script>alert('邮箱或密码错误，请重试！');window.location.href='register.php';</script>";
    }
    
}

if(isset($_POST['submit'])){
    $link=connect();
    include 'inc/check_register.inc.php';
    $_POST=escape($link,$_POST);
    $query="insert into member(user,email,password,register_time) values('{$_POST['user']}','{$_POST['email']}',md5('{$_POST['password']}'),now())";//将用户信息存进数据库中
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
		echo"<script>alert('注册成功，请重新登录！');window.location.href='register.php';</script>";
    }else{
		echo"<script>alert('注册失败,请重试！');window.location.href='register.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名-注册</title>

    <!-- Bootstrap -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="./bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>

    <!-- 这里有变化 -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/register.css">
    <link href="./images/logo.png" rel="icon" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!-- 到这里 -->

</head>


<body class="regi-bg">
    <!--导航条-->
    <nav class="navbar navbar-default" style="background-color: #BCD68D;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <!--<div class="navbar-header">
                        <a class="navbar-header" href="#">首页</a>
                    </div>-->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php" class="logo"></a>
                    </li>
                    <li>
                        <a href="index.php">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a href="./personal.php">个人空间 </a>
                    </li>
                    <li>
                        <a href="statistics.php">数据统计</a>
                    </li>
                    <li>
                        <a href="analysis.php">数据分析</a>
                    </li>
                    <li>
                        <a href="race.php">赛程</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="关键字">
                    </div>
                    <button type="submit" class="btn btn-default">查询</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="./register.php" style="background-color: white;">注册</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal">登录</a>
                    </li>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span><span class="sr-only">关闭</span>
                                                        </button>
                                    <h4 class="modal-title" id="myModalLaber">
                                        用户名密码登录
                                    </h4>
                                    
                                    <div class="login-all">
                                        <form action="" method="post">
                                            <div class="login-input1">
                                                <input type="text" placeholder="邮箱" name="email">
                                            </div>
                                            <div class="login-input2">
                                                <input type="password" placeholder="密码" name="password">
                                            </div>
                                            
                                                <div class="form-check">
                                                    <label class="form-check-label login-auto">
                                                            <input type="checkbox" value=""> 下次自动登录
                                                        </label>
                                            
                                            </div>
                                            <button class="login-btn" name="button">登录</button>
                                            <div class="forget-psw">
                                                <a href="#">忘记密码？</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="login-others-way">
                                        <div class="login-others-word">社交账号登录：</div>
                                        <div class="share-cpt">
                                            <div class="share-sina"></div>
                                            <div class="share-wechat"></div>
                                            <div class="share-qq"></div>
                                            <div class="share-dou"></div>
                                        </div>
                                    </div>
                                    <a href="./register.php" class="btn btn-success">立即注册</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div id="form" class="regi-all">
        <h1>欢迎注册</h1>
        <div class="regi-word">已有账号？&nbsp;</div>
        <li>
            <a href="#" data-toggle="modal" data-target="#myModal">登录</a>
        </li>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span><span class="sr-only">关闭</span>
                            </button>
                        <h4 class="modal-title" id="myModalLaber">
                            用户名密码登录
                        </h4>
                        <div class="login-all">
                            <div class="login-input1">
                                <input type="text" placeholder="邮箱/用户名" name="">
                            </div>
                            <div class="login-input2">
                                <input type="password" placeholder="密码">
                            </div>
                            <form>
                                <div class="form-check">
                                    <label class="form-check-label login-auto">
                                    <input type="checkbox" value=""> 下次自动登录
                                  </label>
                            </form>
                            </div>
                            <div class="login-btn">登录</div>
                            <div class="forget-psw">
                                <a href="#">忘记密码？</a>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="login-others-way">
                            <div class="login-others-word">社交账号登录：</div>
                            <div class="share-cpt">
                                <div class="share-sina"></div>
                                <div class="share-wechat"></div>
                                <div class="share-qq"></div>
                                <div class="share-dou"></div>
                            </div>
                        </div>
                        <a href="./register.html" class="btn btn-success">立即注册</a>
                    </div>
                </div>
            </div>
        </div>
    <form action="" method="post">
        <div>
            <div>
                &nbsp;&nbsp;&nbsp;&nbsp;用户名
                <input id="username" type="text" name="user" class="regi-input" placeholder="请设置用户名 ">
                <small>请输入至少3个字符</small>
            </div>

            <div>
                邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱
                <input id="email" type="email" name="email" class="regi-input" placeholder="可用于登录和找回密码">
                <small>请输入正确的邮箱格式</small>
            </div>
            <div>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码
                <input id="password" type="password" name="password" class="regi-input" placeholder="请输入密码">
                <small>请输入至少6个字符</small>
            </div>
            <div>
                确认密码
                <input id="password2" type="password" name="password2" class="regi-input" placeholder="请输入确认密码">
                <small>请输入至少6个字符</small>
            </div>
    
            <button class="regi-btn" name="submit">注册</button>
        </div>
    </form>
    </div>
</body>

</html>