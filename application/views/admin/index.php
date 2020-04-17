<html>
<head>
<title>Admin</title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if ($this->session->flashdata('user_added')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('user_added'); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Hallo admin, <?php echo ucfirst($this->session->userdata('username')); ?></h1>
                <p class="lead">Silakan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <ul>
                    <li><a href="<?= site_url('admin/adduser') ?>">Tambah User</a></li>
                    <li><a href="<?= site_url('admin/logout') ?>">Logout</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
