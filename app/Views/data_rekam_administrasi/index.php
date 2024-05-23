<?php echo view("_partials/head"); ?>

<body>
    <div class="wrapper">
        <?php echo view("_partials/navbar"); ?>
        <div class="main">
        <?php echo view("_partials/profile"); ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h1 class="h3">Data Rekam Administrasi</h1>
                        <div>
                        <?php if (session()->get('level') == 1) { ?>
                            <a class="btn btn-dark text-white" href="<?php echo base_url('/data_administrasi') ?>">Lihat Data</a>
                        <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                <p>Download Data Rekam Administrasi PDF</p>
                                <hr>
                                    <a href="<?php echo base_url("data_administrasi/pdf") ?>" type="button" class="btn btn-primary mt-3 float-left" style="margin-left: 10px;">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                <p>Download Data Rekam Administrasi xlsx</p>
                                <hr>
                                    <a href="<?php echo base_url("data_administrasi/xls") ?>" type="button" class="btn btn-primary mt-3 float-left" style="margin-left: 10px;"><em><em></em></em>
                                        <i class="fas fa-file-excel"></i> Download Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php echo view("_partials/footer"); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php echo view("_partials/script"); ?>

</body>

</html>