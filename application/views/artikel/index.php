<html>
<head>
<title> <?=$role == 1 ? 'Admin' : 'Home';?> - Daftar Artikel </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style>
    .action{
        display: inline-block;
        /* padding: 20px; */
    }
</style>
</head>
<body>
    <div class="container">
        <?php if ($this->session->flashdata('artikel_added')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('artikel_added'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('artikel_updated')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('artikel_updated'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('artikel_deleted')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('artikel_deleted'); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Daftar Artikel</h1>
                <p class="lead">Daftar</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <table id="artikel" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artikel as $art): ?>
                    <tr>
                        <td></td>
                        <td><?=$art->judul?></td>
                        <td><?= substr(strip_tags($art->isi), 0, 100) ?>...</td>
                        <td>
                            <?php if ($art->kategori_id == 1): ?>
                            Berita
                            <?php else: ?>
                            Esai
                            <?php endif; ?>
                        </td>
                        <td style='white-space: nowrap'>
                            <a href="<?= site_url('/admin/artikel/edit/'.$art->id) ?>" 
                            class="btn btn-primary">Edit</a>
                            <a href="<?= site_url('/admin/artikel/delete/'.$art->id) ?>" 
                            class="btn btn-danger">Hapus</a>
                            <a href="<?= site_url('/admin/artikel/'.$art->id) ?>" 
                            class="btn btn-info">Lihat</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
       $(document).ready(function() {
            var t = $('#artikel').DataTable( {
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                // "order": [[ 1, 'asc' ]]
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
