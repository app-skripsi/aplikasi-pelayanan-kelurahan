<?php echo view("_partials/head"); ?>

<body>
    <div class="wrapper">
        <?php echo view("_partials/navbar"); ?>
        <div class="main">
            <?php echo view("_partials/profile"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h1 class="h2 float-center">Form Registrasi Data Pelayanan</h1>
                    </div>

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
                                    <form action="<?= base_url('data_administrasi/store'); ?>" method="post">
                                        <div class="form-group">
                                            <label class="form-label" for="pelayanan">Pilih Layanan</label>
                                            <select class="form-control form-control-lg" id="pelayanan" name="pelayanan">
                                                <option>--- Silahkan Pilih Pelayanan ---</option>
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
                                            <input class="form-control form-control-lg" type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="nik">No NIK</label>
                                            <input class="form-control form-control-lg" type="text" id="nik" name="nik" placeholder="Masukan No NIK" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="kk">No KK</label>
                                            <input class="form-control form-control-lg" type="text" id="kk" name="kk" placeholder="Masukan No KK" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="alamat">Alamat Lengkap</label>
                                            <input class="form-control form-control-lg" type="text" id="alamat" name="alamat" placeholder="Masukan Alamat Lengkap" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="kedatangan">Tanggal Kedatangan</label><br>
                                            <input class="form-control form-control-lg" type="date" value="kedatangan" name="kedatangan" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="form-control form-control-lg" id="status" name="status">
                                                <option value="waiting">Waiting</option>
                                                <option value="proses">Proses</option>
                                                <option value="verifikasi">Verifikasi</option>
                                                <option value="eksekusi">Eksekusi</option>
                                                <option value="done">Done</option>
                                            </select>
                                        </div><br>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php echo view("_partials/footer"); ?>
        </div>
    </div>

    <?php echo view("_partials/script"); ?>

</body>

</html>