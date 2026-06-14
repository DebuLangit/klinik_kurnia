<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik_model extends CI_Model {
    
    // ==========================================
    // BAGIAN AUTENTIKASI & PASIEN
    // ==========================================

    public function get_pasien($no_hp) {
        return $this->db->get_where('pasien', ['no_hp' => $no_hp])->row_array();
    }

    public function register_pasien($data) {
        return $this->db->insert('pasien', $data);
    }


    // ==========================================
    // BAGIAN PENDAFTARAN & JADWAL
    // ==========================================

    // Mengambil data dokter beserta jadwal dan nama poli
    public function get_jadwal_lengkap() {
        $this->db->select('dokter.*, poli.nama_poli');
        $this->db->from('dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli');
        return $this->db->get()->result_array();
    }

    // Fungsi otomatis membuat nomor antrean per hari & per dokter
    public function get_no_antrian($id_dokter, $tgl_daftar) {
        $this->db->where('id_dokter', $id_dokter);
        $this->db->where('tgl_daftar', $tgl_daftar);
        $jumlah_antrean = $this->db->count_all_results('pendaftaran');
        
        return $jumlah_antrean + 1; // Antrean bertambah 1 dari total hari itu
    }

    public function simpan_pendaftaran($data) {
        $this->db->insert('pendaftaran', $data);
        return $this->db->insert_id();
    }


    // ==========================================
    // BAGIAN RIWAYAT & TIKET PASIEN
    // ==========================================

    public function get_riwayat_pasien($id_pasien) {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.jadwal, poli.nama_poli');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'dokter.id = pendaftaran.id_dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli');
        $this->db->where('pendaftaran.id_pasien', $id_pasien);
        $this->db->order_by('pendaftaran.waktu_daftar', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_tiket($id_pendaftaran) {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.jadwal, poli.nama_poli, pasien.nama, pasien.nik');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'dokter.id = pendaftaran.id_dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli');
        $this->db->join('pasien', 'pasien.id = pendaftaran.id_pasien');
        $this->db->where('pendaftaran.id', $id_pendaftaran);
        return $this->db->get()->row_array();
    }

    public function get_tiket_by_kode($kode_booking) {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.jadwal, poli.nama_poli, pasien.nama, pasien.nik');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'dokter.id = pendaftaran.id_dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli');
        $this->db->join('pasien', 'pasien.id = pendaftaran.id_pasien');
        $this->db->where('pendaftaran.kode_booking', $kode_booking);
        return $this->db->get()->row_array();
    }


    // --- FITUR ADMIN & DASHBOARD ---

    public function get_admin($username) {
        return $this->db->get_where('admin', ['username' => $username])->row_array();
    }

    // Fungsi untuk menghitung total data (Ringkasan Dashboard)
    public function hitung_total($table) {
        return $this->db->count_all($table);
    }

    // --- CRUD DOKTER (Dengan Relasi JOIN & Fitur Pencarian) ---
    
    public function get_semua_dokter($keyword = null) {
        $this->db->select('dokter.*, poli.nama_poli');
        $this->db->from('dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli'); // Relasi antar tabel
        
        // Fitur Pencarian Data
        if ($keyword) {
            $this->db->like('dokter.nama_dokter', $keyword);
            $this->db->or_like('poli.nama_poli', $keyword);
        }
        
        return $this->db->get()->result_array();
    }

    public function insert_dokter($data) {
        return $this->db->insert('dokter', $data);
    }

    public function delete_dokter($id) {
        $this->db->where('id', $id);
        return $this->db->delete('dokter');
    }

    // Menampilkan seluruh tiket pasien yang statusnya 'Menunggu'
    public function get_semua_antrean_aktif() {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, dokter.jadwal, poli.nama_poli, pasien.nama');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'dokter.id = pendaftaran.id_dokter');
        $this->db->join('poli', 'poli.id = dokter.id_poli');
        $this->db->join('pasien', 'pasien.id = pendaftaran.id_pasien');
        $this->db->where('pendaftaran.status', 'Menunggu');
        $this->db->order_by('pendaftaran.tgl_daftar', 'ASC');
        $this->db->order_by('pendaftaran.no_antrian', 'ASC');
        return $this->db->get()->result_array();
    }

    // Mengubah status tiket (Menunggu -> Selesai / Batal)
    public function update_status_tiket($id_pendaftaran, $status) {
        $this->db->where('id', $id_pendaftaran);
        return $this->db->update('pendaftaran', ['status' => $status]);
    }
}