<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Qlaravel | @yield('title')</title>

    <!-- Sử dụng đường dẫn tương đối trực tiếp từ thư mục public/src/ -->
    <link href="/src/css/bootstrap.min.css" rel="stylesheet">
    <link href="/src/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/src/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/src/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">


    <link href="/src/css/animate.css" rel="stylesheet">
    <link href="/src/css/style.css" rel="stylesheet">
    @stack('ct-style')
</head>


<body>
    <div id="wrapper">

        <x-admin.Navbar>
        </x-admin.Navbar>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            {{-- -------------------header--------------------------- --}}
            <header>
                @include('admin.shared.include.header')
            </header>
            {{-- -------------------end-header-------------------------- --}}
            {{-- -------------------main-------------------------- --}}
            <main>
                @include('admin.shared.include.messageAlert')
                @yield('main')
            </main>
            {{-- -----------------end-main-------------------------- --}}
            {{-- -------------------footer-------------------------- --}}
            <footer>
                @include('admin.shared.include.footer')
            </footer>
            {{-- ------------------end-footer-------------------------- --}}
        </div>
    </div>

    @stack('modal')
    @include('admin.shared.include.script')
    @stack('ct-js')
</body>


</html>
