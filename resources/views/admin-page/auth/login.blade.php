<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/styles.css') }}" />

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('user-assets/images/assets/kumpisalan-logo.png') }}" width="100" alt="">
                                </a>
                                <h3 class="text-center">Admin Access</h3>
                                @if($errors->all())
                                    <div class="alert alert-danger">Invalid Credentials</div>
                                @endif
                                @if(Session::get('login-fail'))
                                    <div class="alert alert-warning">{{ Session::get('login-fail') }}</div>
                                @endif
                                @if(Session::get('login-auth-failed'))
                                    <div class="alert alert-danger">{{ Session::get('login-auth-failed') }}</div>
                                @endif
                                @if(Session::get('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                <form method="POST" action="{{ route('admin.post.login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            aria-describedby="usernameHelp">
                                        <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <a class="text-primary fw-bold" href="#">Forgot Password ?</a>
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                                </form>
                                <div class="text-center">
                                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin-assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
