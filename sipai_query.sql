-- Tabel Data Jenis Pelayanan
CREATE TABLE data_pelayanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_layanan VARCHAR(255)
);

-- Tabel Data Aparatur
CREATE TABLE data_aparatur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    nip VARCHAR(255)
);

-- Tabel Data Administrasi
CREATE TABLE data_administrasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    nik VARCHAR(255),
    kk VARCHAR(255),
    alamat VARCHAR(255),
    kedatangan DATE,
    jenis_pelayanan_id INT,
    FOREIGN KEY (jenis_pelayanan_id) REFERENCES data_jenis_pelayanan(id)
);

-- Tabel Data Rekam Administrasi
CREATE TABLE data_rekam_administrasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_pelayanan_id INT,
    tanggal_record DATE,
    total_jumlah_layanan INT,
    FOREIGN KEY (jenis_pelayanan_id) REFERENCES data_jenis_pelayanan(id)
);


-- Insert data jenis pelayanan
INSERT INTO data_jenis_pelayanan (nama_layanan) VALUES
('Pembaharuan KK'),
('Surat Keterangan Pindah'),
('Perekaman KTP'),
('Pembuatan KIA'),
('Pembuatan Akte Lahir'),
('Pembuatan Akte Kematian');
