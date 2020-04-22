<html>
<head>
<title>Admin</title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Tambah user</h1>
                <p class="lead">Isi data dengan benar</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8 col-md-8 mx-auto p-4">
            <?php if (validation_errors()): ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
                <?php echo form_open('admin/addJenis'); ?>
                    <div class="form-group">
                        <label for="nama">Masukkan Jenis</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Jenis"  />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Tambah" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
