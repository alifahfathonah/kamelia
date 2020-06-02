<html>
<head>
<title> <?=$role == 1 ? 'Admin' : 'Home';?> - Tambah Kegiatan </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <?php if ($this->session->flashdata('kegiatan_added')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('kegiatan_added'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('kegiatan_updated')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('kegiatan_updated'); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Daftar Kegiatan</h1>
                <p class="lead">Daftar</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
            <table id="kegiatan" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Penanggungjawab</th>
                        <th>Waktu</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Review</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kegiatan as $keg): ?>
                    <tr>
                        <td></td>
                        <td><?=$keg->nama?></td>
                        <td><?=$keg->lokasi?></td>
                        <td><?=$keg->pj?></td>
                        <td><?=date('d-m-Y', strtotime($keg->waktu))?></td>
                        <td><?=$keg->catatan?></td>
                        <td><?=$keg->status?></td>
                        <td><?=($keg->review == null ? 'Belum ada' : '$keg->review')?></td>
                        <td>
                            <a href="<?= site_url('admin/kegiatan/edit/'.$keg->id) ?>" class="btn btn-success">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Penanggungjawab</th>
                        <th>Waktu</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Review</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
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
        } )
    </script>
</body>
</html>
