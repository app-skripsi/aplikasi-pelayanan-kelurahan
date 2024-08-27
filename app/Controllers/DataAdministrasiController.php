<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataAdministrasiModel;
use App\Models\DataWargaModel;
use App\Models\PelayananModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

class DataAdministrasiController extends BaseController
{

	protected $data_administrasi;
	protected $data_warga;
	protected $pelayanan;

	public function __construct()
	{
		helper(['form']);
		$this->data_administrasi = new DataAdministrasiModel();
		$this->pelayanan = new PelayananModel();
		$this->data_warga = new DataWargaModel();
	}

	public function index()
	{
		$data['data_administrasi'] = $this->data_administrasi->select('data_administrasi.*, pelayanan.pelayanan as nama_pelayanan')
			->join('pelayanan', 'pelayanan.id = data_administrasi.pelayanan_id')
			->findAll();
		return view('data_administrasi/index', $data);
	}
	public function cekNIK()
	{
		$nik = $this->request->getPost('nik');
		$isWargaJatiwarna = $this->data_warga->checkNIK($nik);
		return $this->response
			->setHeader('Content-Type', 'application/json')
			->setJSON($isWargaJatiwarna);
	}
	public function report()
	{
		return view('data_rekam_administrasi/index');
	}

	public function create()
	{
		$pelayanan = $this->pelayanan->findAll();
		$data = ['pelayanan' => $pelayanan];
		return view('data_administrasi/create', $data);
	}

	public function store()
	{
		$validation = \Config\Services::validation();
		$data = array(
			'nama' 			=> $this->request->getPost('nama'),
			'nik' 			=> $this->request->getPost('nik'),
			'kk' 			=> $this->request->getPost('kk'),
			'no_telephone'	=> $this->request->getPost('no_telephone'),
			'email'			=> $this->request->getPost('email'),
			'alamat' 		=> $this->request->getPost('alamat'),
			'kedatangan' 	=> $this->request->getPost('kedatangan'),
			'status' 		=> $this->request->getPost('status'),
			'pelayanan_id' 	=> $this->request->getPost('pelayanan_id'),
		);

		if ($validation->run($data, 'data_administrasi') == FALSE) {
			session()->setFlashdata('inputs', $this->request->getPost());
			session()->setFlashdata('errors', $validation->getErrors());
			return redirect()->to(base_url('data_administrasi/create'));
		} else {
			$simpan = $this->data_administrasi->insertData($data);
			if ($simpan) {
				session()->setFlashdata('success', 'Tambah Data Berhasil');
				return redirect()->to(base_url('data_administrasi'));
			}
		}
	}


	public function edit($id)
	{
		$pelayanan = $this->pelayanan->findAll();
		$data['pelayanan'] = ['' => 'Pilih pelayanan'] + array_column($pelayanan, 'pelayanan', 'id');
		$data['data_administrasi'] = $this->data_administrasi->find($id);
		return view('data_administrasi/edit', $data);
	}


	public function registrasiPelayanan()
	{
		$pelayanan = $this->pelayanan->findAll();
		$data = ['pelayanan' => $pelayanan];
		return view('register', $data);
	}

	// send email 
	// public function pendaftaran()
	// {
	// 	$validation = \Config\Services::validation();
	// 	$data = array(
	// 		'nama' 			=> $this->request->getPost('nama'),
	// 		'nik' 			=> $this->request->getPost('nik'),
	// 		'kk' 			=> $this->request->getPost('kk'),
	// 		'no_telephone'	=> $this->request->getPost('no_telephone'),
	// 		'email'			=> $this->request->getPost('email'),
	// 		'alamat' 		=> $this->request->getPost('alamat'),
	// 		'kedatangan' 	=> $this->request->getPost('kedatangan'),
	// 		'pelayanan_id' 	=> $this->request->getPost('pelayanan_id'),
	// 		'status' 		=> $this->request->getPost('status')
	// 	);

	// 	// Mengambil inputan email dari user
	// 	$recipientEmail = $this->request->getPost('email');
	// 	$nama = $this->request->getPost('nama');
	// 	$nik = $this->request->getPost('nik');
	// 	$tanggalDatang = $this->request->getPost('kedatangan');
	// 	$pelayananModel = new PelayananModel();
	// 	$pelayananData = $pelayananModel->find($data['pelayanan_id']);
	// 	$namaPelayanan = $pelayananData ? $pelayananData['pelayanan'] : 'Tidak diketahui';

	// 	$email = \Config\Services::email();
	// 	$email->setFrom('confrimappsjatiwarna@gmail.com', 'Email Notification - Siadminduk Jatiwarna');
	// 	$email->setCC('achya999@gmail.com');
	// 	$email->setTo($recipientEmail);
	// 	$email->setSubject('Konfirmasi Pendaftaran - Siadminduk Jatiwarna');

	// 	$message = "
	// 					 <p>Yth. Bapak/Ibu $nama,</p>
					 
	// 					 <p>Kami ingin menginformasikan bahwa pendaftaran Anda untuk pelayanan Administrasi Kependudukan (Adminduk) telah berhasil. Terima kasih telah mempercayakan pelayanan ini kepada kami.</p>
					 
	// 					 <p>Berikut adalah rincian data pendaftaran Anda:</p>
	// 					 <ul>
	// 						 <li><strong>Nama		:</strong> $nama</li>
	// 						 <li><strong>NIK		:</strong> $nik</li>
	// 						 <li><strong>Pelayanan 	:</strong> $namaPelayanan</li>
	// 						 <li><strong> Kedatangan:</strong> $tanggalDatang</li>
	// 					 </ul>
					 
	// 					 <p>Mohon diperhatikan bahwa Anda diwajibkan untuk hadir pada tanggal yang telah ditentukan di atas. Pastikan untuk membawa seluruh dokumen yang diperlukan untuk mempermudah proses pelayanan.</p>
					 
	// 					 <p>Jika Anda memerlukan bantuan lebih lanjut atau ada pertanyaan mengenai pendaftaran ini, jangan ragu untuk menghubungi kami melalui email ini atau melalui nomor telepon yang tersedia di website kami.</p>
					 
	// 					 <p>Semoga proses pelayanan Anda berjalan lancar. Kami menantikan kedatangan Anda.</p>
					 
	// 					 <p>Terima kasih atas kepercayaan Anda,</p>
	// 					 <p><strong>Tim Pelayanan Administrasi Kependudukan</strong></p>
	// 					 <p><strong>Kelurahan Jatiwarna</strong></p>
	// 				 ";


	// 	$email->setMessage($message);

	// 	if ($email->send()) {
	// 		return redirect()->to(base_url('/registrasi-pelayanan'));
	// 	} else {
	// 		echo $email->printDebugger(['headers']);
	// 		return "Failed to send email.";
	// 	}

	// 	if ($validation->run($data, 'data_administrasi') == FALSE) {
	// 		session()->setFlashdata('inputs', $this->request->getPost());
	// 		session()->setFlashdata('errors', $validation->getErrors());
	// 		return redirect()->to(base_url('/registrasi-pelayanan'));
	// 	} else {
	// 		$simpan = $this->data_administrasi->insertData($data);
	// 		if ($simpan) {
	// 			session()->setFlashdata('success', 'Update Data Berhasil');
	// 			// Sweet Alert success
	// 			session()->setFlashdata('alert', 'success');
	// 			session()->setFlashdata('success', 'Tambah Data Berhasil');
	// 			return redirect()->to(base_url('/registrasi-pelayanan'));
	// 		}
	// 	}
	// }

	public function update()
	{
		$id = $this->request->getPost('id');

		$validation = \Config\Services::validation();

		$data = array(
			'pelayanan_id' 	=> $this->request->getPost('pelayanan_id'),
			'nama' 			=> $this->request->getPost('nama'),
			'nik' 			=> $this->request->getPost('nik'),
			'kk' 			=> $this->request->getPost('kk'),
			'no_telephone'	=> $this->request->getPost('no_telephone'),
			'email'			=> $this->request->getPost('email'),
			'alamat' 		=> $this->request->getPost('alamat'),
			'kedatangan' 	=> $this->request->getPost('kedatangan'),
			'status' 		=> $this->request->getPost('status')
		);

		if ($validation->run($data, 'data_administrasi') == FALSE) {
			session()->setFlashdata('inputs', $this->request->getPost());
			session()->setFlashdata('errors', $validation->getErrors());
			return redirect()->to(base_url('data_administrasi/edit/' . $id));
		} else {
			$ubah = $this->data_administrasi->updateData($data, $id);
			if ($ubah) {
				session()->setFlashdata('success', 'Update Data Berhasil');
				return redirect()->to(base_url('data_administrasi'));
			}
		}
	}
	public function delete($id)
	{
		$hapus = $this->data_administrasi->deleteData($id);
		if ($hapus) {
			session()->setFlashdata('success', 'Delete Data Berhasil');
			// Sweet Alert success
			session()->setFlashdata('alert', 'success');
			session()->setFlashdata('delete_alert', 'success');
		} else {
			session()->setFlashdata('error', 'Gagal menghapus data');
			// Sweet Alert error
			session()->setFlashdata('alert', 'error');
			session()->setFlashdata('delete_alert', 'error');
		}
		return redirect()->to(base_url('data_administrasi'));
	}

	public function xls()
	{
		$exportXls = $this->data_administrasi->getAllAdministrasi();
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Laporan Data Administrasi Kelurahan Jatiwarna')
			->setCellValue('A2', 'Tanggal: ' . date('Y-m-d'))
			->setCellValue('B3', 'Nama Dokumen')
			->setCellValue('C3', 'NIK')
			->setCellValue('D3', 'KK')
			->setCellValue('E3', 'Alamat')
			->setCellValue('F3', 'Status')
			->setCellValue('G3', 'Email')
			->setCellValue('H3', 'No Telephone')
			->setCellValue('I3', 'Kedatangan')
			->setCellValue('J3', 'Pelayanan');


		// Merge cells for the title
		$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
		$spreadsheet->getActiveSheet()->mergeCells('A2:J2');
		// Center align the title
		$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		// Add yellow background and border to the title row
		$spreadsheet->getActiveSheet()->getStyle('A1:J2')->applyFromArray([
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startColor' => ['rgb' => 'FFFF00'], // Yellow background
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		]);

		// Set column widths
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20); // Width for cell A2
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);


		$spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		// Center align column headers
		$spreadsheet->getActiveSheet()->getStyle('B3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		$column = 4;
		$rowNumber = 1;

		foreach ($exportXls as $data_administrasis) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('B' . $column, $data_administrasis['nama'])
				->setCellValue('C' . $column, $data_administrasis['nik'])
				->setCellValue('D' . $column, $data_administrasis['kk'])
				->setCellValue('E' . $column, $data_administrasis['alamat'])
				->setCellValue('F' . $column, $data_administrasis['email'])
				->setCellValue('G' . $column, $data_administrasis['no_telephone'])
				->setCellValue('H' . $column, $data_administrasis['status'])
				->setCellValue('I' . $column, $data_administrasis['kedatangan'])
				->setCellValue('J' . $column, $data_administrasis['nama_pelayanan']);

			// Set auto numbering on the left side of the data
			$spreadsheet->getActiveSheet()->setCellValue('A' . $column, $rowNumber++);
			$spreadsheet->getActiveSheet()->getStyle('A' . $column . ':J' . $column)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$column++;
		}

		// Set border for data cells
		$highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
		$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
		$range = 'A3:' . $highestColumn . $highestRow;
		$spreadsheet->getActiveSheet()->getStyle($range)->applyFromArray([
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		]);
		$spreadsheet->getActiveSheet()->setCellValue('A3', 'No');
		$writer = new Xlsx($spreadsheet);
		$filename = date('Y-m-d-His') . '-Data-Administrasi';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function pdf()
	{
		// proteksi halaman
		$data = array(
			'data_administrasi' => $this->data_administrasi->getData(),
		);
		$html = view('data_administrasi/pdf', $data);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Yakub');
		$pdf->SetTitle('Laporan Data Administrasi Kelurahan Jatiwarna');
		$pdf->SetSubject('Laporan Data Administrasi');
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Laporan Administrasi Kelurahan Jatiwarna', ' Jalan Pasar Kecapi, Jatiwarna, Pondokmelati, RT.003/RW.001, Jatiwarna, Bekasi, Kota Bks, Jawa Barat 17415', PDF_HEADER_STRING);
		$pdf->SetY(50); // Ubah angka ini sesuai dengan posisi yang diinginkan
		$pdf->Line(10, $pdf->GetY(), $pdf->getPageWidth() - 10, $pdf->GetY());

		// set header and footer fonts
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->AddPage();
		// Set header
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 12));
		$pdf->SetFont('dejavusans', '', 10);

		// write html
		$pdf->writeHTML($html, true, false, true, false, '');
		$this->response->setContentType('application/pdf');
		// ouput pdf
		$pdf->Output('Data-Administrasi.pdf', 'I');
	}

	public function pendaftaran()
{
    $validation = \Config\Services::validation();
    $data = array(
        'nama'          => $this->request->getPost('nama'),
        'nik'           => $this->request->getPost('nik'),
        'kk'            => $this->request->getPost('kk'),
        'no_telephone'  => $this->request->getPost('no_telephone'),
        'email'         => $this->request->getPost('email'),
        'alamat'        => $this->request->getPost('alamat'),
        'kedatangan'    => $this->request->getPost('kedatangan'),
        'pelayanan_id'  => $this->request->getPost('pelayanan_id'),
        'status'        => $this->request->getPost('status')
    );

		// Mengambil inputan dari form
		$noTelephone = $this->request->getPost('no_telephone');
		$nama = $this->request->getPost('nama');
		$nik  = $this->request->getPost('nik');
		$kk   = $this->request->getPost('kk');
		$alamat = $this->request->getPost('alamat');
		$status = $this->request->getPost('status');
		$tanggalDatang = $this->request->getPost('kedatangan');

		$pelayananModel = new PelayananModel();
		$pelayananData = $pelayananModel->find($data['pelayanan_id']);
		$namaPelayanan = $pelayananData ? $pelayananData['pelayanan'] : 'Tidak diketahui';
		$defaultNoTelephone = '6285215897250';
		//$defaultNoTelephone = '6289669411581';

		// Mengirim pesan WhatsApp menggunakan Fonnte API
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.fonnte.com/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'target' => $noTelephone,
				'message' => "Hallo Pamor, warga Kelurahan Jatiwarna bernama $nama dengan alamat $alamat telah mendaftar untuk pelayanan $namaPelayanan. Silakan anda jemput bola untuk pengambilan berkas persyaratan ke alamat pemohon agar bisa segera diproses.\nTerimakasih.",
				'countryCode' => '62', // optional
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: 8j2cr16cogKVmT12C@xU'
			),
		));
		
		$response1 = curl_exec($curl);
		
		// Reset the options to send the second message
		curl_setopt($curl, CURLOPT_POSTFIELDS, array(
			'target' => $defaultNoTelephone,
			'message' => "Terimakasih anda telah mendaftar untuk pelayanan $namaPelayanan melalui aplikasi SIADMINDUK Kelurahan Jatiwarna. Harap tunggu, petugas PAMOR kami akan menjemput berkas ke rumah anda. Untuk proses selanjutnya, mohon berkas segera disiapkan.\nTerimakasih.",
			'countryCode' => '62', // optional
		));
		
		$response2 = curl_exec($curl);
		

    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
    }
    curl_close($curl);

    if (isset($error_msg)) {
        return "Gagal mengirim pesan WhatsApp: $error_msg";
    }
    echo $response1;
	echo $response2;

    // Validasi data
    if ($validation->run($data, 'data_administrasi') == FALSE) {
        session()->setFlashdata('inputs', $this->request->getPost());
        session()->setFlashdata('errors', $validation->getErrors());
        return redirect()->to(base_url('/registrasi-pelayanan'));
    } else {
        $simpan = $this->data_administrasi->insertData($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Update Data Berhasil');
            // Sweet Alert success
            session()->setFlashdata('alert', 'success');
            session()->setFlashdata('success', 'Tambah Data Berhasil');
            return redirect()->to(base_url('/registrasi-pelayanan'));
        }
    }
}

}
