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
                <?php echo form_open(); ?>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama" value="<?=$user->nama?>"  />
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan username" value="<?=$user->username?>" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password"  />
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email" value="<?=$user->email?>" />
                    </div>
                    <div class="form-group">
                        <label for="role">Sebagai</label>
                        <select name="role" id="" class="form-control">
                        <option <?= $user->role == 1 ? 'selected' : '' ?> value="1">Admin</option>
                        <option <?= $user->role == 2 ? 'selected' : '' ?> value="2">Sub Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Sunting" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
