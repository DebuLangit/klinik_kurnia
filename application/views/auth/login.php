<div class="row justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="col-md-5">
        
        <?php if($this->session->flashdata('message')): ?>
            <?= $this->session->flashdata('message') ?>
        <?php endif; ?>
        
        <div class="card shadow-none">
            <div class="card-body p-5">
                <h3 class="text-uppercase text-center mb-4 pb-3 border-bottom" style="border-color: #333 !important;">Login Sistem</h3>
                
                <form action="<?= base_url('auth') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label text-uppercase small text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= set_value('email'); ?>" required autofocus>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-uppercase small text-muted">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 text-uppercase py-2 fw-bold">Masuk</button>
                </form>
                
                <div class="text-center mt-4 pt-3 border-top" style="border-color: #333 !important;">
                    <span class="text-muted small">Belum mendaftarkan diri?</span> 
                    <a href="<?= base_url('auth/register') ?>" class="text-decoration-none text-light fw-bold small">Daftar Sekarang</a>
                </div>
            </div>
        </div>
        
    </div>
</div>