<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Klinik_model');
        if($this->session->userdata('role') != 'pasien') {
            redirect('auth');
        }
    }

    public function index() {
        $data['dokters'] = $this->Klinik_model->get_dokters();
        $this->load->view('layout/header');
        $this->load->view('pasien/dashboard', $data);
        $this->load->view('layout/footer');
    }

    public function daftar() {
        // Validasi operasional jam 09:00 - 17:00
        $waktu_sesi = $this->input->post('waktu_sesi');
        if($waktu_sesi < '09:00' || $waktu_sesi > '17:00') {
            $this->session->set_flashdata('error', 'Klinik hanya beroperasi jam 09:00 - 17:00 WIB.');
            redirect('pasien');
        }

        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'nama_kucing' => $this->input->post('nama_kucing'),
            'keluhan' => $this->input->post('keluhan'),
            'id_dokter' => $this->input->post('id_dokter'),
            'tanggal_jadwal' => $this->input->post('tanggal_jadwal'),
            'waktu_sesi' => $waktu_sesi,
            'status' => 'menunggu'
        ];

        $insert_id = $this->Klinik_model->daftar_pasien($data);
        redirect('pasien/tiket/'.$insert_id);
    }

    public function tiket($id) {
        $data['tiket'] = $this->Klinik_model->get_tiket($id);
        $this->load->view('layout/header');
        $this->load->view('pasien/tiket', $data);
        $this->load->view('layout/footer');
    }
}