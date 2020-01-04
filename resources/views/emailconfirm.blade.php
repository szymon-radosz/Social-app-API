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
        <section class="section-padding" id="about_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="page-title text-center">
                            <img class="aboutImg" src="{{ asset('/images/about-logo.png') }}" alt="About Logo">
                            <div class="space-20"></div>
                            <h5 class="title">Welcome</h5>
                            <div class="space-20"></div>
                            <p>Weryfikacja zakończona sukcesem. Możesz zalogować się w aplikacji E-mamy.</p>
                            <p>Podziel się z nami swoimi spostrzeżeniami wysyłając wiadomość pod adres <a href="mailto:kontakt@e-mamy.pl" title="Napisz wiadomość">kontakt@e-mamy.pl</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                                    <a href="https://www.facebook.com/E-mamy-678607299320582/" target="_blank" title="E-mamy - Facebook">
                                        <img src="{{ asset('/images/fb.png') }}" alt="Facebook">
                                    </a>
                                    <a href="https://www.instagram.com/emamy_pl/" target="_blank" title="E-mamy - Facebook">
                                        <img src="{{ asset('/images/ig.png') }}" alt="Instagram">
                                    </a>
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
