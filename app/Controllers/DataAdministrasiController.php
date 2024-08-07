<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataAdministrasiModel;
use App\Models\PelayananModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

class DataAdministrasiController extends BaseController
{

	protected $data_administrasi;
	protected $pelayanan;

	public function __construct()
	{
		helper(['form']);
		$this->data_administrasi = new DataAdministrasiModel();
		$this->pelayanan = new PelayananModel();
	}

	public function index()
	{
		$data['data_administrasi'] = $this->data_administrasi->select('data_administrasi.*, pelayanan.pelayanan as nama_pelayanan')
			->join('pelayanan', 'pelayanan.id = data_administrasi.pelayanan_id')
			->findAll();
		return view('data_administrasi/index', $data);
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

	public function pendaftaran()
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
			'pelayanan_id' 	=> $this->request->getPost('pelayanan_id'),
			'status' 		=> $this->request->getPost('status')
		);
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
}
