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
                                    <form action="<?= base_url('data_administrasi/store'); ?>" method="post"><br>
                                        <div class="form-group">
                                            <label class="form-label" for="pelayanan_id">Pilih pelayanan </label>
                                            <select class="form-control" id="pelayanan_id" name="pelayanan_id">
                                                <option value="">Pilih pelayanan</option> <!-- Tambahkan opsi ini -->
                                                <?php foreach ($pelayanan as $pelayananItem) : ?>
                                                    <option value="<?= $pelayananItem['id']; ?>">
                                                        <?= $pelayananItem['pelayanan']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="nama">Nama Lengkap</label>
                                            <input class="form-control form-control-lg" type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="nik">*<b>No NIK</b></label>
                                            <input class="form-control form-control-lg" type="number" id="nik" name="nik" placeholder="Masukan No NIK" style="margin-top: 10px;" maxlength="16" oninput="validateLength(this)" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label class="form-label" for="kk">*<b>No KK</b></label>
                                            <input class="form-control form-control-lg" type="number" id="kk" name="kk" placeholder="Masukan No KK" style="margin-top: 10px;" maxlength="16" oninput="validateLength(this)" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="no_telephone">Nomor Telephone</label>
                                            <input class="form-control form-control-lg" type="text" id="no_telephone" name="no_telephone" placeholder="Masukan Nomor Telephone" maxlength="12" oninput="validateNumber(this)" required />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Masukan Email" />
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
                                                <?php if (session()->get('level') == 1) { ?>
                                                    <option value="waiting">Waiting</option>
                                                    <option value="proses">Proses</option>
                                                <?php } ?>
                                                <?php if (session()->get('level') == 2) { ?>
                                                    <option value="verifikasi">Verifikasi</option>
                                                    <option value="eksekusi">Eksekusi</option>
                                                    <option value="valid">Valid</option>
                                                    <option value="done">Done</option>
                                                <?php } ?>
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
    <script>
        function validateLength(input) {
            input.value = input.value.replace(/\D/g, '');
            if (input.value.length > 16) {
                alert("Panjang melebihi batas maksimal 16 angka.");
                input.value = input.value.slice(0, 16);
            }
        }
        function validateNumber(input) {
            input.value = input.value.replace(/\D/g, '');
            if (input.value.length > 12) {
                alert("Panjang melebihi batas maksimal 12 angka.");
                input.value = input.value.slice(0, 12);
            }
        }
    </script>
</body>

</html>