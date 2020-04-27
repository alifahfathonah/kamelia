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
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Hallo, <?php echo ucfirst($this->session->userdata('username')); ?></h1>
                <p class="lead">Silakan</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <ul>
                    <li><a href="#">Tambah Kegiatan</a></li>
                    <li><a href="<?=site_url('home/logout')?>">Logout</a></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
            <table id="kegiatan" class="display" style="width:100%" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Jenis</th>
                        <th>Lokasi</th>
                        <th>Penanggungjawab</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kegiatan as $key => $keg):?>
                    <tr>
                        <td></td>
                        <td><?php echo $keg->nama;?></td>
                        <td><?php echo $this->kegiatan_model->getJenis($keg->jenis_id);?></td>
                        <td><?php echo $keg->lokasi;?></td>
                        <td><?php echo $keg->pj;?></td>
                        <td><?php echo date("d-m-Y", strtotime($keg->waktu));;?></td>
                        <td>
                            <?php
                                switch ($keg->status) {
                                    case 1:
                                        echo "Diajukan";
                                        break;
                                    case 2:
                                        echo "Selesai";
                                        break;
                                    case 3:
                                        echo "Gagal";
                                        break;
                                }
                            ?>
                        </td>
                        <td>
                                <a href="#<?php echo $keg->id;?>" class="btn btn-info">
                                    Review
                                </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Jenis</th>
                        <th>Lokasi</th>
                        <th>Penanggungjawab</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Review</th>
                    </tr>
                </tfoot>
            </table>
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
