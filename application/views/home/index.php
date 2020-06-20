<html>
<head>
<title>Home</title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.0.slim.min.js" integrity="sha256-MlusDLJIP1GRgLrOflUQtshyP0TwT/RHXsI1wWGnQhs=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
        <?php if ($this->session->flashdata('user_updated')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('user_updated'); ?>
            </div>
        <?php endif; ?>
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Hallo, <?php echo ucfirst($this->session->userdata('username')); ?></h1>
                <p class="lead">Silakan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <ul>
                    <li><a href="<?= site_url('home/kegiatan') ?>">Daftar kegiatan</a></li>
                    <li><a href="<?= site_url('home/kegiatan/add') ?>">Tambah kegiatan</a></li>
                    <li><a href="<?= site_url('home/user/profile') ?>">Edit Profile</a></li>
                    <li><a href="<?= site_url('home/logout') ?>">Logout</a></li>
                </ul>
            </div>
            </div>
        </div>
        
    </div>
    <script>
    $(document).ready(function() {
    var t = $('#kegiatan').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
    </script>
</body>
</html>
