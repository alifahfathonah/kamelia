<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Landing page</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="/assets/landing/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="/assets/landing/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/landing/lib/animate/animate.min.css" rel="stylesheet">
  <link href="/assets/landing/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="/assets/landing/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets/landing/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="/assets/landing/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: BizPage
    Theme URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto">IMM Cabang Sukoharjo</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Beranda</a></li>
          <li><a href="#berita">Berita</a></li>
          <li><a href="#esai">Esai</a></li>
          <li><a href="<?= site_url('calendar') ?>">Kalender Kegiatan</a></li>
          <li><a href="#profil">Profil</a></li>
          <li><a href="<?= site_url('login') ?>">Login</a></li>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active">
            <div class="carousel-background"><img src="<?= site_url('uploads/images/thumbnails/').$artikel[0]->thumbnail ?>" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2><?= $artikel[0]->judul ?></h2>
                <p><?= substr(strip_tags($artikel[0]->isi), 0, 100) ?>...</p>
                <a href="<?= $artikel[0]->kategori_id == 1 ? site_url('berita/').$artikel[0]->slug : site_url('esai/').$artikel[0]->slug ?>" class="btn-get-started scrollto">Lihat</a>
              </div>
            </div>
          </div>

          <?php foreach($artikel as $key => $value): ?>
            <?php if($key > 0): ?>
            <div class="carousel-item">
                <div class="carousel-background"><img src="<?= site_url('uploads/images/thumbnails/').$value->thumbnail ?>" alt=""></div>
                <div class="carousel-container">
                <div class="carousel-content">
                    <h2><?= $value->judul ?></h2>
                    <p><?= substr(strip_tags($value->isi), 0, 100) ?>...</p>
                    <a href="<?= $value->kategori_id == 1 ? site_url('berita/').$value->slug : site_url('esai/').$value->slug ?>" class="btn-get-started scrollto">Lihat</a>
                </div>
                </div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>

        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">

  

   

    <!--==========================
      Berita Section
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div id="berita" class="container">

        <header class="section-header">
          <h3 class="section-title">Berita</h3>
        </header>    
        <div class="row portfolio-container">

          <?php foreach($berita as $value): ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
                <div class="portfolio-wrap">
                    <figure>
                        <img src="<?= site_url('uploads/images/thumbnails/').$value->thumbnail ?>" class="img-fluid" alt="">
                        <a href="<?= site_url('berita/').$value->slug ?>" class="link-preview"><i class="ion ion-eye"></i></a>
                    </figure>

                    <div class="portfolio-info">
                        <h4><a href="<?= site_url('berita/').$value->slug ?>"><?= substr(strip_tags($value->judul), 0, 84) ?></a></h4>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        </div>

        <div class="text-center"> 
            <a href="<?= site_url('berita') ?>" class="btn btn-danger mt-5">LIHAT SEMUA BERITA</a> 
        </div> 

      </div>
    </section><!-- #berita -->

     <!--==========================
      Esai Section
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div id="esai" class="container">

        <header class="section-header">
          <h3 class="section-title">Esai</h3>
        </header>    
        <div class="row portfolio-container">

            <?php foreach($esai as $value): ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
                    <div class="portfolio-wrap">
                        <figure>
                            <img src="<?= site_url('uploads/images/thumbnails/').$value->thumbnail ?>" class="img-fluid" alt="">
                            <a href="<?= site_url('esai/').$value->slug ?>" class="link-preview"><i class="ion ion-eye"></i></a>
                        </figure>

                        <div class="portfolio-info">
                            <h4><a href="<?= site_url('esai/').$value->slug ?>"><?= substr(strip_tags($value->judul), 0, 84) ?></a></h4>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="text-center"> 
            <a href="<?= site_url('esai') ?>" class="btn btn-danger mt-5">LIHAT SEMUA ESAI</a> 
        </div> 

      </div>
    </section><!-- #esai -->
   
   <!--==========================
      Profil Section
    ============================-->
    <section id="profil">
      <div class="container">
        <header class="section-header">
          <h3>About Us</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </header>
    </section>

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>IMM Cabang Sukoharjo</h3>
            <p>Ini tentang cabang sukoharjo.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="ion-ios-arrow-right"></i> <a href="#intro">Beranda</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#berita">Berita</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#esai">Esai</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="<?= site_url('calendar') ?>">Kalender kegiatan</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#profil">Profil</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href=""<?= site_url('login') ?>"">Login</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Alamat & Kontak</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <!-- <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div> -->

          </div>

          <!-- <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div> -->

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Ismi Kamelia</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="/assets/landing/lib/jquery/jquery.min.js"></script>
  <script src="/assets/landing/lib/jquery/jquery-migrate.min.js"></script>
  <script src="/assets/landing/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/landing/lib/easing/easing.min.js"></script>
  <script src="/assets/landing/lib/superfish/hoverIntent.js"></script>
  <script src="/assets/landing/lib/superfish/superfish.min.js"></script>
  <script src="/assets/landing/lib/wow/wow.min.js"></script>
  <script src="/assets/landing/lib/waypoints/waypoints.min.js"></script>
  <script src="/assets/landing/lib/counterup/counterup.min.js"></script>
  <script src="/assets/landing/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="/assets/landing/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="/assets/landing/lib/lightbox/js/lightbox.min.js"></script>
  <script src="/assets/landing/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="/assets/landing/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="/assets/landing/js/main.js"></script>

</body>
</html>
