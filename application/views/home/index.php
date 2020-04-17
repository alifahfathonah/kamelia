<html>
<head>
<title>Home</title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Hallo, <?php echo ucfirst($this->session->userdata('username')); ?></h1>
                <p class="lead">Silakan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <ul>
                    <li><a href="#">Tambah Kegiatan</a></li>
                    <li><a href="<?= site_url('home/logout') ?>">Logout</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
