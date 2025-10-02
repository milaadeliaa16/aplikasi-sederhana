<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 * Mengatur proses login & logout user.
 * 
 * @property CI_Input $input
 * @property CI_Session $session
 * @property User_model $User_model
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');           
        $this->load->library('session');          
        $this->load->helper(['url','form']);      
    }

    public function index() {
        // jika sudah login (session aktif) langsung ke transaksi
        if ($this->session->userdata('logged_in')) {
            redirect('transaksi');
        }
        // tampilkan form login
        $this->load->view('auth/login');
    }

    public function login() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        // validasi input
        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Masukkan username & password.');
            redirect('auth');
        }

        $user = $this->User_model->get_by_username($username);

        if (!$user) {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth');
        }

        // verifikasi password
        if (!function_exists('password_verify')) {
            $this->session->set_flashdata('error','Server tidak mendukung verifikasi password.');
            redirect('auth');
        }

        if (password_verify($password, $user->password)) {
            // hanya user dengan role admin yang bisa login
            if ($user->role === 'admin') {
                // simpan session
                $this->session->set_userdata([
                    'username'  => $user->username,
                    'role'      => $user->role,
                    'logged_in' => TRUE
                ]);
                redirect('transaksi');
            } else {
                // jika bukan admin → tolak login
                $this->session->set_flashdata('error', 'Hanya admin yang dapat mengakses sistem.');
                redirect('auth');
            }
        } else {
            // password salah
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->unset_userdata(['username','role','logged_in']);
        $this->session->sess_destroy();
        redirect('auth');
    }
}
