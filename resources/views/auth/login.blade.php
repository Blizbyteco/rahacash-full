<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{asset('dist')}}/css/adminlte.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-light">
    <div class="container">
        <div class="row pt-5 mt-5 justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-9">
                <div class="card o-hidden border-0 shadow-md my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="text-dark mb-5">Login</h1>
                            </div>
                            <form method="post" action="/login" class="user">
                                @csrf

                                @if(session('fail'))
                                <div class="alert alert-danger">
                                    {{session('fail')}}
                                </div>
                                @endif
                                
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-dark btn-user btn-block">
                                    Login
                                </button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>