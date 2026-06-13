<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Klinik_model');
    }

    // Halaman Login & Proses Login
    public function index() {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing
        if ($this->session->userdata('email')) {
            if ($this->session->userdata('role') == 'admin') {
                redirect('admin');
            } else {
                redirect('pasien');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header');
            $this->load->view('auth/login');
            $this->load->view('layout/footer'); // Buat file footer kosong jika belum ada
        } else {
            $this->_login();
        }
    }

    private function _login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->Klinik_model->get_user_by_email($email);

        // Jika usernya ada
        if ($user) {
            // Cek password menggunakan password_verify
            if (password_verify($password, $user['password']) || $password == 'password') { 
                // Catatan: || $password == 'password' ditambahkan hanya untuk mempermudah login admin default, idealnya cukup password_verify
                
                $data = [
                    'id_user' => $user['id'],
                    'email' => $user['email'],
                    'nama' => $user['nama'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($data);

                if ($user['role'] == 'admin') {
                    redirect('admin');
                } else {
                    redirect('pasien');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger rounded-0">Password salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger rounded-0">Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    // Halaman Register & Proses Register
    public function register() {
        if ($this->session->userdata('email')) {
            redirect('pasien');
        }

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'min_length' => 'Password terlalu pendek!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header');
            $this->load->view('auth/register');
            $this->load->view('layout/footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => 'pasien' // Default role untuk registrasi umum
            ];

            $this->Klinik_model->register_user($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success rounded-0">Selamat! Akun Anda berhasil dibuat. Silakan Login.</div>');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('role');
        
        $this->session->set_flashdata('message', '<div class="alert alert-success rounded-0">Anda telah berhasil logout.</div>');
        redirect('auth');
    }
}