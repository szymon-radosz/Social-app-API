import React from "react";
import {Helmet} from "react-helmet";

const Home = () => {
    return(
        <>
        <Helmet>
            <meta charSet="utf-8"/>
            <meta name="author" content="John Doew"/>
            <meta name="description" content="Social app - People like you in your neighborhood"/>
            <meta name="keywords" content="app, community, friends"/>
            <meta http-equiv="x-ua-compatible" content="ie=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

            <title>Social app - People like you in your neighborhood</title>

            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"/>
            {/* <link rel="shortcut icon" src="image/ico" href="/images/favicon.png" /> */}

            <link rel="stylesheet" href="/css/bootstrap.min.css"/>
            <link rel="stylesheet" href="/css/style.css"/>
            <link rel="stylesheet" href="/css/responsive.css"/>
        </Helmet>
        <nav className="mainmenu-area" data-spy="affix" data-offset-top="200">
            <div className="container-fluid">
                <div className="navbar-header">
                    <button type="button" className="navbar-toggle navbar-toogle-custom" data-toggle="collapse" data-target="#primary_menu">
                        <span className="icon-bar"></span>
                        <span className="icon-bar"></span>
                        <span className="icon-bar"></span>
                    </button>
                    <a className="navbar-brand" href="#"><img src="/images/logo.png" alt="Logo"/></a>
                </div>
                <div className="collapse navbar-collapse" id="primary_menu">
                    <ul className="nav navbar-nav mainmenu">
                        <li className="active"><a href="#home_page">Home</a></li>
                        <li><a href="#about_page">About</a></li>
                        <li><a href="#features_page">How it works?</a></li>
                        <li><a href="#contact_page">Contact</a></li>
                    </ul>

                </div>
            </div>
        </nav>

        <header className="home-area overlay" id="home_page">
            <div className="container">
                <div className="row headerRow">
                    <div className="col-xs-12 hidden-sm col-md-4">
                        <figure className="mobile-image" >
                            <img src="/images/header-mobile.png" alt=""/>
                        </figure>
                    </div>
                    <div className="col-xs-12 col-md-8">
                        <div className="space-80 hidden-xs"></div>
                        <h1>People like you<br />in your neighborhood</h1>
                        <div className="space-20"></div>
                        <div className="desc">
                            <p>Find people with same interests like you</p>
                        </div>
                        <div className="space-20"></div>
                        <p className="headerIconText">Download</p>
                        <div className="headerIcons">
                            <a target="_blank" href="" title="Download App Store" className="appStoreHeader headerIcon"><img src="/images/appStore.png" alt="App Store"/></a>
                            <a target="_blank" href="" title="Google Play" className="googlePlayHeader headerIcon"><img src="/images/googlePlay.png" alt="Google Play"/></a>
                        </div>
                     </div>
                </div>
            </div>
        </header>

        <section className="section-padding" id="about_page">
            <div className="container">
                <div className="row">
                    <div className="col-xs-12 col-md-10 col-md-offset-1">
                        <div className="page-title text-center">
                            <img className="aboutImg" src="/images/logo-sq.png" alt="About Logo"/>
                            <div className="space-20"></div>
                            <h5 className="title">About</h5>
                            <div className="space-30"></div>
                            <h3 className="blue-color">Social app</h3>
                            <div className="space-20"></div>
                            <p>There are many people with same interest like you. <br />Spend your time with awesome people.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section className="feature-area section-padding-top" id="features_page">
            <div className="container">
                <div className="row">
                    <div className="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div className="page-title text-center">
                            <h5 className="title">Features</h5>
                            <div className="space-10"></div>
                            <h3>How it works?</h3>
                            <div className="space-60"></div>
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-xs-12 col-sm-6 col-md-4">
                    <div className="service-box wow fadeInUp" data-wow-delay="0.4s">
                            <div className="box-icon">
                            <img src="/images/eco.png" alt="Icon made by Freepik from www.flaticon.com"/>
                            </div>
                            <h4>Community</h4>
                            <p>Be a part of open-minded community</p>
                        </div>
                        <div className="space-60"></div>
                        <div className="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div className="box-icon">
                                <img src="/images/friends.png" alt="Icon made by flaticon from www.flaticon.com"/>
                            </div>
                            <h4>New friends</h4>
                            <p>Have some fun with people you feel comfortable with</p>
                        </div>
                        <div className="space-60"></div>
                    </div>
                    <div className="hidden-xs hidden-sm col-md-4">
                        <figure className="mobile-image">
                            <img src="/images/feature-image.png" alt="Feature Photo"/>
                        </figure>
                    </div>
                    <div className="col-xs-12 col-sm-6 col-md-4">
                        <div className="service-box wow fadeInUp" data-wow-delay="0.2s">
                            <div className="box-icon">
                                <img src="/images/forum.png" alt="Icon made by Freepik from www.flaticon.com"/>
                            </div>
                            <h4>Forum</h4>
                            <p>Ask questions and get answer</p>
                        </div>
                        <div className="space-60"></div>
                        <div className="service-box wow fadeInUp" data-wow-delay="0.6s">
                            <div className="box-icon">
                                <img src="/images/people.png" alt="Icon made by Freepik from www.flaticon.com"/>
                            </div>
                            <h4>Contacts</h4>
                            <p>Find people with same interests like you</p>
                        </div>
                        <div className="space-60"></div>
                    </div>
                </div>
            </div>
        </section>

        <footer className="footer-area" id="contact_page">
            <div className="section-padding">
                <div className="container">
                    <div className="row">
                        <div className="col-xs-12">
                            <div className="page-title text-center">
                                <h5 className="title">Contact</h5>
                                <h3 className="dark-color">Help us build better communities</h3>
                                <div className="space-60"></div>
                            </div>
                        </div>
                    </div>
                    <div className="row">

                        <div className="col-xs-12 col-sm-12">
                            <div className="footer-box">
                                <a href="mailto:contact@social-app.com" title="Write a message"><p>contact@social-app.com</p></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div className="footer-bottom">
                <div className="container">
                    <div className="row">
                        <div className="col-xs-12 col-md-5">
                        <span>Copyright &copy; 2020 social-app</span>
                            <div className="space-10 hidden visible-xs"></div>
                        </div>
                        <div className="col-xs-12 col-md-7">
                            <div className="footer-menu">
                                <ul>
                                    <a href="" target="_blank" title="Juff app - Facebook">
                                        <img src="/images/fb.png" alt="Facebook" />
                                    </a>
                                    <a href="" target="_blank" title="Juff app - Instagram">
                                        <img src="/images/ig.png" alt="Instagram" />
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </>
    )
}

export default Home;