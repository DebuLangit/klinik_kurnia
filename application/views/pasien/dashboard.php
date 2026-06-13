<div class="row justify-content-center">
    <div class="col-md-8">
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger rounded-0"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-body p-4">
                <h4 class="card-title text-uppercase mb-4 border-bottom pb-2" style="border-color: #333 !important;">Pendaftaran Pasien Kucing</h4>
                <form action="<?= base_url('pasien/daftar') ?>" method="POST">
                    <div class="mb-3">
                        <label>Nama Kucing</label>
                        <input type="text" name="nama_kucing" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Keluhan / Gejala</label>
                        <textarea name="keluhan" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Pilih Dokter</label>
                            <select name="id_dokter" class="form-select" required>
                                <?php foreach($dokters as $d): ?>
                                    <option value="<?= $d['id'] ?>"><?= $d['nama_dokter'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Tanggal Jadwal</label>
                            <input type="date" name="tanggal_jadwal" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Waktu Sesi (09:00 - 17:00)</label>
                            <input type="time" name="waktu_sesi" class="form-control" min="09:00" max="17:00" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3 text-uppercase">Daftar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>