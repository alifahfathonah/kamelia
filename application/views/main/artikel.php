
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>
    

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
    .footer {
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: red;
        color: white;
        }
    </style>
  </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
    <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Bootstrap
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <ul class="navbar-nav">
        <form class="form-inline" action="<?= $base_url ?>" method="GET">
          <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
          <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Search">
        </form>
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('login') ?>">Login</a>
        </li>
    </ul>
  </div>
</nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?php foreach ($artikel as $art): ?>
        <div class="col-md-4">
        <h2><?= $art->judul ?></h2>
          <p><?= substr(strip_tags($art->isi), 0, 100) ?>...</p>
          <p><a class="btn btn-secondary" href="<?= site_url('/artikel/').$art->slug?>" role="button">View details &raquo;</a></p>
        </div>
        <?php endforeach;?>
      </div>
      <div class="row">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
      </div>

      <hr>
      </div> <!-- /container -->
      <footer class="footer d-flex mt-auto">
        <div class="container" style="padding: 50px;">
            <div class="row">
            <div class="col-lg-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae quo, suscipit officia ducimus neque, rerum soluta facilis temporibus ipsam aspernatur delectus quis. A omnis culpa quae quas repudiandae facilis nam.</p>
            </div>
            <div class="col-lg-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio aperiam, repudiandae doloremque laboriosam similique laudantium corporis quaerat debitis impedit quas minus reprehenderit, quis eligendi dolore id doloribus odit ratione minima.</p>
            </div>
            <div class="col-lg-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci ipsam quam aspernatur nulla et fugit sint perferendis ea, tenetur, est qui facilis officia, nemo soluta ipsa impedit, nesciunt fuga! Nemo!</p>
            </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js') ?>"></script>
  </body>
</html>
