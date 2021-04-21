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
		if ($data) {
			$pass = $data['Password'];
			//	$verify_pass = password_verify($password, $pass);
			if ($password == $pass) {
				$ses_data = [
					'NIK'       => $data['NIK'],
					'Nama'     => $data['Nama'],
					'Status'    => $data['Status'],
					'logged_in'     => TRUE
				];
				$session->set($ses_data);
				return redirect()->to('/Dashboard');
			} else {
				$session->setFlashdata('msg', 'Wrong Password');
				return redirect()->to('/Login');
			}
		} else {
			$session->setFlashdata('msg', 'NIK not Found');
			return redirect()->to('/Login');
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/Login');
	}
}
