@extends('layout.app') @section('content')
<!-- Page Banner Start -->
        <div class="section page-banner">

            <img class="shape-1 animation-round" src="assets/images/shape/shape-8.png" alt="Shape">

            <img class="shape-2" src="assets/images/shape/shape-23.png" alt="Shape">

            <div class="container">
                <!-- Page Banner Start -->
                <div class="page-banner-content">
                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Beranda</a></li>
                        <li class="active">Kontak Kami</li>
                    </ul>
                    <h2 class="title">Kontak <span>Kami</span></h2>
                </div>
                <!-- Page Banner End -->
            </div>

            <!-- Shape Icon Box Start -->
            <div class="shape-icon-box">

                <img class="icon-shape-1 animation-left" src="{{asset('assets/images/shape/shape-5.png')}}" alt="Shape">

                <div class="box-content">
                    <div class="box-wrapper">
                        <i class="flaticon-badge"></i>
                    </div>
                </div>

                <img class="icon-shape-2" src="{{asset('assets/images/shape/shape-6.png')}}" alt="Shape">

            </div>
            <!-- Shape Icon Box End -->

            <img class="shape-3" src="{{asset('assets/images/shape/shape-24.png')}}" alt="Shape">

            <img class="shape-author" src="{{asset('assets/images/author/author-11.jpg')}}" alt="Shape">

        </div>
        <!-- Page Banner End -->

        <!-- Contact Map Start -->
        <div class="section section-padding-02">
            <div class="container">

                <!-- Contact Map Wrapper Start -->
                <div class="contact-map-wrapper">
                    {!!$pengaturan->embed_map!!}
                </div>
                <!-- Contact Map Wrapper End -->

            </div>
        </div>
        <!-- Contact Map End -->

        <!-- Contact Start -->
        <div class="section section-padding">
            <div class="container">

                <!-- Contact Wrapper Start -->
                <div class="contact-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-12">

                            <!-- Contact Info Start -->
                            <div class="contact-info">

                                <img class="shape animation-round" src="{{asset('assets/images/shape/shape-12.png')}}" alt="Shape">

                                <!-- Single Contact Info Start -->
                                <div class="single-contact-info">
                                    <div class="info-icon">
                                        <i class="flaticon-phone-call"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">No Kontak.</h6>
                                        <p><a href="tel:{{$pengaturan->no_wa}}">{{$pengaturan->no_wa}}</a></p>
                                    </div>
                                </div>
                                <!-- Single Contact Info End -->
                                <!-- Single Contact Info Start -->
                                <div class="single-contact-info">
                                    <div class="info-icon">
                                        <i class="flaticon-email"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">Email.</h6>
                                        <p><a href="mailto:{{$pengaturan->email_web}}">{{$pengaturan->email_web}}</a></p>
                                    </div>
                                </div>
                                <!-- Single Contact Info End -->
                                <!-- Single Contact Info Start -->
                                <div class="single-contact-info">
                                    <div class="info-icon">
                                        <i class="flaticon-pin"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">Alamat.</h6>
                                        <p>{{$pengaturan->alamat_web}}</p>
                                    </div>
                                </div>
                                <!-- Single Contact Info End -->
                            </div>
                            <!-- Contact Info End -->

                        </div>
                        <!--<div class="col-lg-6">-->

                            <!-- Contact Form Start -->
                        <!--    <div class="contact-form">-->
                        <!--        <h3 class="title">Hubungi kami segera</h3>-->

                        <!--        <div class="form-wrapper">-->
                        <!--            <form id="contact-form" action="#" method="POST">-->
                                        <!-- Single Form Start -->
                        <!--                <div class="single-form">-->
                        <!--                    <input type="text" name="name" placeholder="Nama" required>-->
                        <!--                </div>-->
                                        <!-- Single Form End -->
                                        <!-- Single Form Start -->
                        <!--                <div class="single-form">-->
                        <!--                    <input type="email" name="email" placeholder="Email" required>-->
                        <!--                </div>-->
                                        <!-- Single Form End -->
                                        <!-- Single Form Start -->
                        <!--                <div class="single-form">-->
                        <!--                    <input type="text" name="subject" placeholder="Judul" required>-->
                        <!--                </div>-->
                                        <!-- Single Form End -->
                                        <!-- Single Form Start -->
                        <!--                <div class="single-form">-->
                        <!--                    <textarea name="message" placeholder="Pesan" required></textarea>-->
                        <!--                </div>-->
                                        <!-- Single Form End -->
                        <!--                <p class="form-message"></p>-->
                                        <!-- Single Form Start -->
                        <!--                <div class="single-form">-->
                        <!--                    <button type="submit" class="btn btn-primary btn-hover-dark w-100">Kirim Pesan <i class="flaticon-right"></i></button>-->
                        <!--                </div>-->
                                        <!-- Single Form End -->
                        <!--            </form>-->
                        <!--        </div>-->
                        <!--    </div>-->
                            <!-- Contact Form End -->

                        </div>
                    </div>
                </div>
                <!-- Contact Wrapper End -->

            </div>
        </div>
        <!-- Contact End -->
@endsection