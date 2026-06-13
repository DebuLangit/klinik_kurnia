<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-5 text-center">
                <h2 class="mb-4">TIKET SESI KLINIK</h2>
                <hr style="border-color: #555;">
                <div class="text-start mt-4">
                    <p><strong>Nama Pemilik:</strong> <?= $tiket['nama_pemilik'] ?></p>
                    <p><strong>Nama Kucing:</strong> <?= $tiket['nama_kucing'] ?></p>
                    <p><strong>Dokter Hewan:</strong> <?= $tiket['nama_dokter'] ?></p>
                    <p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($tiket['tanggal_jadwal'])) ?></p>
                    <p><strong>Waktu:</strong> <?= $tiket['waktu_sesi'] ?> WIB</p>
                    <p><strong>Keluhan:</strong> <?= $tiket['keluhan'] ?></p>
                </div>
                <hr style="border-color: #555;">
                <p class="text-muted small mt-3">Tunjukkan tiket ini kepada resepsionis saat tiba di klinik.</p>
                <a href="<?= base_url('pasien') ?>" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>