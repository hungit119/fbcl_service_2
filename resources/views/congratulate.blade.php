<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Congratulate</title>
</head>
<body style="font-family: Arial,sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; overflow: hidden">
    <div style="max-width: 600px; max-height: 600px ;display: flex; flex-direction: column; align-items: center; border-radius: 8px; border: 1px solid #ccc; padding: 24px 48px;">
        <h1 style="color: #1B75F2;margin: 0">Sweete</h1>
        <br/>
        <h3 style="margin: 0">Thành công</h3>
        <p>Mật khẩu của bạn đã được cấp nhật</p>
        <img src="{{URL::asset('/image/check.png')}}" alt="profile Pic" height="100" width="100">
        <br/>
        <a href="{{$url}}" style="display: block;text-align: center;text-decoration: none; width: 100%; background-color: #1B75F2;color: white; font-weight: 600;padding: 8px 0; border-radius: 8px; border: 0; outline: none">Về trang chủ</a>
    </div>
</body>
</html>
