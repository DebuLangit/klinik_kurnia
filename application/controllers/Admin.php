<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Klinik_model');
        $this->load->library('form_validation');
    }

    public function setup_admin() {
    // 1. Memerintahkan PHP membuat hash yang 100% valid untuk kata 'admin123'
    $password_asli = password_hash('admin123', PASSWORD_DEFAULT);
    
    // 2. Menimpa password dummy di database dengan hash yang baru menggunakan Query Builder
    $this->db->where('username', 'admin');
    $this->db->update('admin', ['password' => $password_asli]);
    
    // 3. Menampilkan konfirmasi
    echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
    echo "<h3>Setup Hash Berhasil!</h3>";
    echo "<p>Password admin telah diperbarui secara otomatis.</p>";
    echo "<a href='".base_url('admin/login')."' style='padding: 10px 20px; background: #0D6EFD; color: #fff; text-decoration: none; border-radius: 5px;'>Kembali Login</a>";
    echo "</div>";

    // --- AUTENTIKASI ---
    public function login() {
        if($this->session->userdata('id_admin')) redirect('admin');

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header');
            $this->load->view('admin/login');
            $this->load->view('layout/footer');
        } else {
            $admin = $this->Klinik_model->get_admin($this->input->post('username'));
            // Cek hash password sesuai ketentuan
            if($admin && password_verify($this->input->post('password'), $admin['password'])) {
                $this->session->set_userdata([
                    'id_admin' => $admin['id'],
                    'nama_admin' => $admin['nama_admin']
                ]);
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect('admin/login');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('nama_admin');
        redirect('admin/login');
    }

    // --- DASHBOARD & READ DATA ---
    public function index() {
        if(!$this->session->userdata('id_admin')) redirect('admin/login');

        // Ringkasan data (Tetap ada)
        $data['total_pasien'] = $this->Klinik_model->hitung_total('pasien');
        $data['total_dokter'] = $this->Klinik_model->hitung_total('dokter');
        $data['total_poli'] = $this->Klinik_model->hitung_total('poli');
        $data['total_pendaftaran'] = $this->Klinik_model->hitung_total('pendaftaran');
        $data['antrean'] = $this->Klinik_model->get_semua_antrean_aktif();

        // Ambil data untuk CRUD Dokter di halaman yang sama
        $keyword = $this->input->get('keyword'); // Menangkap input pencarian
        $data['dokter'] = $this->Klinik_model->get_semua_dokter($keyword);
        $data['poli'] = $this->db->get('poli')->result_array(); // Untuk dropdown pilihan poli

        $this->load->view('layout/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layout/footer');
    }

    // --- CREATE (Tambah Dokter) ---
    public function simpan_dokter() {
        if(!$this->session->userdata('id_admin')) redirect('admin/login');

        $data = [
            'nama_dokter' => $this->input->post('nama_dokter'),
            'id_poli' => $this->input->post('id_poli'),
            'jadwal' => $this->input->post('jadwal'),
            'foto_dokter' => 'default.jpg' // Default sementara
        ];
        $this->db->insert('dokter', $data);
        redirect('admin'); // Kembali ke dashboard
    }

    // --- UPDATE (Edit Dokter) ---
    public function update_dokter() {
        if(!$this->session->userdata('id_admin')) redirect('admin/login');

        $id = $this->input->post('id');
        $data = [
            'nama_dokter' => $this->input->post('nama_dokter'),
            'id_poli' => $this->input->post('id_poli'),
            'jadwal' => $this->input->post('jadwal')
        ];
        $this->db->where('id', $id);
        $this->db->update('dokter', $data);
        redirect('admin'); // Kembali ke dashboard
    }

    // --- DELETE (Hapus Dokter) ---
    public function hapus_dokter($id) {
        if(!$this->session->userdata('id_admin')) redirect('admin/login');
        
        $this->db->where('id', $id);
        $this->db->delete('dokter');
        redirect('admin'); // Kembali ke dashboard
    }

    // --- CRUD POLI ---
    public function simpan_poli() {
    $data = [
        'nama_poli' => $this->input->post('nama_poli'),
        'deskripsi' => $this->input->post('deskripsi')
    ];
    $this->db->insert('poli', $data);
    redirect('admin');
    }
    
    public function update_poli() {
    $data = [
        'nama_poli' => $this->input->post('nama_poli'),
        'deskripsi' => $this->input->post('deskripsi')
    ];
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('poli', $data);
    redirect('admin');
    }
    
    public function hapus_poli($id) {
    $this->db->where('id', $id);
    $this->db->delete('poli');
    redirect('admin');
    }
    
    // --- KONFIRMASI ANTREAN SELESAI ---
    public function konfirmasi_selesai($id_pendaftaran) {
    $this->Klinik_model->update_status_tiket($id_pendaftaran, 'Selesai');
    redirect('admin');
    }


}
