<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->model('User_model');
    }
    public function index()
    {
        if ($this->Login_model->logged_id()) {
            redirect('Login/home');
        } else {
            $this->load->view('login');
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $passwordx = md5($password);
        $set = $this->Login_model->login($username, $passwordx);
        if ($set) {
            $log = [
                'id_user' => $set->id_user,
                'username' => $set->username,
                'id_user_level' => $set->id_user_level,
                'status' => 'Logged'
            ];
            $this->session->set_userdata($log);
            redirect('Login/home');
        } else {
            $this->session->set_flashdata('message', 'Username atau Password Salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function home()
    {
        $data['page'] = "Dashboard";
        $this->load->view('admin/index', $data);
    }

    public function lupa_password()
    {
        $this->load->view('lupa_password');
    }

    public function proses_lupa_password()
    {
        $email = $this->input->post('email');

        $user = $this->db->get_where('user', ['email' => $email])->row();

        if (!$user) {
            $this->session->set_flashdata('message', 'Email tidak terdaftar');
            redirect('Login/lupa_password');
        }

        $token = bin2hex(random_bytes(32));
        $expired = date('Y-m-d H:i:s', time() + 3600); // 1 jam

        $this->db->where('id_user', $user->id_user);
        $this->db->update('user', [
            'reset_token' => $token,
            'token_expired' => $expired
        ]);

        $link = base_url("Login/reset_password/$token");
        $this->_sendEmailReset($email, $link);

        $this->session->set_flashdata('message', 'Link reset password dikirim ke email');
        redirect('login');
    }

    private function _sendEmailReset($to, $link)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'spkmaut@gmail.com',
            'smtp_pass' => 'ywwgilsitannxnyy',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'crlf'      => "\r\n"
        ];

        $this->load->library('email');
        $this->email->initialize($config);
        // pakai config SMTP yang SUDAH KAMU BUKTIKAN BERHASIL
        $this->email->from('spkmaut@gmail.com', 'SPK MAUT');
        $this->email->to($to);
        $this->email->subject('Reset Password');
        $this->email->message("
        <h3>Reset Password</h3>
        <p>Klik link berikut:</p>
        <a href='$link'>$link</a>
        <p>Link berlaku 1 jam.</p>
    ");

        $this->email->send();
    }

    public function reset_password($token)
    {
        $user = $this->db->get_where('user', [
            'reset_token' => $token,
            'token_expired >=' => date('Y-m-d H:i:s')
        ])->row();

        if (!$user) {
            show_error('Token tidak valid / kadaluarsa');
        }

        $data['token'] = $token;
        $this->load->view('reset_password', $data);
    }

    public function update_password()
    {
        $token = $this->input->post('token');
        $password = md5($this->input->post('password')); // (sesuai sistemmu)

        $this->db->where('reset_token', $token);
        $this->db->update('user', [
            'password' => $password,
            'reset_token' => null,
            'token_expired' => null
        ]);

        $this->session->set_flashdata('message', 'Password berhasil direset');
        redirect('login');
    }
}

/* End of file Login.php */