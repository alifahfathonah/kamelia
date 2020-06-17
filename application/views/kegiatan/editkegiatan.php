<html>
<head>
<title> <?= $role == 1 ? 'Admin' : 'Home'; ?> - Edit Kegiatan </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Edit Kegiatan</h1>
                <p class="lead">Isi data dengan benar</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3  mx-auto p-4">
            <?php if (validation_errors()): ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
                <?php echo form_open(); ?>
                <input type="hidden" name="id" value="<?= $kegiatan->id?>" />
                    <div class="form-group">
                        <label for="nama">Nama Kegiatan</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama kegiatan" value="<?= $kegiatan->nama ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kegiatan</label>
                        <select class="form-control" name="jenis_id">
                            <option value="" selected hidden disabled>Pilih Jenis Kegiatan</option>
                            <?php foreach ($jenis as $jen): ?>
                            <option <?php if ($kegiatan->jenis_id == $jen->id ) echo 'selected' ; ?> value="<?php echo $jen->id; ?>" ><?php echo ucfirst($jen->nama);?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" placeholder="Masukkan lokasi" value="<?= $kegiatan->lokasi ?>" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Appointment Time</label>
                        <div class='input-group date' id='datetimepicker'>
                            <input type='text' name='waktu' class="form-control" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pembicara">Pembicara</label>
                        <input type="text" class="form-control" name="pembicara" placeholder="Masukkan pembicara" value="<?= $kegiatan->pembicara ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="pj">Penanggungjawab Kegiatan</label>
                        <input type="text" class="form-control" name="pj" placeholder="Masukkan pj" value="<?= $kegiatan->pj ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="4"><?= $kegiatan->deskripsi ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" class="form-control" id="" cols="30" rows="4"><?= $kegiatan->catatan ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Sunting" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                defaultDate: '<?= $kegiatan->waktu ?>'
            });
        });
    </script>
</body>
</html>
