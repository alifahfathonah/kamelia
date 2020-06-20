<html>
<head>
<title> <?= $role == 1 ? 'Admin' : 'Home'; ?> - Tambah Kegiatan </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-2 mx-auto p-4">
                <h1 class="h2">Tambah Review</h1>
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
                    <div class="form-group">
                    <label for="nama">Review Kegiatan</label>
                        <textarea class="form-control" name="review" rows="3"><?= $review->review ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status kegiatan</label>
                        <select name="status" id="" class="form-control">
                        <option <?= $review->status == 1 ? 'selected' : '' ?> value="1">Diajukan</option>
                        <option <?= $review->status == 2 ? 'selected' : '' ?> value="2">Selesai</option>
                        <option <?= $review->status == 3 ? 'selected' : '' ?> value="3">Gagal terlaksana</option>
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
