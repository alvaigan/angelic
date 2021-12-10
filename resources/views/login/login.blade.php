<!-- LOGIN PAGE -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Angelic - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/assets') }}/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 col-lg-10 offset-lg-1">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="row">    
                                        <div style="width: 200px; height: auto; margin: auto;" class="justify-content-center">
                                            <img src="{{ asset('public/assets')}}/img/angelic.png" style="width: inherit;" alt="Logo Angelic" />
                                        </div>
                                    </div>

                                    @include('templates.alerts')

                                    <div style="margin-top: 30px;">

                                        <form class="user" action="{{ route('login.process') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="username" name="username" class="form-control form-control-user" id="username" placeholder="Enter Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login As Administrator
                                            </button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>

</body>

</html>