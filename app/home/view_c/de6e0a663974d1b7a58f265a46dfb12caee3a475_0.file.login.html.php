<?php
/* Smarty version 3.1.29, created on 2018-04-02 15:54:52
  from "D:\Apache24\htdocs\binBlog\app\home\view\public\login.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ac1e1cc855cf9_39402245',
  'file_dependency' => 
  array (
    'de6e0a663974d1b7a58f265a46dfb12caee3a475' => 
    array (
      0 => 'D:\\Apache24\\htdocs\\binBlog\\app\\home\\view\\public\\login.html',
      1 => 1522655680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ac1e1cc855cf9_39402245 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo C('URL');?>
/public/admin/css/app.css" />
</head>
<body>
<div class="loginform" style="margin-top: 20px;">
    <div class="title" style="background-color: #0165ad;"><span class="logo-text font18">Bin客美食</span></div>
    <div class="body" style="background-color: #fff; border:1px solid black;">
      <form id="form1" name="form1" method="post" action="<?php echo U('');?>
">
        <label class="log-lab">账号</label>
        <input name="username" type="text" class="login-input-user" style="background-color: #fff;"  id="textfield" value=""/>
        <label class="log-lab">密码</label>
        <input name="pwd" type="password" style="background-color: #fff;"  class="login-input-pass" id="textfield" value=""/>
            <label class="log-lab">验证码</label>
            <div class="padding-bottom5"><img src="<?php echo C('URL');?>
/index.php?p=admin&m=privilege&a=captcha" id="img" width="300" height="170"></div>
            <input name="code" type="text" class="login-input-user" id="textfield" value=""/>
            <label class="log-lab" style=""><input type="checkbox" style="" name="rm7" value="yes"> 7天内自动登录</label>
        <input type="submit" name="button" id="button" value="登录" class="button" style="background-color: #0165ad;"/>
      </form>
    </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
document.getElementById('img').onclick = function (){

  this.src = "<?php echo C('URL');?>
/index.php?p=home&m=public&a=code&n="+Math.random();
};

<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
