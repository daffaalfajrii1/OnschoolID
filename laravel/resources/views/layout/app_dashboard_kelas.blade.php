<!DOCTYPE html>
<?php
$pengaturan = DB::table('pengaturan')->first();
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>{{@$pengaturan->nama_web}} - {{@$title}}</title>
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('adm/images/'.@$pengaturan->logo_web)}}">
        <link rel="stylesheet" href="{{asset('assets/css/vendor/plugins.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
        <script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
    </head>

    <body>
        <div class="main-wrapper main-wrapper-02">
            <!-- Login Header Start -->
            <div class="section login-header">
                <!-- Login Header Wrapper Start -->
                <div class="login-header-wrapper navbar navbar-expand">
                    <!-- Header Logo Start -->
                    <div class="login-header-logo">
                        <a href="{{route('home')}}"><img src="{{asset('adm/images/'.@$pengaturan->logo_web)}}" alt="Logo" width="50" /></a>
                    </div>
                    <!-- Header Logo End -->

                    <!-- Header Search Start -->
                    <div class="login-header-search dropdown">
                        
                    </div>
                    <!-- Header Search End -->

                    <!-- Header Action Start -->
                    <div class="login-header-action ml-auto">
                        @if(Session::get('foto'))
                        <a class="action author" href="#">
                            <img src="{{asset('assets/images/students/'.Session::get('foto'))}}" alt="{{Session::get('nama')}}" />
                        </a>
                        @else
                            <a class="action author" href="#">
                                <img src="{{asset('assets/images/students/user.png')}}" alt="{{Session::get('nama')}}" />
                            </a>
                        @endif

                        <div class="dropdown">
                            <button class="action more" data-bs-toggle="dropdown">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="" href="{{route('member.profil')}}"><i class="icofont-user"></i> Profil</a>
                                </li>
                                <li>
                                    <a class="" href="{{ route('keluar') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> Keluar</a>
                                    <form id="logout-form" action="{{ route('keluar') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Action End -->
                </div>
                <!-- Login Header Wrapper End -->
            </div>
            <!-- Login Header End -->

            <!-- Courses Admin Start -->
            @yield('content')

            <div class="section footer-section">
                <div class="footer-copyright">
                    <div class="container">

                        <!-- Footer Copyright Start -->
                        <div class="copyright-wrapper">
                            <div class="copyright-link">
                                <a href="#">Syarat & Ketentuan</a>
                                <a href="#">Kebijakan Privasi</a>
                            </div>
                            <div class="copyright-text">
                                <p>&copy; {{date('Y')}} <span> {{$pengaturan->nama_web}} </span> Powered by <img src="{{asset('assets/images/powered.png')}}" style="width: 90px" /> Made with <i class="icofont-heart-alt"></i> by <a href="https://onschool.id">onschool.id</a></p>
                            </div>
                        </div>
                        <!-- Footer Copyright End -->

                    </div>
                </div>
            </div>

            <!--Back To Start-->
            <a href="#" class="back-to-top">
                <i class="icofont-simple-up"></i>
            </a>
            <!--Back To End-->
        </div>

        <!-- JS
    ============================================ -->

        <script src="{{asset('assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>

        <script src="{{asset('assets/js/plugins.min.js')}}"></script>


        <!-- Main JS -->
        <script src="{{asset('assets/js/main.js')}}"></script>
    </body>
</html>
