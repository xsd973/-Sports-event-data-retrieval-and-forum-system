<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();


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
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/login.css">
    <link href="./images/logo.png" rel="icon" type="image/x-icon" />
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
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
                    <li class="active">
                        <a href="#" style="background-color: white;">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a href="personal.php">个人空间 </a>
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
<?php
$html1=<<<a
            <li>
                <a href="logout.php">注销</a>
            </li>
a;
$html2=<<<a
                    <li>
                        <a href="register.php">注册</a>
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

a;
if(!$member_id=is_login($link)){
	echo $html2;
}else{
    echo $html1;
}
?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!--轮播图-->
    <div class="container" id="slideshow">
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel slide" id="carousel-example-generic" data-ride="carousel" data-interval="3000">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" id="slideshow-img">
                        <div class="item active">
                            <img src="img/index/news1.jpg">
                            <div class="carousel-caption">
                                <h2 id="describe">暂时停止外国人入境 中超外教外援们都回来了吗?</h2>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/index/news2.jpg">
                            <div class="carousel-caption">
                                <h2 id="describe">英超第29轮：曼联2-0曼城</h2>
                            </div>
                        </div>
                        <div class="item">
                            <img src="img/index/news3.png">
                            <div class="carousel-caption">
                                <h2 id="describe">罗体：利物浦也有意竞争瓦伦小将费兰-托雷斯</h2>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--内容-->
    <div class="container" style="margin-top: 50px;width: 80%;">
        <div class="row">
            <!--新闻-->
            <div class="col-lg-3" id="news">
                <h3>新闻|news</h3>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="news.php">&nbsp;国际足联宣布世界杯延期</a>
                </p>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="#">&nbsp;国际足联宣布世界杯延期</a>
                </p>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="#">&nbsp;国际足联宣布世界杯延期</a>
                </p>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="#">&nbsp;国际足联宣布世界杯延期</a>
                </p>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="#">&nbsp;国际足联宣布世界杯延期</a>
                </p>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="#">&nbsp;国际足联宣布世界杯延期</a>
                </p>
                <p><span class="label label-default">3.15</span>
                    <a href="#">&nbsp;武磊目前恢复状态良好</a>
                </p>
                <p><span class="label label-default">3.18</span>
                    <a href="#">&nbsp;国际足联宣布世界杯延期</a>
                </p>
            </div>
            <div class="col-md-12 col-lg-8 col-lg-offset-1" id="playerStatus">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h3>球员身价|Player's status</h3>

                        <p class="top"><img src="img/index/1.png"><a href="#">内马尔</a><span class="text-center" id="right">1.8亿欧元</span><span class="text-center" id="right">巴西</span><span class="text-center" id="right">巴黎圣日耳曼</span></p>
                        <p class="top"><img src="img/index/2.png"><a href="#">梅西</a><span class="text-center" id="right">1.8亿欧元</span><span class="text-center" id="right">阿根廷</span><span class="text-center" id="right">巴塞罗那</span></p>
                        <p class="top"><img src="img/index/3.png"><a href="#">穆罕默德·萨拉赫</a><span class="text-center" id="right">1.5亿欧元</span><span class="text-center" id="right">埃及</span><span class="text-center" id="right">利物浦</span></p>
                        <p>&nbsp;<span class="label label-default">4</span><a href="#">&nbsp;凯文·德布劳内</a><span class="text-center" id="right">1.5亿欧元</span><span class="text-center" id="right">比利时</span><span class="text-center" id="right">曼城</span></p>
                        <p>&nbsp;<span class="label label-default">5</span><a href="#">&nbsp;基利昂•姆巴佩</a><span class="text-center" id="right">1.2亿欧元</span><span class="text-center" id="right">法国</span><span class="text-center" id="right">摩纳哥</span></p>
                        <p>&nbsp;<span class="label label-default">6</span><a href="#">&nbsp;保罗·迪巴拉</a><span class="text-center" id="right">1.1亿欧元</span><span class="text-center" id="right">阿根廷</span><span class="text-center" id="right">尤文图斯</span></p>
                    </div>
                </div>
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <div class="col-md-12 col-lg-12">
                        <h3>近期重要赛程|Importanct race</h3>
                        <p>&nbsp;<span class="label label-default">6.04</span>&nbsp;&nbsp;&nbsp;&nbsp;第24轮<span class="text-center" id="raceRight">不莱梅</span><span class="text-center" id="score">0-3</span><span class="text-center" id="raceRight">法兰克福</span></p>
                        <p>&nbsp;<span class="label label-default">6.02</span>&nbsp;&nbsp;&nbsp;&nbsp;第29轮<span class="text-center" id="raceRight">科隆</span><span class="text-center" id="score">2-4</span><span class="text-center" id="raceRight">RB莱比锡</span></p>
                        <p>&nbsp;<span class="label label-default">6.01</span>&nbsp;&nbsp;&nbsp;&nbsp;第29轮<span class="text-center" id="raceRight">帕德博恩</span><span class="text-center" id="score">1-6</span><span class="text-center" id="raceRight">多特蒙德</span></p>
                        <p>&nbsp;<span class="label label-default">5.31</span>&nbsp;&nbsp;&nbsp;&nbsp;第29轮<span class="text-center" id="raceRight">门兴</span><span class="text-center" id="score">4-1</span><span class="text-center" id="raceRight">柏林联合</span></p>
                        <p>&nbsp;<span class="label label-default">5.31</span>&nbsp;&nbsp;&nbsp;&nbsp;第29轮<span class="text-center" id="raceRight">拜仁</span><span class="text-center" id="score">5-0</span><span class="text-center" id="raceRight">杜塞尔多夫</span></p>
                        <p>&nbsp;<span class="label label-default">5.30</span>&nbsp;&nbsp;&nbsp;&nbsp;第29轮<span class="text-center" id="raceRight">沃尔夫斯堡</span><span class="text-center" id="score">1-2</span><span class="text-center" id="raceRight">法兰克福</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--底部-->
    <div class="container" id="bottom">
        <p class="text-center">关于我们
            <a>@一球成名项目组</a>
        </p>
        <p class="text-center">加入我们
            <a>体育赛况小组</a>
        </p>
    </div>
</body>

</html>