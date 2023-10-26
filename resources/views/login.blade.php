<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="{{ Cookie::get('theme') }}" data-bs-theme="{{ Cookie::get('theme') }}">
  <div class="row d-flex justify-content-center m-0 mt-5">
    <div class="col-md-5 my-3">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <div class="mb-3">
            @if (session()->has('loginError'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
          </div>

          <form method="POST" autocomplete="on" action="/login">
            @csrf
            <div class="form-group">
              <div class="error text-danger"><?php if (isset($error_data)) echo $error_data.'<br>'?></div>
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
              <div class="error text-danger"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group mt-2">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" value="">
              <div class="error text-danger"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

