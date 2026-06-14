<div class="row justify-content-center align-items-center" style="min-height:75vh">
    <div class="col-md-5">
        <div class="card p-5 border-0 shadow-sm" style="border-radius: 20px;">
            <h3 class="text-uppercase mb-4 border-bottom pb-2" style="border-color: #eee !important; color: var(--primary);">Admin Login</h3>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger border-0 small" style="border-radius: 10px;">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/login') ?>" method="post">
                <input type="text" name="username" class="form-control mb-3" style="border-radius: 10px;" placeholder="Username" required>
                <input type="password" name="password" class="form-control mb-4" style="border-radius: 10px;" placeholder="Password" required>
                <button class="btn btn-primary w-100 fw-bold" style="border-radius: 10px; padding: 10px;">MASUK SISTEM</button>
            </form>
        </div>
    </div>
</div>