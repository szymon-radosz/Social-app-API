
<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      body {
        text-align: center;
        background-color: #f5f6f7;
        font-family: sans-serif;
      }
      #container {
        padding-top: 30px;
        padding-bottom: 30px;
        background-color: #fff;
        width: 500px;
        margin: 0 auto;
      }
      #lonelyheart {
        display: block;
        margin: 0 auto 10px auto;
        width: 50px;
      }
      #thanks {
        width: 500px;
        margin-bottom: -10px;
      }
      .red {
        color: #f05b60;
      }
      .button {
        text-transform: uppercase;
        background-color: #f05b60;
        width: 300px;
        margin: 0 auto;
        border-radius: 2px;
        color: #fff;
        padding: 20px;
      }
      #verify {
        display: block;
        margin-top: 20px;
        text-decoration: none;
        font-weight: bold;
      }
      #shop {
        text-decoration: none;
      }
      hr {
        width: 350px;
        margin: 30px auto;
      }
      .expectation {
        margin-top: 30px;
      }
      .expectation img {
        width: 50px;
        float: left;
        margin-left: 100px;
      }
      .expectation .description {
        margin-left: 180px;
        text-align: left;
      }
      .expectation h4 {
        text-align: left;
        display: inline;
      }
      #footer {
        padding: 20px 0 10px 0;
        background-color: #f05b60;
        width: 500px;
        margin: 0 auto 20px auto;
        color: #fff;
        text-align: center;
      }
      #app {
        width: 50px;
        margin-bottom: 15px;
      }
      .get {
        margin: 15px 0px;
      }
      .social {
        margin-bottom: 20px;
      }
      .social a {
        margin: 0 10px;
      }
      .address {
        font-size: 12px;
        color: #666;
      }
      .address div {
        margin-bottom: 3px;
      }
      h4 {
        font-size: 1.35em;
        font-weight: 500;
        letter-spacing: 0.5px;
      }
      .getps {
        font-size: 0.85em;
        margin: 0;
        padding: 0;
        font-weight: 300;
      }
      .tagline {
        font-size: 0.85em;
        font-weight: 100;
        margin: 4px 0;
        padding: 0;
      }
      .cta-link {
        font-size: 0.85em;
        color: #f15a5f;
        font-weight: 100;
      }
    </style>
  </head>

  <body
    style="text-align: center;background-color: #F5F6F7;font-family: sans-serif; padding: 20px 0"
  >
    <img
      id="lonelyheart"
      src="https://e-mamy.pl/images/about-logo.png"
      style="display: block;margin: 0 auto 20px auto;width: 68px; "
    />
    <img
      id="thanks"
      src="https://e-mamy.pl/images/header-bg.jpg"
      style="width: 500px;margin-bottom: -10px;"
    />
    <div
      id="container"
      style="padding-top: 60px;padding-bottom: 30px;background-color: #FFF;width: 500px;margin: 0 auto;"
    >
      <strong class="red" style="color: #f4a157;">
        Resetowanie hasła<br /><br />
        Resetuj hasło, klikając poniższy przycisk.
      </strong>

      <a
        id="verify"
        href="{{url('/reset-password/' . $token)}}"
        target="_blank"
        style="display: block;margin-top: 20px;text-decoration: none;font-weight: bold;"
      >
        <div
          class="button"
          style="text-transform: uppercase;background-color: #f4a157;width: 300px;margin: 0 auto 30px auto;border-radius: 2px;color: #FFF;padding: 26px; font-size:smaller; letter-spacing:.5px;"
        >
          Resetuj hasło
        </div>
      </a>
    </div>

    <div
      id="footer"
      style="padding: 30px 0 15px 0;background-color: #f4a0579f;width: 500px;margin: 0 auto 30px auto;color: #FFF;text-align: center;"
    >
      <img
        id="app"
        src="https://e-mamy.pl/images/about-logo.png"
        style="width: 62px;margin-bottom: 15px;"
      />
      <div>
        <p
          class="getps"
          style="font-size: .85em;margin: 0;padding: 0;font-weight: 300;"
        >
          Pobierz E-mamy
        </p>
      </div>
      <div>
        <a 
          href="https://apps.apple.com/il/app/e-mamy/id1477994168"
          title="Pobierz E-mamy z App Store"
          target="_blank">
          <img
            class="get"
            src="https://e-mamy.pl/images/appStore.png"
            style="max-height:36px;margin: 15px 1px;"
          />
        </a>
        <a
		      href="https://play.google.com/store/apps/details?id=com.emamy"
          title="Pobierz E-mamy z Google Play"
          target="_blank"
        >
          <img
            class="get"
            src="https://e-mamy.pl/images/googlePlay.png"
            style="max-height:36px; margin: 15px 1px;"
          />
        </a>
      </div>
    </div>
    <div class="social" style="margin-bottom: 20px;">
	<a
        href="https://www.facebook.com/E-mamy-678607299320582/"
        style="margin: 0 10px;text-decoration:none;"
      >
        <img
          src="https://s3.amazonaws.com/socialps-assets/join/fb.png?a=2"
          style="max-height: 25px;"
        />
      </a>
      <a
        href="https://www.instagram.com/emamy_pl/"
        style="margin: 0 10px;text-decoration:none;"
      >
        <img
          src="https://s3.amazonaws.com/socialps-assets/join/ig.png?a=2"
          style="max-height: 25px;"
        />
      </a>
    </div>
    <div
      class="address"
      style="font-size: 13px;color: #666; margin-top:30px; font-weight: 100;"
    >
      <div style="margin-bottom: 4px;">E-mamy.pl</div>
      <div style="margin-bottom: 4px;">
        Bądź częścią lokalnej społeczności mam
      </div>
    </div>
  </body>
</html>
