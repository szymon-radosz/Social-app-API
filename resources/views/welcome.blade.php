<!doctype html>
<html class="no-js" lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="John Doew">
        <meta name="description" content="E-mamy - Bądź częścią lokalnej społeczności mam">
        <meta name="keywords" content="E-mamy, mamy, matki, macierzyństwo, dzieci, wychowywanie, mam, aplikacja">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>E-mamy - Bądź częścią lokalnej społeczności mam</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" src="image/ico" href="{{ asset('/images/favicon.png') }}" />
   
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">

        <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">
        <script href="{{ asset('/js/vendor/modernizr-2.8.3.min.js') }}"></script>
        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-143376405-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-143376405-1');
        </script>

    </head>
    <body data-spy="scroll" data-target=".mainmenu-area">
  
        <nav class="mainmenu-area" data-spy="affix" data-offset-top="200">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary_menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="{{ asset('/images/logo.png') }}" alt="Logo"></a>
                </div>
                <div class="collapse navbar-collapse" id="primary_menu">
                    <ul class="nav navbar-nav mainmenu">
                        <li class="active"><a href="#home_page">Strona Główna</a></li>
                        <li><a href="#about_page">O Aplikacji</a></li>
                        <li><a href="#features_page">Działanie</a></li>
                        <li><a href="#contact_page">Kontakt</a></li>
                    </ul>

                </div>
            </div>
        </nav>
     
        <header class="home-area overlay" id="home_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 hidden-sm col-md-4">
                        <figure class="mobile-image wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{ asset('/images/header-mobile.png') }}" alt="">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="space-80 hidden-xs"></div>
                        <h1 class="wow fadeInUp" data-wow-delay="0.4s">Bądź częścią lokalnej społeczności mam</h1>
                        <div class="space-20"></div>
                        <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                            <p>Znajdź nowe znajome w swojej okolicy o wspólnych zainteresowaniach.</p>
                        </div>
                        <div class="space-20"></div>
                        <p class="headerIconText wow fadeInUp ">Pobierz E-mamy</p>
                        <a href="#" title="Pobierz z Google Play" class="wow fadeInUp googlePlayHeader headerIcon" data-wow-delay="0.8s"><img src="{{ asset('/images/googlePlay.png') }}" alt=""></a>
                        <a href="#" title="Pobierz z App Store" class="wow fadeInUp appStoreHeader headerIcon" data-wow-delay="0.8s"><img src="{{ asset('/images/appStore.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </header>
     
        <section class="section-padding" id="about_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="page-title text-center">
                            <img class="aboutImg" src="{{ asset('/images/about-logo.png') }}" alt="About Logo">
                            <div class="space-20"></div>
                            <h5 class="title">O aplikacji</h5>
                            <div class="space-30"></div>
                            <h3 class="blue-color">Rozwijaj społeczność mam w Twojej okolicy.</h3>
                            <div class="space-20"></div>
                            <p>Poznawaj inne mamy z Twojej okolicy posiadające dzieci w podobnym wieku <br>lub o zainteresowaniach zbliżonych do Twoich.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <!--<section class="progress-area gray-bg" id="progress_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="page-title section-padding">
                            <h5 class="title wow fadeInUp" data-wow-delay="0.2s">Our Progress</h5>
                            <div class="space-10"></div>
                            <h3 class="dark-color wow fadeInUp" data-wow-delay="0.4s">Grat Application Ever</h3>
                            <div class="space-20"></div>
                            <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                            </div>
                            <div class="space-50"></div>
                            <a href="#" class="bttn-default wow fadeInUp" data-wow-delay="0.8s">Learn More</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <figure class="mobile-image">
                            <img src="{{ asset('/images/progress-phone.png') }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </section>-->
  
        <!--<section class="video-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="video-photo">
                            <img src="images/video-image.jpg" alt="">
                            <a href="https://www.youtube.com/watch?v=ScrDhTsX0EQ" class="popup video-button">
                                <img src="images/play-button.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5 col-md-offset-1">
                        <div class="space-60 hidden visible-xs"></div>
                        <div class="page-title">
                            <h5 class="title wow fadeInUp" data-wow-delay="0.2s">VIDEO FEATURES</h5>
                            <div class="space-10"></div>
                            <h3 class="dark-color wow fadeInUp" data-wow-delay="0.4s">Grat Application Ever</h3>
                            <div class="space-20"></div>
                            <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                            </div>
                            <div class="space-50"></div>
                            <a href="#" class="bttn-default wow fadeInUp" data-wow-delay="0.8s">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <section class="feature-area section-padding-top" id="features_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="page-title text-center">
                            <h5 class="title">Działanie</h5>
                            <div class="space-10"></div>
                            <h3>Jak działa aplikacja E-mamy?</h3>
                            <div class="space-60"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="service-box wow fadeInUp" data-wow-delay="0.4s">
                            <div class="box-icon">
                            <img src="{{ asset('/images/eco.png') }}" alt="Logo">
                            </div>
                            <h4>Społeczność</h4>
                            <p>Buduj lokalną społeczność mam</p>
                        </div>
                        <div class="space-60"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/friends.png') }}" alt="Logo">
                            </div>
                            <h4>Znajomości</h4>
                            <p>Poznawaj inne mamy z Twojej okolicy</p>
                        </div>
                        <div class="space-60"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/auction.png') }}" alt="Logo">
                            </div>
                            <h4>Aukcje</h4>
                            <p>Sprzedaj i kupuj przedmioty<br>od innych użytkowniczek</p>
                        </div>
                        <div class="space-60"></div>
                    </div>
                    <div class="hidden-xs hidden-sm col-md-4">
                        <figure class="mobile-image">
                            <img src="{{ asset('/images/feature-image.png') }}" alt="Feature Photo">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/forum.png') }}" alt="Logo">
                            </div>
                            <h4>Forum</h4>
                            <p>Bierz czynny udział w dyskusjach</p>
                        </div>
                        <div class="space-60"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/woman.png') }}" alt="Logo">
                            </div>
                            <h4>Kontakty</h4>
                            <p>Utrzymuj czynny kontakt z innymi mamami</p>
                        </div>
                        <div class="space-60"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.4s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/gym.png') }}" alt="Logo">
                            </div>
                            <h4>Dopasowanie</h4>
                            <p>Znajduj inne mamy w okolicy o zainteresowaniach<br> podobnych do Twoich</p>
                        </div>
                        <div class="space-60"></div>
                    </div>
                </div>
            </div>
        </section>

        <!--<section class="testimonial-area" id="testimonial_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title text-center">
                            <h5 class="title">Testimonials</h5>
                            <h3 class="dark-color">Our Client Loves US</h3>
                            <div class="space-60"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="team-slide">
                            <div class="team-box">
                                <div class="team-image">
                                    <img src="{{ asset('/images/team-1.png') }}" alt="">
                                </div>
                                <h4>Ashekur Rahman</h4>
                                <h6 class="position">Art Dirrector</h6>
                                <p>Lorem ipsum dolor sit amet, conseg sed do eiusmod temput laborelaborus ed sed do eiusmod tempo.</p>
                            </div>
                            <div class="team-box">
                                <div class="team-image">
                                    <img src="{{ asset('/images/team-2.jpg') }}" alt="">
                                </div>
                                <h4>Ashekur Rahman</h4>
                                <h6 class="position">Art Dirrector</h6>
                                <p>Lorem ipsum dolor sit amet, conseg sed do eiusmod temput laborelaborus ed sed do eiusmod tempo.</p>
                            </div>
                            <div class="team-box">
                                <div class="team-image">
                                    <img src="{{ asset('/images/team-3.jpg') }}"alt="">
                                </div>
                                <h4>Ashekur Rahman</h4>
                                <h6 class="position">Art Dirrector</h6>
                                <p>Lorem ipsum dolor sit amet, conseg sed do eiusmod temput laborelaborus ed sed do eiusmod tempo.</p>
                            </div>
                            <div class="team-box">
                                <div class="team-image">
                                    <img src="{{ asset('/images/team-1.png') }}" alt="">
                                </div>
                                <h4>Ashekur Rahman</h4>
                                <h6 class="position">Art Dirrector</h6>
                                <p>Lorem ipsum dolor sit amet, conseg sed do eiusmod temput laborelaborus ed sed do eiusmod tempo.</p>
                            </div>
                            <div class="team-box">
                                <div class="team-image">
                                    <img src="{{ asset('/images/team-2.jpg') }}" alt="">
                                </div>
                                <h4>Ashekur Rahman</h4>
                                <h6 class="position">Art Dirrector</h6>
                                <p>Lorem ipsum dolor sit amet, conseg sed do eiusmod temput laborelaborus ed sed do eiusmod tempo.</p>
                            </div>
                            <div class="team-box">
                                <div class="team-image">
                                    <img src="{{ asset('/images/team-3.jpg') }}" alt="">
                                </div>
                                <h4>Ashekur Rahman</h4>
                                <h6 class="position">Art Dirrector</h6>
                                <p>Lorem ipsum dolor sit amet, conseg sed do eiusmod temput laborelaborus ed sed do eiusmod tempo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
  
        <!--<section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="page-title">
                            <h5 class="title wow fadeInUp" data-wow-delay="0.2s">Our features</h5>
                            <div class="space-10"></div>
                            <h3 class="dark-color wow fadeInUp" data-wow-delay="0.4s">Aour Approach of Design is Prety Simple and Clear</h3>
                        </div>
                        <div class="space-20"></div>
                        <div class="desc wow fadeInUp" data-wow-delay="0.6s">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiing elit, sed do eiusmod tempor incididunt ut labore et laborused sed do eiusmod tempor incididunt ut labore et laborused.</p>
                        </div>
                        <div class="space-50"></div>
                        <a href="#" class="bttn-default wow fadeInUp" data-wow-delay="0.8s">Learn More</a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                        <div class="space-60 hidden visible-xs"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box-icon">
                                <i class="lnr lnr-clock"></i>
                            </div>
                            <h4>Easy Notifications</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div class="space-50"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box-icon">
                                <i class="lnr lnr-laptop-phone"></i>
                            </div>
                            <h4>Fully Responsive</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        </div>
                        <div class="space-50"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box-icon">
                                <i class="lnr lnr-cog"></i>
                            </div>
                            <h4>Editable Layout</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->

        <!--<div class="download-area overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 hidden-sm">
                        <figure class="mobile-image">
                            <img src="{{ asset('/images/download-image.png') }}" alt="">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-md-6 section-padding">
                        <h3 class="white-color">Download The App</h3>
                        <div class="space-20"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam possimus eaque magnam eum praesentium unde.</p>
                        <div class="space-60"></div>
                        <a href="#" class="bttn-white sq"><img src="{{ asset('/images/apple-icon.png') }}" alt="apple icon"> Apple Store</a>
                        <a href="#" class="bttn-white sq"><img src="{{ asset('/images/play-store-icon.png') }}" alt="Play Store Icon"> Play Store</a>
                    </div>
                </div>
            </div>
        </div>-->
     
        <!--<section class="section-padding price-area" id="price_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title text-center">
                            <h5 class="title">Pricing Plan</h5>
                            <h3 class="dark-color">Our Awesome Pricing Plan</h3>
                            <div class="space-60"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="price-box">
                            <div class="price-header">
                                <div class="price-icon">
                                    <span class="lnr lnr-rocket"></span>
                                </div>
                                <h4 class="upper">Free</h4>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li>Easy Installations</li>
                                    <li>Unlimited support</li>
                                    <li>Uniqe Elements</li>
                                </ul>
                            </div>
                            <div class="price-rate">
                                <sup>&#36;</sup> <span class="rate">0</span> <small>/Month</small>
                            </div>
                            <div class="price-footer">
                                <a href="#" class="bttn-white">Purchase</a>
                            </div>
                        </div>
                        <div class="space-30 hidden visible-xs"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="price-box">
                            <div class="price-header">
                                <div class="price-icon">
                                    <span class="lnr lnr-diamond"></span>
                                </div>
                                <h4 class="upper">Medium</h4>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li>Easy Installations</li>
                                    <li>Unlimited support</li>
                                    <li>Free Forever</li>
                                </ul>
                            </div>
                            <div class="price-rate">
                                <sup>&#36;</sup> <span class="rate">49</span> <small>/Month</small>
                            </div>
                            <div class="price-footer">
                                <a href="#" class="bttn-white">Purchase</a>
                            </div>
                        </div>
                        <div class="space-30 hidden visible-xs"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="price-box">
                            <div class="price-header">
                                <div class="price-icon">
                                    <span class="lnr lnr-pie-chart"></span>
                                </div>
                                <h4 class="upper">Business</h4>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li>Easy Installations</li>
                                    <li>Unlimited support</li>
                                    <li>Free Forever</li>
                                </ul>
                            </div>
                            <div class="price-rate">
                                <sup>&#36;</sup> <span class="rate">99</span> <small>/Month</small>
                            </div>
                            <div class="price-footer">
                                <a href="#" class="bttn-white">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
   
        <!--<section id="questions_page" class="questions-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title text-center">
                            <h5 class="title">FAQ</h5>
                            <h3 class="dark-color">Frequently Asked Questions</h3>
                            <div class="space-60"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="toggole-boxs">
                            <h3>Faq first question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <h3>About freewuent question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <h3>Why more question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <h3>What question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="space-20 hidden visible-xs"></div>
                        <div class="toggole-boxs">
                            <h3>Faq second question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <h3>Third faq question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <h3>Why more question goes here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <h3>Seventh frequent question here? </h3>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
    
        <!--<div class="subscribe-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="subscribe-form text-center">
                            <h3 class="blue-color">Zapisz się do newslettera</h3>
                            <div class="space-20"></div>
                            
                            <div id="mc_embed_signup">
                            <form action="https://e-mamy.us3.list-manage.com/subscribe/post?u=e05c2147ffb2f25baf5da262d&amp;id=9be1800ae8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                <div class="mc-field-group">
                                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                                </div>
                            
                            	<div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>   
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e05c2147ffb2f25baf5da262d_9be1800ae8" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Zapisz się" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                </div>
                            </form>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
     
        <footer class="footer-area" id="contact_page">
            <div class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title text-center">
                                <h5 class="title">Kontakt</h5>
                                <h3 class="dark-color">Pomóż nam rozwijać E-mamy</h3>
                                <div class="space-60"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12">
                            <div class="footer-box">
                                <a href="mailto:kontakt@e-mamy.pl" title="Napisz wiadomość"><div class="box-icon">
                                    <span class="lnr lnr-envelope"></span>
                                </div></a>
                                <a href="mailto:kontakt@e-mamy.pl" title="Napisz wiadomość"><p>kontakt@e-mamy.pl</p></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-5">
                        <span>Copyright &copy; 2019 E-mamy</span>
                            <div class="space-10 hidden visible-xs"></div>
                        </div>
                        <div class="col-xs-12 col-md-7">
                            <div class="footer-menu">
                                <ul>
                                    <a href="https://www.facebook.com/emamypl/" target="_blank" title="E-mamy - Facebook">
                                        <img src="{{ asset('/images/fb.png') }}" alt="Facebook">
                                    </a>
                                    <img src="{{ asset('/images/ig.png') }}" alt="Instagram">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
       
        <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us3.list-manage.com","uuid":"e05c2147ffb2f25baf5da262d","lid":"9be1800ae8","uniqueMethods":true}) })</script>

     
        <script src="{{ URL::asset('/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ URL::asset('/js/vendor/jquery-ui.js') }}"></script>
        <script src="{{ URL::asset('/js/vendor/bootstrap.min.js') }}"></script>
        
        <script src="{{ URL::asset('/js/owl.carousel.min.js') }}"></script>
        <script src="{{ URL::asset('/js/contact-form.js') }}"></script>
        <script src="{{ URL::asset('/js/ajaxchimp.js') }}"></script>
        <script src="{{ URL::asset('/js/scrollUp.min.js') }}"></script>
        <script src="{{ URL::asset('/js/magnific-popup.min.js') }}"></script>
        <script src="{{ URL::asset('/js/wow.min.js') }}"></script>
        
        <script src="{{ URL::asset('/js/main.js') }}"></script>
    </body>
</html>
