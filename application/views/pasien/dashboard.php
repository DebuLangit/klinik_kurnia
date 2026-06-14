<h2 class='mb-4'>Dashboard Pasien</h2>

<div class='row g-4 mb-4'>
    <div class='col-md-3'><div class='card stat-card'><i class='bi bi-calendar-check text-primary fs-3'></i><h5 class="mt-2">Kunjungan</h5></div></div>
    <div class='col-md-3'><div class='card stat-card'><i class='bi bi-ticket-perforated text-info fs-3'></i><h5 class="mt-2">Antrean</h5></div></div>
    <div class='col-md-3'><div class='card stat-card'><i class='bi bi-file-medical text-success fs-3'></i><h5 class="mt-2">Riwayat</h5></div></div>
    <div class='col-md-3'><div class='card stat-card'><i class='bi bi-person text-warning fs-3'></i><h5 class="mt-2">Profil</h5></div></div>
</div>

<div class='card p-4 mb-4'>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="m-0 fw-bold">Tiket Kunjungan Saya</h4>
        <a href="<?= base_url('pasien/pendaftaran_baru') ?>" class="btn btn-primary btn-sm" style="border-radius: 10px;">
            <i class="bi bi-plus-circle me-1"></i> Daftar Baru
        </a>
    </div>
    
    <?php if(!empty($data_tiket)): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Tanggal & Antrean</th>
                        <th>Tujuan Poli</th>
                        <th>Dokter</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_tiket as $t): ?>
                    <tr>
                        <td>
                            <span class="badge bg-primary" style="letter-spacing: 1px; font-size: 0.9rem;">
                                <?= $t['kode_booking'] ?>
                            </span>
                        </td>
                        <td>
                            <strong><?= date('d M Y', strtotime($t['tgl_daftar'])) ?></strong><br>
                            <small class="text-muted"><i class="bi bi-clock"></i> <?= $t['jadwal'] ?></small><br>
                            <span class="badge bg-secondary mt-1">Antrean: <?= $t['no_antrian'] ?></span>
                        </td>
                        <td>
                            <span class="fw-semibold"><?= $t['nama_poli'] ?></span><br>
                            <small class="text-muted"><?= $t['metode_bayar'] ?></small>
                        </td>
                        <td><?= $t['nama_dokter'] ?></td>
                        <td>
                            <a href="<?= base_url('pasien/detail_tiket/'.$t['kode_booking']) ?>" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                                <i class="bi bi-eye"></i> Lihat Tiket
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-light text-center border mt-2" role="alert" style="border-radius: 15px;">
            <i class="bi bi-info-circle text-muted mb-2 d-block" style="font-size: 2rem;"></i>
            <span class="text-muted">Anda belum memiliki tiket kunjungan aktif. Silakan lakukan pendaftaran.</span>
        </div>
    <?php endif; ?>
</div>

<div class='card p-4'>
    <h4 class="fw-bold mb-3">Riwayat Kunjungan Selesai</h4>
    <?php if(!empty($riwayat_selesai)): ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Booking</th>
                        <th>Poli & Dokter</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($riwayat_selesai as $r): ?>
                    <tr>
                        <td>
                            <strong><?= date('d M Y', strtotime($r['tgl_daftar'])) ?></strong><br>
                            <small class="text-muted"><?= $r['jadwal'] ?></small>
                        </td>
                        <td><span class="badge bg-secondary text-light"><?= $r['kode_booking'] ?></span></td>
                        <td>
                            <span class="fw-semibold"><?= $r['nama_poli'] ?></span><br>
                            <small class="text-muted"><?= $r['nama_dokter'] ?></small>
                        </td>
                        <td><?= $r['keluhan'] ?></td>
                        <td><span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted mt-2">Belum ada riwayat kunjungan.</p>
    <?php endif; ?>
</div>