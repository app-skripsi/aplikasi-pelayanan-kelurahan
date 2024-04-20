<html>
<body>
    <div>
        <table cellspacing="3" cellpadding="4">
            <thead>
                <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Nama </th>
                    <th style="text-align: center">Nik</th>
                    <th style="text-align: center">KK</th>
                    <th style="text-align: center">Alamat</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Kedatangan</th>
                    <th style="text-align: center">Pelayanan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_administrasi as $key => $row) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo $key + 1; ?></td>
                        <td style="text-align: center"><?php echo $row['nama']; ?></td>
                        <td style="text-align: center"><?php echo $row['nik']; ?></td>
                        <td style="text-align: center"><?php echo $row['kk']; ?></td>
                        <td style="text-align: center"><?php echo $row['alamat']; ?></td>
                        <td style="text-align: center"><?php echo $row['status']; ?></td>
                        <td style="text-align: center"><?php echo $row['kedatangan']; ?></td>
                        <td style="text-align: center"><?php echo $row['pelayanan']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
