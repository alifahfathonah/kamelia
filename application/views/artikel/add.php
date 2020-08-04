<!DOCTYPE html>
<head>
<title>Admin</title>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
      tinymce.init({
        selector: 'textarea#isi'
      });
</script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Tambah Artikel</h1>
                <p class="lead">Isi data dengan benar</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8 col-md-8 mx-auto p-4">
            <?php if (validation_errors()): ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('errorImage')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('errorImage'); ?>
                </div>
            <?php endif;?>
                <?php echo form_open_multipart('admin/addArtikel'); ?>
                    <div class="form-group">
                        <label for="judul">Masukkan Judul</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul"  />
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Gambar</label>
                        <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="isi">Konten</label>
                        <textarea id="isi" class="form-control" name="isi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori Tulisan</label>
                        <select class="form-control" name="kategori_id">
                            <option value="" selected hidden disabled>Pilih Kategori</option>
                            <?php foreach ($kategori as $kat): ?>
                            <option value="<?php echo $kat->id; ?>"><?php echo ucfirst($kat->nama);?> </option>
                            <?php endforeach; ?>
                        </select>
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
