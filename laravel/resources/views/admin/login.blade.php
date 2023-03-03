<!DOCTYPE html>
<?php
$pengaturan = DB::table('pengaturan')->first();
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{@$title}} | {{@$pengaturan->nama_web}}</title>
    <link rel="shortcut icon" href="{{asset('adm/images/'.@$pengaturan->logo_web)}}">

    <!-- Bootstrap -->
    <link href="{{asset('adm/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('adm/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('adm/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('adm/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('adm/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @if(Session::get('gagal'))
              <div class="alert alert-danger" role="alert">{{Session::get('gagal')}}</div>
            @endif
            @if(Session::get('berhasil'))
              <div class="alert alert-success" role="alert">{{Session::get('berhasil')}}</div>
            @endif
            <form action="{{route('admin.masuk.proses')}}" method="post">
              @csrf
              <img src="{{asset('adm/images/logo.png')}}" width="150">
              <h1>Halaman Masuk Admin {{@$pengaturan->nama_web}}</h1>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-success btn-block mb-0" type="button">Masuk</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div>
                  <h1><img src="{{asset('adm/images/logo.png')}}" width="35"> {{@$pengaturan->nama_web}}!</h1>
                  <p>©{{date('Y')}} All Rights Reserved. {{@$pengaturan->nama_web}}</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
