<?php
/**
 * @Author: anchen
 * @Date:   2018-02-07 21:23:43
 * @Last Modified by:   anchen
 * @Last Modified time: 2018-02-07 22:57:03
 */
define("TOKEN", "weixin");
include dirname(dirname(dirname(__FILE__)))."/core/WeChatApi.class.php";
include dirname(dirname(dirname(__FILE__)))."/core/WeChat.class.php";

$WeChat = new WeChat();
$url = "https://www.bingeblog.xin/wechat/userinfo.php";
$url = WeChatApi::setAccess($url);

// $code = $_GET['code'];

echo $url;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bin客绑定</title>

    <style>
        body {
            min-width: 320px;
            max-width: 640px;
            font-size: 16px;
            margin: 0 auto;
        }

        .bg {
            position: fixed;
            top: 0;bottom: 0;left: 0;right: 0;
            z-index: -1;
            background-color: #00c4ff;
        }

        .banner {
            padding: 20px 0;
            background-color: #ffe4c4;
        }
        form{
            padding: 1.48rem 0;
        }
        .input-contain{
            padding: 0.48rem 0.24rem;
            text-align: center;
        }
        .input-contain span{
            /* display: inline-block; */
            width: 1.6rem;
            font-size: 20px;
            text-align: right;
        }
        .input{
            display: inline-block;
            width: 160px;
            padding: 0.15rem 0.2rem;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        input[type=submit]{
            color:#fff;
            background-color: #379812;
            padding: 0.16rem 0.4rem;
            font-size: 18px;
            outline: none;
            border-radius: 5px;
            border:1px solid #288812;
        }
        select[name=block]{
            width: 185px;
            height: 40px;
            padding: 5px;
            font-size: 18px;
        }
    </style>
    <!--End style.css-->
</head>
<body id='container' >
<!--Start main-btn-->
<div class="bg" style="background-image: url({C('URL')}/images/timg.jpg);background-size: cover;"></div>
<main class="wait">
    <div id="wrap">
        <div class="banner">
            <h3>Bin客绑定</h3>
        </div>
        <form action="{U('')}">
            <div class="input-contain clearfix">
                <span>账号：</span><input type="text" name="username" class="input">
            </div>
            <div class="input-contain clearfix">
                <span>密码：</span><input type="text" name="pwd" class="input">
            </div>
            <div><input type="submit" class="sub" value="登录"></div>
        </form>
    </div>
</main>
<!--End main-btn-->
<!--Start jquery-weui-->
<script src="{C('URL')}/public/home/js/jQuery.js"></script>
<!--End jquery-weui-->

<script>
    var doc = document,
        win = window,
        oBody = doc.documentElement || doc.body,
        resize = "onorientationchange" in win ? "orientationchange" : "resize";
    rem();
    addEventListener(resize, rem, false);
    function rem() {
        /*doc.body.clientWidth是获取当前的body的宽度，640是我们的移动端的最大宽度，相除就会得出一个比例，在乘以100px，就会得出我们当前的1rem等于多少px*/
        oBody.style.fontSize = 100 * (doc.body.clientWidth / 640) + "px";
        //console.log(oBody.style.fontSize);
    }
</script>
<script>
    function checkData(){
        if( $('select[name=username]').val() == '' ){
            alert('账号不能为空');
            return false;
        }
        if( $('input[name=pwd]').val() == '' ){
            alert('密码不能为空');
            return false;
        }
        return true;
    }
    $('.sub').click(function(e){
        e.preventDefault();
        if( !checkData() ){
            return false;
        }
        var data = $('form').serializeArray();

        $.ajax({
            url: '{U("index")}',
            data: data,
            type: 'POST',
            dataType: 'json',
            success:function(res){
                if(res.code == 0){
                    window.location.href = "{:U('Subject/index')}";
                }else if(res.code == 1){

                }else{

                }
            }
        });

    });
</script>
</body>
</html>