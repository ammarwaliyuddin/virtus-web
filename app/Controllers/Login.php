<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
	public function index()
	{
		helper(['form']);
		return view('Login');
	}

	public function auth()
	{
		$session = session();
		$model = new LoginModel();

		$NIK = $this->request->getVar('NIK');
		$password = $this->request->getVar('password');
		$data = $model->where('NIK', $NIK)->first();

		$db      = \Config\Database::connect();
		$builder = $db->table('master_data_personil');
		$builder->selectCount('NIK');
		$query = $builder->get()->getResultArray();


		// dd($data);
		if ($data) {
			$pass = $data['Password'];
			//	$verify_pass = password_verify($password, $pass);
			if ($password == $pass) {
				$ses_data = [
					'NIK'       => $data['NIK'],
					'Nama'     => $data['Nama'],
					'Status'    => $data['Status'],
					'jumlah' => $query,
					'logged_in'     => TRUE
				];
				// dd($ses_data);
				$session->set($ses_data);
				return redirect()->to('/Dashboard');
				// return view('Dashboard/d_1', $data);
			} else {
				$session->setFlashdata('msg', 'Password salah');
				return redirect()->to('/');
			}
		} else {
			$session->setFlashdata('msg', 'NIK tidak ditemukan');
			return redirect()->to('/');
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		// $this->session->sess_destroy();
		// dd($session);
		return redirect()->to('/');
	}
}
