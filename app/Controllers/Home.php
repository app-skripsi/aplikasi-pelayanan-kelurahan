<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $dashboard_model;
    protected $login;

    public function __construct(){
        helper('form');
		$this->dashboard_model = new DashboardModel();
        $this->login = new UserModel();
	}	

    public function index(): string
    {
         $data['count_administrasi']  	    = $this->dashboard_model->getCountAdministrasi();
        $data['count_rekam_admin']         = $this->dashboard_model->getCountRekamAdministrasi();
        return view('index',  $data);
    }


    public function informasiPelayanan(): string {
        return view('informasi_pelayanan');
    }

    public function frontend(): string {
        return view('frontend');
    }

    public function login(): string {
        return view('login');
    }

    public function cek_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cek = $this->login->cek_login($username, $password);


        if ($cek !== null && ($cek['username'] == $username) && ($cek['password'] == $password)) {
            // pengecekan jika username dan password benar
            session()->set('nama_user', $cek['nama_user']);
            session()->set('username', $cek['username']);
            session()->set('level', $cek['level']);
            return redirect()->to(base_url('/index'));
        } else {
            // jika pengecekan salah 
            session()->setFlashData('gagal', 'Username atau password tidak benar');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout(): string  {
        session()->remove('nama_user');
        session()->remove('username');
        session()->remove('level');
        session()->setFlashData('sukses', 'Anda Berhasil Logout');
        return site_url('/login');
    }

}
