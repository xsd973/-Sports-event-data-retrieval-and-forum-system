<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/upload.php';
$link=connect();
if(!$member_id=is_login($link)){
	echo"<script>alert('请登录之后再进行头像修改！');window.location.href='login.php';</script>";
    skip('login.php','','请登录');
}
$a="select * from member  where id={$member_id}";
$b=execute($link,$a);
$c=mysqli_fetch_assoc($b);

if(isset($_POST['submit'])){
	$save_path='photo'.date('/Y/m/d');
	$upload=upload($save_path,'2M','photo');
	if($upload['return']){
		$query="update member set toux='{$upload['save_path']}' where id={$member_id}";
		execute($link,$query);
		if(mysqli_affected_rows($link)==1){
			echo"<script>alert('头像设置成功！');window.location.href='personal.php';</script>";
    		skip('personal.php','ok','头像设置成功！');
		}else{
			echo"<script>alert('头像设置失败！');window.location.href='personal.php';</script>";
    		skip('imgupload.php','error','头像设置失败！');
		}
	}else{
        echo"<script>alert(\"".$upload['error']."\");window.location.href='imgupload.php';</script>";
    	skit('imgupload.php','error',$upload['error']);
	}
}
?>
    <!DOCTYPE html>
    <html lang="zh">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/fontawesome/all.min.css" />
        <script src="js/plugins/jQuery/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
        <style type="text/css">
            * {
                box-sizing: border-box;
                color: gray;
            }
            
            .box {
                height: 500px;
                width: 650px;
                background-color: white;
                margin: 0 auto;
                position: relative;
                top: 150px;
                text-align: center;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                border-radius: 10px;
            }
            
            .left,
            .right {
                width: 300px;
                height: 300px;
                overflow: hidden;
                margin: 10px;
                padding: 110px;
                text-align: center;
            }
            
            .right {
                border-left: 2px solid darkgray;
                text-align: center;
                padding: 40px 60px;
            }
            
            .local {
                height: 180px;
                width: 180px;
                border: 1px solid gray;
                border-radius: 50%;
                overflow: hidden;
            }
            
            #upload {
                display: none;
            }
            
            button {
                background-color: rgb(3, 155, 255);
                border: none;
                outline: none;
                color: white;
                width: 160px;
                height: 40px;
                border-radius: 5px;
            }
            
            button:hover {
                opacity: 0.8;
                cursor: pointer;
            }
        </style>
    </head>

    <body style="background-color:powderblue;">
        <div class="main">
            <div style="float: right;font-size: 45px;position: absolute;right: 100px; top: 42px;">
                <a class="fa fa-window-close" href="personal.php"></a>
            </div>
            <div class="box">
                <div class="left">
                    <img src="img/preloader.gif" height="80px" width="80px">
                    <h5 style="position: relative;">点击选择头像</h5>
                </div>
                <div class="right">
                    <div class="local">
                        <img src="<?php if($c['toux']!=''){echo $c['toux'];}else{ echo './images/author1.jpg';}?>" height="180px" width="180px">
                    </div>
                    <h3>当前头像</h3>
                </div>
                <p>
                    请选择图片上传，大小180×180像素支持JPG、PNG等格式，图片需小于2M
                </p>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="photo" id="upload" value="" />
                    <button type="submit" class="btn" name="submit">
						更新
					</button>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $("document").ready(function() {
                $(".left").click(function() {
                    $("#upload").click();
                });
            });
        </script>
    </body>

    </html>