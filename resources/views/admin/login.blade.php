<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('backend-assets/css/login.css') }}">
</head>

<body>
    <div class="container login-page">
        @if ($error = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endif
        @include('frontend.message')
        <div class="col-md-6 mt-5 ">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary p-3 ">
                <div class="card-header text-center mb-3 main-header">
                    <a href="#" class="h3">Administrative Panel</a>
                </div>
                <form action="{{ route('authenticate') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label label-text">Email address</label>
                        <input type="email"
                            class="form-control @error('email')
                        is-invalid
                        @enderror"
                            name="email" placeholder="your email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label label-text">Password</label>
                        <input type="password"
                            class="form-control @error('password')
                        is-invalid
                        @enderror"
                            name="password" placeholder="your password">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
