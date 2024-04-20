<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="logo.png" />
    <link href="logo.png" rel="icon">
    <link href="logo.png" rel="apple-touch-icon">

    <title>LogIn | SIADMINDUK</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

    <style>
        /* Your custom styles here */
    </style>
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h1"><b>SIADMINDUK</b></h1>
                            <img src="logo.png" class="rounded mx-auto d-block"><br>
                            <p class="lead"><b>Sistem Informasi Adminduk</b></p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                                        <div class="alert alert-success"><?php echo session()->getFlashdata('sukses'); ?></div>
                                    <?php } ?>
                                    <?php if (!empty(session()->getFlashdata('haruslogin'))) { ?>
                                        <div class="alert alert-info"><?php echo session()->getFlashdata('haruslogin'); ?></div>
                                    <?php } ?>
                                    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                                        <div class="alert alert-warning"><?php echo session()->getFlashdata('gagal'); ?></div>
                                    <?php } ?>
                                    <?php echo form_open('authentication'); ?>
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input class="form-control form-control-lg" type="text" name="username"  id="username" placeholder="Masukan Username disini" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Masukan Password disini" />
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Login</button>
                                        </div>
                                    </form>
                                    <?php echo form_close(); ?>
                                    <div class="d-grid gap-2 mt-3">
                                        <a href="<?php echo base_url("/"); ?>" class="btn btn-lg btn-success"><i class='fas fa-angle-double-left'></i> Klik, untuk kembali ke beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/app.js"></script>

    <script>
        <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo session()->getFlashdata("sukses"); ?>'
            });
        <?php } ?>

        <?php if (!empty(session()->getFlashdata('haruslogin'))) { ?>
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: '<?php echo session()->getFlashdata("haruslogin"); ?>'
            });
        <?php } ?>

        <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo session()->getFlashdata("gagal"); ?>'
            });
        <?php } ?>
    </script>
</body>

</html>
