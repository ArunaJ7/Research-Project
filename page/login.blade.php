
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>@extends('layouts.mainlayout')

@section('title','Login')


@section('content')

<!-- alert dialogs -->
@if ($message = Session::get('pwdnot'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy Molly!</strong> {{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($message = Session::get('usernot'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy Molly!</strong> {{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<!-- alert dialogs -->

<div class="container">

<div class="row">
    <div class="col-12 col-md-4"></div>
    <div class="form-control col-md-16">
    <div class="row justify-content-center">
    <br><br><br><br><br>
    <div class="container-fluid">
            @include('layouts.nav')   
            </div>
    <div class="col-12 col-md-4 bg-light" id="logincontainer">
    
    <form method="post" action="/loginuser">
    {{csrf_field()}}
   
  <div class="form-group">
    <label for="validationCustom01">Username</label>
    <input type="text" class="form-control" id="validationCustom01"  name="username" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
  </div>
  <div class="row justify-content-center">
  <button type="submit" class="btn btn-primary">Login</button>
  </div>
</form>
    </div>
    </div>
    </div>

    <div class="col-12 col-md-4"></div>

</div>

</div>
  </body>   
  </html>       

@endsection