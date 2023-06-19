<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('images/iconlogo.PNG') }}">
    <title>Đăng nhập trang quản trị</title>

    <link href="{{ asset('front-end/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/startmin.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/admin/css/toastrmin.css') }}">

</head>

<body style="background-color: #fff">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vui lòng đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{ $err }} <br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('thongbao'))
                            <div class="alert alert-danger">
                                {{ session('thongbao') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.postlogin') }}" method="POST" role="form">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="password" type="password"
                                    >
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox">Ghi nhớ đăng nhập lần sau
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Đăng nhập">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admins/js/metisMenu.min.js') }}"></script>

    <script src="{{ asset('admins/js/startmin.js') }}"></script>
    <script src="{{ asset('front-end/admin/js/jquery.min.js') }}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

</body>

</html>
