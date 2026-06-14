<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card p-0 text-center border-0 shadow" style="border-radius: 15px; overflow: hidden;">
            <div class="bg-primary text-white p-3">
                <h4 class="mb-0 fw-bold"><i class="bi bi-ticket-detailed me-2"></i>E-TIKET KLINIK KURNIA</h4>
            </div>
            <div class="p-5 bg-white">
                <p class="text-muted small mb-1 fw-bold text-uppercase">Kode Booking</p>
                <h1 class="display-4 fw-bold mb-3" style="letter-spacing: 3px; color: var(--primary);">
                    <?= $tiket['kode_booking'] ?>
                </h1>
                
                <div class="mb-4">
                    <span class="badge bg-success fs-5 px-4 py-2 rounded-pill shadow-sm">
                        No. Antrean: <?= $tiket['no_antrian'] ?>
                    </span>
                </div>
                
                <div class="row text-start border-top pt-4" style="border-color: #eee !important;">
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Nama Pasien</small>
                        <strong class="fs-6"><?= $tiket['nama'] ?></strong>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Tanggal</small>
                        <strong class="fs-6"><?= date('d M Y', strtotime($tiket['tgl_daftar'])) ?></strong>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Jadwal Dokter</small>
                        <strong class="fs-6"><?= $tiket['jadwal'] ?></strong>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.75rem;">Metode Bayar</small>
                        <strong class="fs-6"><?= $tiket['metode_bayar'] ?></strong>
                    </div>
                    <div class="col-12 mt-2 bg-light p-3 rounded border">
                        <small class="text-muted d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Tujuan Poli & Dokter</small>
                        <strong class="fs-5 text-primary d-block"><?= $tiket['nama_poli'] ?></strong>
                        <span class="fw-semibold text-dark"><?= $tiket['nama_dokter'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4 mb-5 d-print-none">
            <button onclick="window.print()" class="btn btn-outline-primary me-2 fw-bold" style="border-radius: 10px;">
                <i class="bi bi-printer me-1"></i> CETAK PDF
            </button>
            <a href="<?= base_url('pasien') ?>" class="btn btn-primary fw-bold" style="border-radius: 10px;">
                KEMBALI KE DASHBOARD
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    body {
        background-color: #fff !important;
    }
    .navbar, .d-print-none {
        display: none !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
}
</style>