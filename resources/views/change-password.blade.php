<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
</head>
<style>
    form {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    input{
        outline: none;
        padding: 12px 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 24px;
    }
</style>
<body style="font-family: Arial, sans-serif">
<div style="max-width: 600px; margin: 0 auto">
    <h1 style="color: #1B75F2">Sweete</h1>
    <p style="font-size: 18px">Change Password</p>
    <hr/>
    <br/>
    <form method="POST" action="{{ route('confirmForgotPassword',['user_id' => $user_id]) }}">
        @csrf
        <div class="form-group">
            <label for="new-password">New password</label>
            <input id="new-password" name="new-password" type="password">
            @error('new-password')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input id="confirm-password" name="confirm-password" type="password">
            @error('confirm-password')
            <div style="color: red; font-size: 14px;">{{ $message }}</div>
            @enderror
        </div>
        <button style="padding: 10px 16px; border: 1px solid #1B75F2; background-color: white; color: #1B75F2; border-radius: 6px; font-size: 18px;cursor: pointer">
            Update password
        </button>
    </form>
</div>
</body>
</html>
