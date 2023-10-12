
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Exotic Fruit Sumatra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('dashboard/assets/images/favicon.ico') }}">

    <!-- Bootstrap css -->
    <link href="{{ url('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ url('dashboard/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{ url('dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ url('dashboard/assets/js/head.js') }}"></script>

</head>

<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="p-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <div class="auth-logo">
                        <a href="{{ route('login') }}" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="{{ url('dashboard/assets/images/logo-dark.png') }}" alt="" height="22">
                            </span>
                        </a>

                        <a href="{{ route('login') }}" class="logo logo-light text-center">
                            <span class="logo-lg">
                                <img src="{{ url('dashboard/assets/images/logo-light.png') }}" alt="" height="22">
                            </span>
                        </a>
                    </div>
                </div>

                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- form -->
                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            autofocus
                        />
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" id="password" required="" placeholder="*********">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit">Log In </button>
                    </div>
                </form>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3 text-white">I love the color!</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
            </p>
            <h5 class="text-white">
                - Fadlisaad (Ubold Admin User)
            </h5>
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- Vendor js -->
<script src="{{ url('dashboard/assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ url('dashboard/assets/js/app.min.js') }}"></script>

</body>
</html>
