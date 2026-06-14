<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('id_pasien')) redirect('auth');
        $this->load->model('Klinik_model');
        $this->load->library('form_validation'); // Tambahkan library validasi
    }

    public function index() {
        if (!$this->session->userdata('id_pasien')) redirect('auth');

        $id_pasien = $this->session->userdata('id_pasien');

        $data['data_tiket'] = $this->db->query("
            SELECT p.*, d.jadwal, pl.nama_poli, d.nama_dokter 
            FROM pendaftaran p
            JOIN dokter d ON p.id_dokter = d.id
            JOIN poli pl ON d.id_poli = pl.id
            WHERE p.id_pasien = '$id_pasien' AND p.status = 'Menunggu'
            ORDER BY p.tgl_daftar ASC
        ")->result_array();

        $data['riwayat_selesai'] = $this->db->query("
            SELECT p.*, d.jadwal, pl.nama_poli, d.nama_dokter 
            FROM pendaftaran p
            JOIN dokter d ON p.id_dokter = d.id
            JOIN poli pl ON d.id_poli = pl.id
            WHERE p.id_pasien = '$id_pasien' AND p.status = 'Selesai'
            ORDER BY p.tgl_daftar DESC
        ")->result_array();

        $this->load->view('layout/header');
        $this->load->view('pasien/dashboard', $data); 
        $this->load->view('layout/footer');
    }

    public function pendaftaran_baru() {
        $data['poli'] = $this->db->get('poli')->result_array();
        $data['jadwal'] = $this->Klinik_model->get_jadwal_lengkap();
        $this->load->view('layout/header');
        $this->load->view('pasien/form_daftar', $data);
        $this->load->view('layout/footer');
    }

    public function simpan_daftar() {
        // --- ATURAN VALIDASI ---
        $this->form_validation->set_rules('id_dokter', 'Dokter', 'required', ['required' => 'Silakan pilih Poli dan %s terlebih dahulu!']);
        $this->form_validation->set_rules('tgl_daftar', 'Tanggal Kunjungan', 'required', ['required' => '%s wajib dipilih!']);
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required', ['required' => '%s wajib diisi!']);
        $this->form_validation->set_rules('metode_bayar', 'Metode Pembayaran', 'required');

        // Jika metode bayar adalah BPJS, maka nomor BPJS wajib diisi
        if ($this->input->post('metode_bayar') == 'BPJS') {
            $this->form_validation->set_rules('no_bpjs', 'Nomor BPJS', 'required|exact_length[13]', [
                'required' => '%s wajib diisi jika menggunakan BPJS!',
                'exact_length' => '%s harus berjumlah tepat 13 digit!'
            ]);
        }

        // --- PENGECEKAN VALIDASI ---
        if ($this->form_validation->run() == FALSE) {
            // Jika ada yang salah, kembalikan ke halaman form pendaftaran
            $this->pendaftaran_baru();
        } else {
            // Jika validasi lolos, proses simpan data
            $metode_bayar = $this->input->post('metode_bayar');
            $no_bpjs = ($metode_bayar == 'BPJS') ? $this->input->post('no_bpjs') : NULL;
            $kode_booking = strtoupper(substr(md5(time()), 0, 8));

            $id_dokter = $this->input->post('id_dokter');
            $tgl_daftar = $this->input->post('tgl_daftar');
            $no_antrian = $this->Klinik_model->get_no_antrian($id_dokter, $tgl_daftar);

            $data = [
                'kode_booking' => $kode_booking,
                'id_pasien' => $this->session->userdata('id_pasien'),
                'id_dokter' => $id_dokter,
                'tgl_daftar' => $tgl_daftar,
                'no_antrian' => $no_antrian,
                'keluhan' => $this->input->post('keluhan'),
                'metode_bayar' => $metode_bayar,
                'no_bpjs' => $no_bpjs,
                'status' => 'Menunggu'
            ];
            
            $id_daftar = $this->Klinik_model->simpan_pendaftaran($data);
            redirect('pasien/tiket/'.$id_daftar);
        }
    }

    public function tiket($id) {
        $data['tiket'] = $this->Klinik_model->get_tiket($id);
        $this->load->view('layout/header');
        $this->load->view('pasien/tiket', $data);
        $this->load->view('layout/footer');
    }

    public function detail_tiket($kode_booking) {
        if (!$this->session->userdata('id_pasien')) redirect('auth');

        $data['tiket'] = $this->Klinik_model->get_tiket_by_kode($kode_booking);

        if ($data['tiket']) {
            $this->load->view('layout/header');
            $this->load->view('pasien/tiket', $data);
            $this->load->view('layout/footer');
        } else {
            redirect('pasien');
        }
    }
}