<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/src/">
    <title>INSPINIA | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">QN+</h1>

            </div>
            <h3>Welcome to QN+</h3>
            <p>Đăng nhập tài khoản</p>
            @error('email')
            <div class="alert alert-danger" role="alert">
                Kiểm tra tên hoặc mật khẩu
            </div>
            @enderror
            <form method="POST" name="form-login" class="m-t" role="form" action="{{route('checkLogin')}}">
                @csrf
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
