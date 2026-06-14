<div class='row align-items-center' style='min-height:75vh'>
    <div class='col-lg-5'>
        <div class='card p-5'>
            <h2>Registrasi Pasien</h2>
            <form action="<?= base_url('auth/register') ?>" method='post'>
                
                <input type='text' name='nik' class='form-control mt-2' placeholder='NIK (16 Digit)' value="<?= set_value('nik') ?>">
                <?= form_error('nik', '<small class="text-danger">', '</small>') ?>
                
                <input type='text' name='nama_pasien' class='form-control mt-2' placeholder='Nama Lengkap' value="<?= set_value('nama_pasien') ?>">
                <?= form_error('nama_pasien', '<small class="text-danger">', '</small>') ?>
                
                <input type='text' name='no_hp' class='form-control mt-2' placeholder='No HP' value="<?= set_value('no_hp') ?>">
                <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
                
                <textarea name='alamat' class='form-control mt-2' placeholder='Alamat Lengkap' rows='2'><?= set_value('alamat') ?></textarea>
                <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                
                <input type='password' name='password' class='form-control mt-2 mb-3' placeholder='Password (Min 4 Karakter)'>
                <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                
                <button class='btn btn-primary w-100 mt-2'>Daftar</button>
            </form>
        </div>
    </div>
    <div class='col-lg-6 text-center'>
        <i class='bi bi-heart-pulse-fill' style='font-size:180px;color:#FF9800'></i>
    </div>
</div>