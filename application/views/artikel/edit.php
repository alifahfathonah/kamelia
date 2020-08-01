<html>
<head>
<title>Admin</title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Sunting Artikel</h1>
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
            <?php if ($this->session->flashdata('errorImage')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('errorImage'); ?>
                </div>
            <?php endif; ?>
                <?php echo form_open_multipart(); ?>
                    <div class="form-group">
                        <label for="judul">Masukkan Judul</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul" value="<?= $artikel->judul ?>" />
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Gambar</label>
                        <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="isi">Konten</label>
                        <textarea class="form-control" name="isi" rows="3"><?= $artikel->isi ?></textarea>
                    </div>
                    <input type="hidden" name="old_thumbnail" value="<?= $artikel->thumbnail ?>">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Sunting" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
