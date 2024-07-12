<?php echo view("_partials/head"); ?>

<body>
    <div class="wrapper">
        <?php echo view("_partials/navbar"); ?>
        <div class="main">
            <?php echo view("_partials/profile"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h1 class="h3">Data Administrasi</h1>
                        <div>
                            <?php if (session()->get('level') == 1) { ?>
                                <a class="btn btn-primary me-2" href="<?php echo base_url('data_administrasi/create'); ?>">Tambah Data</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data-administrasi-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis Pelayanan</th>
                                                    <th>Nama</th>
                                                    <th>Nik</th>
                                                    <th>KK</th>
                                                    <th>Alamat</th>
                                                    <th>Nomor Telephone</th>
                                                    <th>Email</th>
                                                    <th>Kedatangan</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data_administrasi as $key => $row) { ?>
                                                    <tr>
                                                        <td class="text-left"><?php echo $key + 1; ?></td>
                                                        <td class="text-left"><?php echo $row['nama_pelayanan']; ?></td>
                                                        <td class="text-left"><?php echo $row['nama']; ?></td>
                                                        <td class="text-left"><?php echo $row['nik']; ?></td>
                                                        <td class="text-left"><?php echo $row['kk']; ?></td>
                                                        <td class="text-left"><?php echo $row['alamat']; ?></td>
                                                        <td class="text-left"><?php echo $row['no_telephone']; ?></td>
                                                        <td class="text-left"><?php echo $row['email']; ?></td>
                                                        <td class="text-left"><?php echo $row['kedatangan']; ?></td>
                                                        <td class="text-left"><?php echo $row['status']; ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="<?php echo base_url('data_administrasi/edit/' . $row['id']); ?>" class="btn btn-sm btn-secondary">
                                                                    edit
                                                                </a>
                                                                <?php if (session()->get('level') == 1) { ?>
                                                                <a href="<?php echo base_url('data_administrasi/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger delete-btn">
                                                                    hapus
                                                                </a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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