<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>管理员登陆 | wfhshop</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="stylesheet" href="{{ asset('amaze/css/amazeui.min.css') }}"/>

  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>wfhshop</h1>
    <p>infynity</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>管理员登录</h3>
    <hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form method="POST" action="/auth/login" class="am-form">
      {!! csrf_field() !!}
      <label for="email">邮箱:</label>
      <input type="email" name="email" id="email" value="infynity@163.com">
      <br>
      <label for="password">密码:</label>
      <input type="password" name="password" id="password">

      <br>
      <label for="remember-me">
        <input type="checkbox" name="remember">

        记住密码

      </label>
      <br />
      <div class="am-cf">
        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
        <a href="/password/email" class="am-btn am-btn-default am-btn-sm am-fr">忘记密码 ^_^?</a>
          <a href="javascript:void(0);" class="am-btn am-btn-danger am-btn-sm am-fr">密码：见简历</a>
      </div>
    </form>
    <hr>
    <p>© Copyright 2015-20xx infynity版权所有</p>
  </div>
</div>
</body>
</html>
