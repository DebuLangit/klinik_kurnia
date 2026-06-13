<div class="row justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="col-md-5">
        
        <div class="card shadow-none">
            <div class="card-body p-5">
                <h3 class="text-uppercase text-center mb-4 pb-3 border-bottom" style="border-color: #333 !important;">Daftar Akun Baru</h3>
                
                <form action="<?= base_url('auth/register') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label text-uppercase small text-muted">Nama Lengkap Pemilik</label>
                        <input type="text" name="nama" class="form-control" value="<?= set_value('nama'); ?>" required autofocus>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-uppercase small text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" required>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-uppercase small text-muted">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 text-uppercase py-2 fw-bold">Buat Akun</button>
                </form>
                
                <div class="text-center mt-4 pt-3 border-top" style="border-color: #333 !important;">
                    <span class="text-muted small">Sudah memiliki akun?</span> 
                    <a href="<?= base_url('auth') ?>" class="text-decoration-none text-light fw-bold small">Login di sini</a>
                </div>
            </div>
        </div>
        
    </div>
</div>