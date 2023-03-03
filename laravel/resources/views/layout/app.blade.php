<!DOCTYPE html>
<html lang="en">
<?php
$pengaturan = DB::table('pengaturan')->first();
?>
<head>
    <title>{{@$pengaturan->nama_web}} - {{@$title}}</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('adm/images/'.@$pengaturan->logo_web)}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
    <style type="text/css">
        #desktop {
            display: block;
        }
        #mobile {
            display: none;
        }
        @media only screen and (max-width: 600px) {
            #desktop {
                display: none;
            }
            #mobile {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        <!-- Header Section Start -->
        <div class="header-section">

            <!-- Header Top Start -->
            <div class="header-top d-none d-lg-block">
                <div class="container">

                    <!-- Header Top Wrapper Start -->
                    <div class="header-top-wrapper">

                        <!-- Header Top Left Start -->
                        <div class="header-top-left">
                            <p>Belajar sekarang atau tidak sama sakali.</p>
                        </div>
                        <!-- Header Top Left End -->

                        <!-- Header Top Medal Start -->
                        <div class="header-top-medal">
                            <div class="top-info">
                                <p><i class="flaticon-phone-call"></i> <a href="tel:{{@$pengaturan->no_wa}}">{{@$pengaturan->no_wa}}</a></p>
                                <p><i class="flaticon-email"></i> <a href="mailto:{{@$pengaturan->email_web}}">{{@$pengaturan->email_web}}</a></p>
                            </div>
                        </div>
                        <!-- Header Top Medal End -->

                        <!-- Header Top Right Start -->
                        <div class="header-top-right">
                            <ul class="social">
                                <li><a href="{{@$pengaturan->facebook}}"><i class="flaticon-facebook"></i></a></li>
                                <li><a href="{{@$pengaturan->twitter}}"><i class="flaticon-twitter"></i></a></li>
                                <li><a href="{{@$pengaturan->instagram}}"><i class="flaticon-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Header Top Right End -->

                    </div>
                    <!-- Header Top Wrapper End -->

                </div>
            </div>
            <!-- Header Top End -->

            <!-- Header Main Start -->
            <div class="header-main">
                <div class="container">

                    <!-- Header Main Start -->
                    <div class="header-main-wrapper">

                        <!-- Header Logo Start -->
                        <div class="header-logo">
                            <a href="{{route('home')}}" id="desktop">
                                <img src="{{asset('adm/images/'.@$pengaturan->logo_web)}}" alt="Logo" width="50"> <span style="font-size: 30px; font-style: Monospace;">{{@$pengaturan->nama_web}}</span>
                            </a>
                            <a href="{{route('home')}}" id="mobile">
                                <img src="{{asset('adm/images/'.@$pengaturan->logo_web)}}" alt="Logo" style="width: 30px!important;">
                            </a>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Menu Start -->
                        <div class="header-menu d-none d-lg-block">
                            <ul class="nav-menu">
                                <li><a href="{{route('home')}}">Beranda</a></li>
                                <li>
                                    <a href="{{route('allkelas')}}">Kelas</a>
                                    <ul class="sub-menu">
                                        <?php
                                        $kategori_kelas = DB::table('kategori')->get();
                                        ?>
                                        @foreach($kategori_kelas as $item)
                                        <li> <a href="{{route('kelas', $item->slug)}}">{{$item->kategori}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{route('blog')}}">Blog</a></li>
                                <li><a href="{{route('kontak')}}">Kontak</a></li>
                                <li><a href="{{route('tentangkami')}}">Tentang Kami</a></li>
                                @if(Session::get('member_status'))
                                <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                                @endif
                                @if(Session::get('mentor_status'))
                                <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                                @endif
                                @if(Session::get('admin_status'))
                                <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                                @endif
                            </ul>

                        </div>
                        <!-- Header Menu End -->
                        @if(!Session::get('member_status'))
                            @if(!Session::get('mentor_status'))
                                @if(!Session::get('admin_status'))
                                <div class="header-sign-in-up d-none d-lg-block">
                                    <ul>
                                        <li><a class="sign-in" href="{{route('masuk')}}">Masuk</a></li>
                                        <li><a class="sign-up" href="{{route('daftar')}}">Daftar</a></li>
                                    </ul>
                                </div>
                                @else
                                <div class="header-sign-in-up d-none d-lg-block">
                                    <ul>
                                        <li><a class="sign-up" href="{{route('admin.beranda')}}">Dashboard</a></li>
                                    </ul>
                                </div>
                                @endif
                            @else
                            <div class="header-sign-in-up d-none d-lg-block">
                                <ul>
                                    <li><a class="sign-up" href="{{route('mentor.dashboard')}}">Dashboard</a></li>
                                </ul>
                            </div>
                            @endif
                        @else
                            <div class="header-sign-in-up d-none d-lg-block">
                                <ul>
                                    <li><a class="sign-up" href="{{route('member.dashboard')}}">Dashboard</a></li>
                                </ul>
                            </div>
                        @endif
                        <!-- Header Sing In & Up End -->

                        <!-- Header Mobile Toggle Start -->
                        <div class="header-toggle d-lg-none">
                            <a class="menu-toggle" href="javascript:void(0)">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                        <!-- Header Mobile Toggle End -->

                    </div>
                    <!-- Header Main End -->

                </div>
            </div>
            <!-- Header Main End -->

        </div>
        <!-- Header Section End -->

        <!-- Mobile Menu Start -->
        <div class="mobile-menu">

            <!-- Menu Close Start -->
            <a class="menu-close" href="javascript:void(0)">
                <i class="icofont-close-line"></i>
            </a>
            <!-- Menu Close End -->

            <!-- Mobile Top Medal Start -->
            <div class="mobile-top">
                <p><i class="flaticon-phone-call"></i> <a href="tel:{{@$pengaturan->no_wa}}">{{@$pengaturan->no_wa}}</a></p>
                <p><i class="flaticon-email"></i> <a href="mailto:{{@$pengaturan->email_web}}">{{@$pengaturan->email_web}}</a></p>
            </div>
            <!-- Mobile Top Medal End -->
            @if(!Session::get('member_status'))
            @if(!Session::get('mentor_status'))
            <!-- Mobile Sing In & Up Start -->
            <div class="mobile-sign-in-up">
                <ul>
                    <li><a class="sign-in" href="{{route('masuk')}}">Masuk</a></li>
                    <li><a class="sign-up" href="{{route('daftar')}}">Daftar</a></li>
                </ul>
            </div>
            @endif
            @endif
            <!-- Mobile Sing In & Up End -->

            <!-- Mobile Menu Start -->
            <div class="mobile-menu-items">
                <ul class="nav-menu">
                    <li><a href="{{route('home')}}">Beranda</a></li>
                    <li>
                        <a href="#">Kelas</a>
                        <ul class="sub-menu">
                            <?php
                            $kategori_kelas = DB::table('kategori')->get();
                            ?>
                            @foreach($kategori_kelas as $item)
                            <li> <a href="#">{{$item->kategori}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{route('blog')}}">Blog</a></li>
                    <li><a href="{{route('kontak')}}">Kontak</a></li>
                    <li><a href="{{route('tentangkami')}}">Tentang Kami</a></li>
                    @if(Session::get('member_status'))
                    <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                    @endif
                    @if(Session::get('mentor_status'))
                    <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                    @endif
                    @if(Session::get('admin_status'))
                    <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                    @endif
                </ul>

            </div>
            <!-- Mobile Menu End -->

            <!-- Mobile Menu End -->
            <div class="mobile-social">
                <ul class="social">
                    <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                    <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                    <li><a href="#"><i class="flaticon-skype"></i></a></li>
                    <li><a href="#"><i class="flaticon-instagram"></i></a></li>
                </ul>
            </div>
            <!-- Mobile Menu End -->

        </div>
        <!-- Mobile Menu End -->

        <!-- Overlay Start -->
        <div class="overlay"></div>
        <!-- Overlay End -->

        @yield('content')
        
        <center>Powered by <img src="{{asset('assets/images/powered.png')}}" style="width: 150px" /></center><br>
        <!-- Footer Start  -->
        <div class="section footer-section">

            <!-- Footer Widget Section Start -->
            <div class="footer-widget-section">

                <img class="shape-1 animation-down" src="{{asset('assets/images/shape/shape-21.png')}}" alt="Shape">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 order-md-1 order-lg-1">

                            <!-- Footer Widget Start -->
                            <div class="footer-widget">
                                <div class="widget-logo">
                                    <a href="#"><img src="{{asset('adm/images/'.@$pengaturan->logo_web)}}" width="75" alt="Logo"></a>
                                </div>

                                <div class="widget-address">
                                    <h4 class="footer-widget-title">{{$pengaturan->nama_web}}</h4>
                                    <p>{{$pengaturan->alamat_web}}.</p>
                                </div>

                                <ul class="widget-info">
                                    <li>
                                        <p> <i class="flaticon-email"></i> <a href="mailto:{{$pengaturan->email_web}}">{{$pengaturan->email_web}}</a> </p>
                                    </li>
                                    <li>
                                        <p> <i class="flaticon-phone-call"></i> <a href="tel:{{$pengaturan->no_wa}}">{{$pengaturan->no_wa}}</a> </p>
                                    </li>
                                </ul>

                                <ul class="widget-social">
                                    <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                                    <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                                    <li><a href="#"><i class="flaticon-skype"></i></a></li>
                                    <li><a href="#"><i class="flaticon-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- Footer Widget End -->

                        </div>
                        <div class="col-lg-6 order-md-3 order-lg-2">

                            <!-- Footer Widget Link Start -->
                            <div class="footer-widget-link">

                                <!-- Footer Widget Start -->
                                <div class="footer-widget">
                                    <h4 class="footer-widget-title">Kelas</h4>

                                    <ul class="widget-link">
                                        @foreach($kategori_kelas as $item)
                                        <li><a href="{{route('kelas', $item->slug)}}">{{$item->kategori}}</a></li>
                                        @endforeach
                                    </ul>

                                </div>
                                <!-- Footer Widget End -->

                                <!-- Footer Widget Start -->
                                <div class="footer-widget">
                                    <h4 class="footer-widget-title">Informasi Lainnya</h4>

                                    <ul class="widget-link">
                                        <li><a href="{{route('mentor.daftar')}}">Jadilah mentor</a></li>
                                        <li><a href="{{route('privasi')}}">Kebijakan Privasi</a></li>
                                        <li><a href="#">Syarat & Ketentuan</a></li>
                                    </ul>

                                </div>
                                <!-- Footer Widget End -->

                            </div>
                            <!-- Footer Widget Link End -->

                        </div>
                        <div class="col-lg-3 col-md-6 order-md-2 order-lg-3">

                            <!-- Footer Widget Start -->
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Subscribe</h4>

                                <div class="widget-subscribe">
                                    <a href="www.onschool.id">onschool</a>

                                    <div class="widget-form">
                                        <form action="#">
                                            <input type="text" placeholder="Email here">
                                            <button class="btn btn-primary btn-hover-dark">Subscribe Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer Widget End -->

                        </div>
                    </div>
                </div>

                <img class="shape-2 animation-left" src="{{asset('assets/images/shape/shape-22.png')}}" alt="Shape">

            </div>
            <!-- Footer Widget Section End -->

            <!-- Footer Copyright Start -->
            <div class="footer-copyright">
                <div class="container">

                    <!-- Footer Copyright Start -->
                    <div class="copyright-wrapper">
                        <div class="copyright-link">
                            <a href="#">Syarat & Ketentuan</a>
                            <a href="{{route('privasi')}}">Kebijakan Privasi</a>
                        </div>
                        <div class="copyright-text">
                            <p>&copy; {{date('Y')}} <span> {{$pengaturan->nama_web}} </span> Support  <i class="icofont-heart-alt"></i> by <a>UNIB </a> </p>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->

                </div>
            </div>
            <!-- Footer Copyright End -->

        </div>
        <!-- Footer End -->

        <!--Back To Start-->
        <a href="#" class="back-to-top">
            <i class="icofont-simple-up"></i>
        </a>
        <!--Back To End-->

    </div>

    <script src="{{asset('assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>

    <script src="{{asset('assets/js/plugins.min.js')}}"></script>


    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
</body>
</html>