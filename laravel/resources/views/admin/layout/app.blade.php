<!DOCTYPE html>
<?php
$pengaturan = DB::table('pengaturan')->first();
?>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{@$title}} - {{@$pengaturan->nama_web}}</title>

        <!-- Bootstrap -->
        <link href="{{asset('adm/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
        <!-- Font Awesome -->
        <link href="{{asset('adm/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
        <!-- NProgress -->
        <link href="{{asset('adm/vendors/nprogress/nprogress.css')}}" rel="stylesheet" />
        <!-- Animate.css -->
        <link href="{{asset('adm/vendors/animate.css/animate.min.css')}}" rel="stylesheet" />

        <!-- Custom Theme Style -->
        <link href="{{asset('adm/build/css/custom.min.css')}}" rel="stylesheet" />
        <script src="{{asset('adm/vendors/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('adm/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('adm/images/'.@$pengaturan->logo_web)}}">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="{{route('home')}}" class="site_title"><img src="{{asset('adm/images/'.@$pengaturan->logo_web)}}" width="35"> <span>{{@$pengaturan->nama_web}}</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{asset('adm/images/admin.png')}}" alt="{{Session::get('nama')}}" class="img-circle profile_img" />
                            </div>
                            <div class="profile_info">
                                <span>Selamat Datang,</span>
                                <h2>{{Session::get('nama')}}</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li class="{{ Request::segment(2) == '' ? 'active' : '' }}">
                                        <a href="{{route('admin.beranda')}}"><i class="fa fa-home"></i> Beranda </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'mentor' ? 'active' : '' }}">
                                        <a><i class="fa fa-black-tie"></i> Mentor <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" <?= Request::segment(2) == 'mentor' ? 'style="display: block!important"' : '' ?>>
                                            <?php
                                            $cek_request = DB::table('mentor')->where('status', '0')->count();
                                            $cek = '';
                                            if($cek_request > 0){
                                                $cek = ' <span class="badge bg-success text-white rounded-circle ms-2">'.$cek_request.'</span>';
                                            }
                                            ?>
                                            <li class="{{ Request::segment(2) == 'mentor' && Request::segment(3) == 'permintaan' ? 'current-page' : '' }}"><a href="{{route('admin.mentor.permintaan')}}">Permintaan Mentor{!!$cek!!}</a></li>
                                            <li class="{{ Request::segment(2) == 'mentor' && Request::segment(3) != 'permintaan' ? 'current-page' : '' }}"><a href="{{route('admin.mentor')}}">Data Mentor</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'kelas' ? 'active' : '' }}">
                                        <a><i class="fa fa-bookmark-o"></i> Kelas <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" <?= Request::segment(2) == 'kelas' ? 'style="display: block!important"' : '' ?>>
                                            <?php
                                            $cek_request = DB::table('kelas')->where('status', 'Pending')->count();
                                            $cek = '';
                                            if($cek_request > 0){
                                                $cek = ' <span class="badge bg-success text-white rounded-circle ms-2">'.$cek_request.'</span>';
                                            }
                                            ?>
                                            <li class="{{ Request::segment(2) == 'kelas' && Request::segment(3) == 'permintaan' ? 'current-page' : '' }}"><a href="{{route('admin.kelas.permintaan')}}">Permintaan Kelas{!!$cek!!}</a></li>
                                            <li class="{{ Request::segment(2) == 'kelas' && Request::segment(3) != 'permintaan' ? 'current-page' : '' }}"><a href="{{route('admin.kelas')}}">Data Kelas</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'siswa' ? 'active' : '' }}">
                                        <a href="{{route('admin.siswa')}}"><i class="fa fa-graduation-cap"></i> Siswa </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'blog' ? 'active' : '' }}">
                                        <a href="{{route('admin.blog')}}"><i class="fa fa-list-alt"></i> Blog </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == '' ? 'kategori' : '' }}">
                                        <a href="{{route('admin.kategori')}}"><i class="fa fa-list"></i> Kategori </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'billing' ? 'active' : '' }}">
                                        <a href="{{route('admin.billing')}}"><i class="fa fa-money"></i> Billing </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'penarikan' ? 'active' : '' }}">
                                        <a href="{{route('admin.penarikan')}}"><i class="fa fa-google-wallet"></i> Penarikan </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'tim' ? 'active' : '' }}">
                                        <a href="{{route('admin.tim')}}"><i class="fa fa-users"></i> Tim </a>
                                    </li>
                                    <li class="{{ Request::segment(2) == 'pengaturan' ? 'active' : '' }}">
                                        <a href="{{route('admin.pengaturan')}}"><i class="fa fa-gear"></i> Pengaturan </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class="navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"> <img src="{{asset('adm/images/admin.png')}}" alt="{{Session::get('nama')}}" />{{Session::get('nama')}} </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('admin.akun')}}"> Pengaturan Akun</a>
                                        <a class="dropdown-item" href="{{ route('admin.keluar.proses') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Keluar</a>
                                        <form id="logout-form" action="{{ route('admin.keluar.proses') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                @yield('content')
                
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">{{@$pengaturan->nama_web}} - Powered by <img src="{{asset('assets/images/powered.png')}}" style="width: 90px" /> Support by <a href="https://onschool.id">onschool.id</a></div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <script>
            function hanyaAngka(evt) {
              var charCode = (evt.which) ? evt.which : event.keyCode
               if (charCode > 31 && (charCode < 48 || charCode > 57))
     
                return false;
              return true;
            }
        </script>

        <!-- jQuery -->
        <!-- Bootstrap -->
        <!-- FastClick -->
        <script src="{{asset('adm/vendors/fastclick/lib/fastclick.js')}}"></script>
        <!-- NProgress -->
        <script src="{{asset('adm/vendors/nprogress/nprogress.js')}}"></script>
        <!-- Chart.js -->
        <script src="{{asset('adm/vendors/Chart.js/dist/Chart.min.js')}}"></script>
        <!-- jQuery Sparklines -->
        <script src="{{asset('adm/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <!-- Flot -->
        <script src="{{asset('adm/vendors/Flot/jquery.flot.js')}}"></script>
        <script src="{{asset('adm/vendors/Flot/jquery.flot.pie.js')}}"></script>
        <script src="{{asset('adm/vendors/Flot/jquery.flot.time.js')}}"></script>
        <script src="{{asset('adm/vendors/Flot/jquery.flot.stack.js')}}"></script>
        <script src="{{asset('adm/vendors/Flot/jquery.flot.resize.js')}}"></script>
        <!-- Flot plugins -->
        <script src="{{asset('adm/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
        <script src="{{asset('adm/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
        <script src="{{asset('adm/vendors/flot.curvedlines/curvedLines.js')}}"></script>
        <!-- DateJS -->
        <script src="{{asset('adm/vendors/DateJS/build/date.js')}}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{asset('adm/vendors/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('adm/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{asset('adm/build/js/custom.min.js')}}"></script>
    </body>
</html>
