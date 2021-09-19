<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;


class AdminAuth extends Controller
{
    public function loginAuth()
    {
        $session = session();
        $adminModel = new AdminModel();

        $email = $this->request->getVar('email');
        $password = md5($this->request->getVar('password'));
        $data = $adminModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($data['password']) {
                $ses_data = [
                    'id' => $data['id_admin'],
                    'id_gor' => $data['id_gor'],
                    'name' => $data['nama_admin'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to(base_url('/goradm/dashboard'));
            } else {
                $session->setFlashdata('loginmsg', 'Password salah!');
                return redirect()->to(base_url('/goradm'));
            }
        } else {
            $session->setFlashdata('loginmsg', 'Akun tidak ada!');
            return redirect()->to(base_url('/goradm'));
        }
    }
    public function logout()
    {
        session_start();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        return redirect()->to(base_url('/goradm'));
    }
}
