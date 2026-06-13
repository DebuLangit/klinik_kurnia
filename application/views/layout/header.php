<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Cat Friends</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menggunakan tema dominan hitam yang bersih dan profesional */
        body { background-color: #000000; color: #e0e0e0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        .navbar { background-color: #0a0a0a !important; border-bottom: 1px solid #333; }
        .card { background-color: #121212; border: 1px solid #333; border-radius: 0; } /* Menghilangkan radius untuk tampilan tegas */
        .form-control, .form-select { background-color: #0a0a0a; color: #fff; border: 1px solid #444; border-radius: 0; }
        .form-control:focus, .form-select:focus { background-color: #1a1a1a; color: #fff; border-color: #666; box-shadow: none; }
        .btn-primary { background-color: #222; border-color: #444; border-radius: 0; color: #fff; }
        .btn-primary:hover { background-color: #444; border-color: #666; color: #fff; }
        .table { color: #e0e0e0; }
        .table-dark { background-color: #121212; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand text-uppercase" style="letter-spacing: 1px;" href="#">Klinik Cat Friends</a>
        <div class="d-flex">
            <?php if($this->session->userdata('email')): ?>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm rounded-0">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">