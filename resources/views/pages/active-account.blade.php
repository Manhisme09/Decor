<!doctype html>
<html lang="en">

<head>
    <title>Gửi Email | Nội thất Furnibuy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div>
        <h2>Xin chào {{ $data['ho_ten'] }}</h2>
        <p>Cảm ơn bạn đã đăng ký tài khoản trên hệ thống của chúng tôi</p>
        <p>Để kích hoạt tài khoản, bạn vui lòng click vào nút kích hoạt tài khoản bên dưới</p>
        <p>
            <a
                href="{{ route('verify-register-mail', ['mail_user' => $data['email'], 'token' => $data['register_token']]) }}">Kích
                hoạt tài khoản
            </a>
        </p>
    </div>
</body>

</html>
