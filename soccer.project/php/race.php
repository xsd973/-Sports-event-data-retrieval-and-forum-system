<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'page.php';
$link=connect();


if($_GET['country']!=''){
    $country = $_GET['country'];
}else{
    $country = 'england';
};

$bisai = array(
    'england'=>array('英超'),
    'spain'=>array('西甲'),
    'italy'=>array('意甲'),
    'france'=>array('法甲'),
    'germany'=>array('德甲')
);

$ct="select count(*) from {$country}";
$count=num($link,$ct);
$page=page($count,20,5);

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名|赛程</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/race.css" />
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="css/login.css">
    <link href="./images/logo.png" rel="icon" type="image/x-icon" />
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
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
                    <li>
                        <a href="index.php">首页 <span class="sr-only">(current)</span></a>
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
                    <li class="active">
                        <a href="race.php" style="background-color: white;">赛程</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="关键字">
                    </div>
                    <button type="submit" class="btn btn-default">查询</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
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
                                        <div class="login-input1">
                                            <input type="text" placeholder="手机/邮箱/用户名" name="">
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
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!--标题及赛事选择-->
		<div class="container">
			<div class="row">
				<div class="col-lg-7" id="title">
					<h1>赛程赛果</h1>
				</div>
				<div class='col-lg-5'>
					<div class="page-header" style="padding: 0px;border: 0px;margin: 20px;">
						<div class="form-horizontal">
							<div class="control-label col-lg-2">
								赛事:
							</div>
							<div class="col-lg-7">
								<select class="form-control" onchange="selectOnchang(this.options[this.options.selectedIndex].value)">
									<option value="england" <?php if($country=='england'){echo 'selected';}?>>英超</option>
									<option value="italy" <?php if($country=='italy'){echo 'selected';}?>>意甲</option>
									<option value="germany" <?php if($country=='germany'){echo 'selected';}?>>德甲</option>
									<option value="spain" <?php if($country=='spain'){echo 'selected';}?>>西甲</option>
									<option value="france" <?php if($country=='france'){echo 'selected';}?>>法甲</option>
                                    
                                    
                                    
								<select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


    <!--赛程详情-->
    <div class="container">
        <div class="row news" style="border-top: 4px solid gainsboro;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">
                            时间
                        </th>
                        <th class="text-center">
                            比赛
                        </th>
                        <th class="text-center">
                            主队
                        </th>
                        <th class="text-center">
                            比分
                        </th>
                        <th class="text-center">
                            客队
                        </th>
                        <th class="text-center">
                            详情
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $pai="SELECT * from {$country} ORDER BY id Desc {$page['limit']}";
                    $jieg=execute($link,$pai);
                    while($data=mysqli_fetch_assoc($jieg)){
                        if($data['id']%2==1){
$html=<<<a
                    <tr class="success">
                        <th class="text-center">
                            {$data['date']}
                        </th>
                        <th class="text-center">
                            英超
                        </th>
                        <th>
                            <span id="right"><a href="#">{$data['Hteam']}</a></span>
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['vs']}</span>
                        </th>
                        <th>
                            <span id="left"><a href="#">{$data['Gteam']}</a></span>
                        </th>
                        <th class="text-center">
                            详情
                        </th>
                    </tr>

a;
echo $html;
                        }else{
$html=<<<a
                    <tr>
                        <th class="text-center">
                            {$data['date']}
                        </th>
                        <th class="text-center">
                            英超
                        </th>
                        <th>
                            <span id="right"><a href="#">{$data['Hteam']}</a></span>
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['vs']}</span>
                        </th>
                        <th>
                            <span id="left"><a href="#">{$data['Gteam']}</a></span>
                        </th>
                        <th class="text-center">
                            详情
                        </th>
                    </tr>

a;
echo $html;
                        }
                    }

?>
                    
                    
                </tbody>
            </table>
            <div class="playerPage">
                        <ul class="pagination">
                        <li><?php
    										$page=page($count,20,5);
    										echo $page['html'];
    									?></li>
                        </ul>
                    </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src=" js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript">
        $('.form_date').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    </script>
    <!--bootstrap检测工具
		<script>
			(function() {
				var s = document.createElement("script");
				s.onload = function() {
					bootlint.showLintReportForCurrentDocument([]);
				};
				s.src = "js/bootlint.min.js";
				document.body.appendChild(s);
			})();
		</script>-->
<script type="text/javascript">   
    function selectOnchang(v){   
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.open('get', 'race.php?country='+v);
        ajaxObj.send();
        ajaxObj.onreadystatechange = function () {
            // 为了保证 数据 完整返回，我们一般会判断 两个值
            if (ajaxObj.readyState == 4 && ajaxObj.status == 200) {
                // 如果能够进到这个判断 说明 数据 完美的回来了,并且请求的页面是存在的
                // 5.在注册的事件中 获取 返回的 内容 并修改页面的显示
                console.log('数据返回成功');

                // 数据是保存在 异步对象的 属性中
                console.log(ajaxObj.responseText);

                // 修改页面的显示
                window.location.href = 'race.php?country='+v;
            }
        }
    }   
</script>  


</body>

</html>