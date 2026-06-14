<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Kurnia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root{--primary:#0D6EFD;--secondary:#4FC3F7;--accent:#FF9800;--light:#F8FAFC;}
        body{background:#f8fafc;font-family:Segoe UI,sans-serif}
        .navbar{background:#fff!important;box-shadow:0 2px 20px rgba(0,0,0,.08)}
        .navbar-brand{font-weight:700;color:var(--primary)!important}
        .card{border:none;border-radius:20px;box-shadow:0 10px 25px rgba(13,110,253,.08)}
        .btn-primary{background:var(--primary);border:none;border-radius:12px}
        .hero{background:linear-gradient(135deg,#e8f1ff,#fff4e5);padding:70px;border-radius:30px}
        .stat-card{padding:20px}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <i class="bi bi-hospital"></i> Klinik Kurnia
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                
                <?php if($this->session->userdata('id_admin')): ?>
                    <li class="nav-item me-3 mb-2 mb-lg-0">
                        <a href="<?= base_url('admin') ?>" class="nav-link text-dark fw-semibold">Dashboard Admin</a>
                    </li>
                    <li class="nav-item me-3 mb-2 mb-lg-0 d-flex align-items-center">
                        <span class="text-primary fw-bold">
                            <i class="bi bi-person-badge-fill me-1"></i> <?= $this->session->userdata('nama_admin') ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/logout') ?>" class="btn btn-outline-danger btn-sm" style="border-radius: 10px; font-weight: 600;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>

                <?php elseif($this->session->userdata('id_pasien')): ?>
                    <li class="nav-item me-3 mb-2 mb-lg-0">
                        <a href="<?= base_url('pasien') ?>" class="nav-link text-dark fw-semibold">Dashboard</a>
                    </li>

                    <li class="nav-item me-4 mb-2 mb-lg-0">
                        <a href="<?= base_url('pasien/pendaftaran_baru') ?>" class="btn btn-primary btn-sm" style="border-radius: 10px; font-weight: 600;">
                            <i class="bi bi-calendar-plus me-1"></i> Pendaftaran
                        </a>
                    </li>
                    
                    <li class="nav-item me-3 mb-2 mb-lg-0 d-flex align-items-center">
                        <span class="text-secondary fw-bold">
                            <i class="bi bi-person-circle me-1"></i> Halo, <?= $this->session->userdata('nama_pasien') ?>
                        </span>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm" style="border-radius: 10px; font-weight: 600;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                
                <?php else: ?>
                    <li class="nav-item me-2 mb-2 mb-lg-0">
                        <a href="<?= base_url('auth') ?>" class="btn btn-outline-primary btn-sm" style="border-radius: 10px; font-weight: 600;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-sm" style="border-radius: 10px; font-weight: 600;">Daftar</a>
                    </li>
                <?php endif; ?>
                
            </ul>
        </div>
    </div>
</nav>

<div class="container">