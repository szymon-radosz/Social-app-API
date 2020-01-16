<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="John Doew">
        <meta name="description" content="Social app - People like you in your neighborhood">
        <meta name="keywords" content="app, community, friends">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Social app - People like you in your neighborhood</title>

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
    </head>
    <body data-spy="scroll" data-target=".mainmenu-area">

        <nav class="mainmenu-area" data-spy="affix" data-offset-top="200">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle navbar-toogle-custom" data-toggle="collapse" data-target="#primary_menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="{{ asset('/images/logo.png') }}" alt="Logo"></a>
                </div>
                <div class="collapse navbar-collapse" id="primary_menu">
                    <ul class="nav navbar-nav mainmenu">
                        <li class="active"><a href="#home_page">Home</a></li>
                        <li><a href="#about_page">About</a></li>
                        <li><a href="#features_page">How it works?</a></li>
                        <li><a href="#contact_page">Contact</a></li>
                    </ul>

                </div>
            </div>
        </nav>

        <header class="home-area overlay" id="home_page">
            <div class="container">
                <div class="row headerRow">
                    <div class="col-xs-12 hidden-sm col-md-4">
                        <figure class="mobile-image" >
                            <img src="{{ asset('/images/header-mobile.png') }}" alt="">
                        </figure>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="space-80 hidden-xs"></div>
                        <h1>People like you<br />in your neighborhood</h1>
                        <div class="space-20"></div>
                        <div class="desc">
                            <p>Find people with same interests like you</p>
                        </div>
                        <div class="space-20"></div>
                        <p class="headerIconText">Download</p>
                        <div class="headerIcons">
                            <a target="_blank" href="" title="Download App Store" class="appStoreHeader headerIcon"><img src="{{ asset('/images/appStore.png') }}" alt="App Store"></a>
                            <a target="_blank" href="" title="Google Play" class="googlePlayHeader headerIcon"><img src="{{ asset('/images/googlePlay.png') }}" alt="Google Play"></a>
                        </div>
                     </div>
                </div>
            </div>
        </header>

        <section class="section-padding" id="about_page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="page-title text-center">
                            <img class="aboutImg" src="{{ asset('/images/logo-sq.png') }}" alt="About Logo">
                            <div class="space-20"></div>
                            <h5 class="title">About</h5>
                            <div class="space-30"></div>
                            <h3 class="blue-color">Social app</h3>
                            <div class="space-20"></div>
                            <p>There are many people with same interest like you. <br />Spend your time with awesome people.</p>
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
                            <h5 class="title">Features</h5>
                            <div class="space-10"></div>
                            <h3>How it works?</h3>
                            <div class="space-60"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="service-box wow fadeInUp" data-wow-delay="0.4s">
                            <div class="box-icon">
                            <img src="{{ asset('/images/eco.png') }}" alt="Icon made by Freepik from www.flaticon.com">
                            </div>
                            <h4>Community</h4>
                            <p>Be a part of open-minded community</p>
                        </div>
                        <div class="space-60"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/friends.png') }}" alt="Icon made by flaticon from www.flaticon.com">
                            </div>
                            <h4>New friends</h4>
                            <p>Have some fun with people you feel comfortable with</p>
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
                                <img src="{{ asset('/images/forum.png') }}" alt="Icon made by Freepik from www.flaticon.com">
                            </div>
                            <h4>Forum</h4>
                            <p>Ask questions and get answer</p>
                        </div>
                        <div class="space-60"></div>
                        <div class="service-box wow fadeInUp" data-wow-delay="0.6s">
                            <div class="box-icon">
                                <img src="{{ asset('/images/people.png') }}" alt="Icon made by Freepik from www.flaticon.com">
                            </div>
                            <h4>Contacts</h4>
                            <p>Find people with same interests like you</p>
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
                                <h5 class="title">Contact</h5>
                                <h3 class="dark-color">Help us build better communities</h3>
                                <div class="space-60"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-12 col-sm-12">
                            <div class="footer-box">
                                <a href="mailto:contact@social-app.com" title="Write a message"><div class="box-icon">
                                    <span class="lnr lnr-envelope"></span>
                                </div></a>
                                <a href="mailto:contact@social-app.com" title="Write a message"><p>contact@social-app.com</p></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-5">
                        <span>Copyright &copy; 2020 social-app</span>
                            <div class="space-10 hidden visible-xs"></div>
                        </div>
                        <div class="col-xs-12 col-md-7">
                            <div class="footer-menu">
                                <ul>
                                    <a href="" target="_blank" title="Juff app - Facebook">
                                        <img src="{{ asset('/images/fb.png') }}" alt="Facebook">
                                    </a>
                                    <a href="" target="_blank" title="Juff app - Instagram">
                                        <img src="{{ asset('/images/ig.png') }}" alt="Instagram">
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

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
