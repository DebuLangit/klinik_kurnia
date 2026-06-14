<div class="hero mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <span class="badge bg-primary mb-3">Klinik Modern Keluarga</span>
            <h1 class="display-4 fw-bold">Pelayanan Kesehatan Cepat & Nyaman</h1>
            <p class="lead">Booking online, dokter profesional, dan pelayanan terbaik untuk keluarga Anda.</p>
            
            <a href="<?= base_url('auth') ?>" class="btn btn-outline-primary btn-lg ms-2">Login</a>
            <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-lg">Daftar Sekarang</a>
            
        </div>
        <div class="col-lg-6 text-center">
            <i class="bi bi-heart-pulse" style="font-size:180px;color:#0D6EFD"></i>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card p-4">
            <i class="bi bi-calendar-check fs-1 text-primary"></i>
            <h5>Booking Online</h5>
            <p>Daftar tanpa antre panjang.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <i class="bi bi-person-vcard fs-1 text-primary"></i>
            <h5>Dokter Profesional</h5>
            <p>Dokter berpengalaman.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4">
            <i class="bi bi-hospital fs-1 text-primary"></i>
            <h5>Fasilitas Modern</h5>
            <p>Pelayanan nyaman dan cepat.</p>
        </div>
    </div>
</div>

<h2 class='mb-3'>Dokter Kami</h2>
<div class="row g-4 mb-4">
    <?php if(!empty($data_dokter)): ?>
        <?php foreach($data_dokter as $d): ?>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 text-center shadow-sm border-0">
                <!-- Cek apakah dokter punya foto -->
                <?php if(!empty($d['foto_dokter'])): ?>
                    <img src="<?= base_url('assets/img/dokter/' . $d['foto_dokter']) ?>" class="card-img-top" alt="<?= $d['nama_dokter'] ?>" style="object-fit: cover; height: 300px;">
                <?php else: ?>
                    <!-- Jika tidak ada foto, tampilkan ikon default -->
                    <div class="bg-light d-flex justify-content-center align-items-center rounded-top" style="height: 200px;">
                        <i class="bi bi-person-fill text-secondary" style="font-size: 5rem;"></i>
                    </div>
                <?php endif; ?>
                
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-1"><?= $d['nama_dokter'] ?></h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary"><?= $d['nama_poli'] ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-light border text-center text-muted">
                Belum ada data dokter yang tersedia saat ini.
            </div>
        </div>
    <?php endif; ?>
</div>

<h2 class='mb-3'>Testimoni</h2>
<div class='card p-4 mb-4'>"Pelayanan cepat dan ramah." ⭐⭐⭐⭐⭐</div>

<h2 class='mb-3'>FAQ</h2>
<div class='card p-4'>Bagaimana cara daftar? → Buat akun lalu pilih jadwal.</div>