<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 text-center mt-5 mx-auto p-4">
                <h1 class="h2">Login User</h1>
                <p class="lead">Silahkan masuk</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-5 mx-auto mt-5">
                <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= site_url('/auth/login') ?>" method="POST">
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" class="form-control" name="username" placeholder="Pakai username juga bisa.." required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password.." required />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Login" />
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>