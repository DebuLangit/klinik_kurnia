<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Klinik_model');
        $this->load->library('form_validation');
    }

    public function index() {
        if($this->session->userdata('id_pasien')) redirect('pasien');

        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('auth/login');
            $this->load->view('layout/footer');
        } else {
            $pasien = $this->Klinik_model->get_pasien($this->input->post('no_hp'));
            if($pasien && password_verify($this->input->post('password'), $pasien['password'])) {
                $this->session->set_userdata([
                    'id_pasien' => $pasien['id'],
                    'nama_pasien' => $pasien['nama']
                ]);
                redirect('pasien');
            } else {
                $this->session->set_flashdata('error', 'Nomor HP atau Password salah!');
                redirect('auth');
            }
        }
    }

    public function register() {
        // Menambahkan Custom Error Message Bahasa Indonesia
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[pasien.nik]|exact_length[16]', [
            'required' => '%s wajib diisi!',
            'is_unique' => '%s ini sudah terdaftar!',
            'exact_length' => '%s harus tepat 16 digit!'
        ]);
        $this->form_validation->set_rules('nama_pasien', 'Nama Lengkap', 'required|trim', [
            'required' => '%s wajib diisi!'
        ]);
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|is_unique[pasien.no_hp]', [
            'required' => '%s wajib diisi!',
            'is_unique' => '%s ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', [
            'required' => '%s wajib diisi!',
            'min_length' => '%s minimal 4 karakter!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => '%s wajib diisi!'
        ]);

        if($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('auth/register');
            $this->load->view('layout/footer');
        } else {
            $data = [
                'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama_pasien'), 
                'no_hp' => $this->input->post('no_hp'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'alamat' => $this->input->post('alamat')
            ];
            $this->Klinik_model->register_pasien($data);
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}