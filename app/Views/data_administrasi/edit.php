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
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            <div class="card shadow">
                                <div class="card-body">
                                    <form
                                        action="<?= site_url('data_administrasi/update/' . $data_administrasi['id']); ?>" method="post">
                                        <?php echo form_hidden('id', $data_administrasi['id']); ?>
                                        <div class="form-group">
                                            <?php echo form_label('Pelayanan', 'pelayanan_id'); ?>
                                            <?php echo form_dropdown('pelayanan_id', $pelayanan, $data_administrasi['pelayanan_id'], ['class' => 'form-control']); ?>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="nama">Nama Lengkap</label>
                                            <input class="form-control form-control-lg" type="text" id="nama"
                                                name="nama"
                                                value="<?php echo isset($data_administrasi['nama']) ? $data_administrasi['nama'] : ''; ?>" />
                                        </div>
                                        <div class="form-group"><br>
                                            <label class="form-label" for="nik">No NIK</label>
                                            <input class="form-control form-control-lg" type="text" id="nik" name="nik"
                                                value="<?php echo isset($data_administrasi['nik']) ? $data_administrasi['nik'] : ''; ?>" />
                                        </div>
                                        <div class="form-group"><br>
                                            <label class="form-label" for="kk">No KK</label>
                                            <input class="form-control form-control-lg" type="text" id="kk" name="kk"
                                                value="<?php echo isset($data_administrasi['kk']) ? $data_administrasi['kk'] : ''; ?>" />
                                        </div>
                                        <div class="form-group"><br>
                                            <label class="form-label" for="alamat">Alamat Lengkap</label>
                                            <input class="form-control form-control-lg" type="text" id="alamat"
                                                name="alamat"
                                                value="<?php echo isset($data_administrasi['alamat']) ? $data_administrasi['alamat'] : ''; ?>" />
                                        </div>
                                        <div class="form-group"><br>
                                            <label class="form-label" for="kedatangan">Tanggal Kedatangan</label>
                                            <input class="form-control form-control-lg" type="date" id="kedatangan"
                                                name="kedatangan"
                                                value="<?php echo isset($data_administrasi['kedatangan']) ? $data_administrasi['kedatangan'] : ''; ?>" />
                                        </div><br>
                                        <div class="form-group">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="form-control form-control-lg" name="status" id="status">
                                                <option value=""></option>
                                                <?php if (session()->get('level') == 1) { ?>
                                                    <option value="waiting" <?php echo (isset($data_administrasi['status']) && $data_administrasi['status'] == 'waiting') ? 'selected' : ''; ?>>
                                                        Waiting</option>
                                                    <option value="proses" <?php echo (isset($data_administrasi['status']) && $data_administrasi['status'] == 'proses') ? 'selected' : ''; ?>>
                                                        Proses</option>
                                                <?php } ?>
                                                <?php if (session()->get('level') == 2) { ?>
                                                    <option value="verifikasi" <?php echo (isset($data_administrasi['status']) && $data_administrasi['status'] == 'verifikasi') ? 'selected' : ''; ?>>
                                                        Verifikasi</option>
                                                    <option value="eksekusi" <?php echo (isset($data_administrasi['status']) && $data_administrasi['status'] == 'eksekusi') ? 'selected' : ''; ?>>
                                                        Eksekusi</option>
                                                    <option value="done" <?php echo (isset($data_administrasi['status']) && $data_administrasi['status'] == 'done') ? 'selected' : ''; ?>>Done
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">update</button>
                                        </div>
                                    </form>
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