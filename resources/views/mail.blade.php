<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên mật khẩu</title>
</head>
<body style="font-family:Arial ,serif">
    <div style="max-width: 600px; margin: 0 auto">
        <h1 style="color: #1B75F2">Sweete</h1>
        <hr/>
        <div>
            <p>Xin chào {{$fullname}},</p>
            <br/>
            <p>Chúng tôi đã nhận được yêu cầu quên mật khẩu Sweete của bạn,</p>
            <p>Nhập mã đặt lại mật khẩu sau đây:</p>
            <br/>
            <span style="background-color: #E7F3FF;color: black; border-radius: 8px;border: 1px solid #1B75F2;padding: 12px 18px; font-weight: 600">
                {{$code}}
            </span>
            <p style="margin-top: 48px">Ngoài ra bạn có thể đổi mật khẩu của mình.</p>
            <a target="_blank" href="{{$url}}" style="display: block;text-align: center;text-decoration: none; width: 100%; background-color: #1B75F2;color: white; font-weight: 600;padding: 8px 0; border-radius: 8px; border: 0; outline: none">Đổi mật khẩu</a>
        </div>
    </div>
</body>
</html>
