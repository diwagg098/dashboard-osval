    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Bootstrap -->
        <link href="{{ asset('style/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('style/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('style/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- Animate.css -->
        <link href="{{ asset('style/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{ asset('style/build/css/custom.min.css')}}" rel="stylesheet">
    </head>

    <body class="login">
        <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        </div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                @if (session('status'))     
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissable">
                        {{ session('status')}}
                    </div>
                </div>
                @endif
                <section class="login_content">
                <h1>Login</h1>
                <form action="{{ url('/login')}}" method="POST"> 
                @csrf
                <div>
                    <input type="text" class="form-control @error('username')
                        is-invalid
                    @enderror" name="username" placeholder="Username" value="{{ old('username')}}"/>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="password" value="" class="form-control @error('password')
                        is-invalid
                    @enderror" name="password" placeholder="Password"/>
                    @error('password')
                    <div class="invalid-feedback">{{ $message}}</div>
                @enderror
                </div>
                <div>
                    <button class="btn btn-success float-sm-right" type="submit">Login</button>
                </div>
                </form>
                <div class="clearfix"></div>

                <div class="separator">

                    <div class="clearfix"></div>
                    <br />

                    <div>
                    <h1><i class="fa fa-paw"></i> Admin Osval</h1>
                    <p>©2021 All Rights Reserved.</p>
                    </div>
                </div>
            </section>
            </div>
        </div>
        </div>
    </body>
    </html>
