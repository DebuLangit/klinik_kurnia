<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        // Query untuk mengambil nama dokter, foto, jadwal, dan nama poli
        $this->db->select('dokter.nama_dokter, dokter.foto_dokter, dokter.jadwal, poli.nama_poli');
        $this->db->from('dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli'); // Disesuaikan: poli.id
        
        $data['data_dokter'] = $this->db->get()->result_array();

        $this->load->view('layout/header');
        $this->load->view('home/landing', $data);
        $this->load->view('layout/footer');
    }
    
}