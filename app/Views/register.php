<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Informasi Pelayanan | SIADMINDUK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="logo.png" rel="icon">
  <link href="logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:Kjatiwarna@gmail.com">Kjatiwarna@gmail.com</a>
        <i class="bi bi-phone"></i> +6281314387790
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="https://www.instagram.com/kelurahanjatiwarna?igsh=MW9pYmZhYXd3cDcxZw==" class="instagram"><i class="bi bi-instagram"></i> Instagram | </a>
      </div>
    </div>
    <marquee scrollamount="8" style="background-color: grey; color: white; font-style: Times New Roman;">
      <h4>Selamat menggunakan sistem pelayanan Adminduk, Silahkan pilih menu informasi layanan, untuk mengetahui informasi layanan di kelurahan jatiwarna</h4>
    </marquee>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="<?php echo base_url("/"); ?>">SIADMINDUK</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="<?php echo base_url("/"); ?>">Home</a></li>
          <li><a class="nav-link scrollto" href="<?php echo base_url("/informasi-pelayanan"); ?>">Informasi Layanan</a></li>
          <li><a class="nav-link scrollto active" href="<?php echo base_url("/registrasi-pelayanan"); ?>">Registrasi Pelayanan</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="<?php echo base_url("/login"); ?>" class="appointment-btn scrollto">Login</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="services" class="d-flex align-items-center">
    <div class="container text-center white">

    </div>
  </section><!-- End Hero -->

  <body>
    <main class="d-flex w-100">
      <div class="container d-flex flex-column">
        <div class="row vh-100">
          <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

              <div class="text-center mt-4">
                <h1 class="h2">Registrasi Pelayanan</h1>
                <p class="lead">
                  Silahkan melakukan proses registrasi sebelum datang ke kelurahan jatiwarna
                </p>
              </div>

              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <?php
                      $inputs = session()->getFlashdata('inputs');
                      $errors = session()->getFlashdata('errors');
                      if (!empty($errors)) { ?>
                        <div class="alert alert-danger" role="alert">
                          Whoops! Ada kesalahan saat input data, yaitu:
                          <ul>
                            <?php foreach ($errors as $error) : ?>
                              <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                          </ul>
                        </div>
                      <?php } ?>
                      <div class="card shadow">
                        <div class="card-body">
                          <?php echo form_open_multipart('data_administrasi/pendaftaran'); ?>
                          <div class="form-group">
                            <label class="form-label" for="pelayanan">Pilih Layanan</label>
                            <select class="form-control form-control-lg" id="pelayanan" name="pelayanan">
                            <option>--- Pilih Pelayanan ---</option>
                              <option value="pembaharuan_kk">Pembaharuan KK</option>
                              <option value="surat_keterangan_pindah">Surat Keterangan Pindah</option>
                              <option value="perekaman_ktp">Perekaman KTP</option>
                              <option value="pembuatan_kia">Pembuatan KIA</option>
                              <option value="pembuatan_akte_lahir">Pembuatan Akte Lahir</option>
                              <option value="pembuatan_akte_kematian">Pembuatan Akte Kematian</option>
                            </select>
                          </div><br>
                          <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input class="form-control form-control-lg" type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" style="margin-top: 10px;" required> <!-- Menambahkan required di sini -->
                          </div><br>
                          <div class="form-group">
                            <label class="form-label" for="nik">No NIK</label>
                            <input class="form-control form-control-lg" type="text" id="nik" name="nik" placeholder="Masukan No NIK" style="margin-top: 10px;" required> <!-- Menambahkan required di sini -->
                          </div><br>
                          <div class="form-group">
                            <label class="form-label" for="kk">No KK</label>
                            <input class="form-control form-control-lg" type="text" id="kk" name="kk" placeholder="Masukan No KK" style="margin-top: 10px;" required> <!-- Menambahkan required di sini -->
                          </div><br>
                          <div class="form-group">
                            <label class="form-label" for="alamat">Alamat Lengkap</label>
                            <input class="form-control form-control-lg" type="text" id="alamat" name="alamat" placeholder="Masukan Alamat Lengkap" style="margin-top: 10px;" required> <!-- Menambahkan required di sini -->
                          </div><br>

                          <div class="form-group">
                            <label class="form-label" for="kedatangan">Tanggal Kedatangan</label>
                            <input class="form-control form-control-lg" type="date" value="kedatangan" name="kedatangan" style="margin-top: 10px;" required> <!-- Menambahkan required di sini -->
                          </div><br>
                          <div class="text-center"> <!-- Tambahkan class text-center untuk tombol -->
                            <button type="submit" class="btn btn-primary">Daftar</button> <!-- Hapus class text-center di sini -->
                          </div><br>
                          </form>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="js/app.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(e) {
          e.preventDefault(); // Hindari pengiriman form
          Swal.fire({
            title: 'Terima kasih!',
            text: 'Pendaftaran berhasil dilakukan. Silahkan kunjungi kelurahan sesuai dengan tanggal kedatangan anda :)',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => {
            this.submit(); // Kirim form setelah pengguna menekan tombol OK
          });
        });
      });
    </script>

  </body>

</html>