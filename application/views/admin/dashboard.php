<div class="mb-4 border-bottom pb-3" style="border-color: #eee !important;">
    <h2 class="text-uppercase fw-bold m-0">Control Panel Admin</h2>
</div>

<ul class="nav nav-pills mb-4 gap-2" id="adminTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active fw-bold px-4" style="border-radius: 10px;" id="dokter-tab" data-bs-toggle="tab" data-bs-target="#dokter" type="button" role="tab">Kelola Dokter</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold px-4" style="border-radius: 10px;" id="poli-tab" data-bs-toggle="tab" data-bs-target="#poli" type="button" role="tab">Kelola Poli</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold px-4" style="border-radius: 10px;" id="antrean-tab" data-bs-toggle="tab" data-bs-target="#antrean" type="button" role="tab">Antrean Pasien</button>
    </li>
</ul>

<div class='row g-4 mb-4'>
    <div class='col-md-3'>
        <div class='card p-4 text-start border-0 shadow-sm h-100' style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small text-muted mb-1 fw-bold">Total Pasien</p>
                    <h2 class="fw-bold mb-0"><?= $total_pasien ?></h2>
                </div>
                <i class="bi bi-people text-primary" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='card p-4 text-start border-0 shadow-sm h-100' style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small text-muted mb-1 fw-bold">Total Dokter</p>
                    <h2 class="fw-bold mb-0"><?= $total_dokter ?></h2>
                </div>
                <i class="bi bi-person-vcard text-info" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='card p-4 text-start border-0 shadow-sm h-100' style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small text-muted mb-1 fw-bold">Total Poli</p>
                    <h2 class="fw-bold mb-0"><?= $total_poli ?></h2>
                </div>
                <i class="bi bi-hospital text-success" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class='card p-4 text-start border-0 shadow-sm h-100' style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small text-muted mb-1 fw-bold">Pendaftaran Masuk</p>
                    <h2 class="fw-bold mb-0"><?= $total_pendaftaran ?></h2>
                </div>
                <i class="bi bi-file-earmark-medical text-warning" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
</div>

<div class="tab-content" id="adminTabContent">

    <div class="tab-pane fade show active" id="dokter" role="tabpanel">
        <div class="card p-4 border-0 shadow-sm mb-5" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" style="border-color: #eee !important;">
                <h4 class="fw-bold mb-0 text-uppercase">Manajemen Data Dokter</h4>
                <button class="btn btn-primary fw-bold" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Dokter
                </button>
            </div>

            <form action="<?= base_url('admin') ?>" method="get" class="mb-4">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" style="border-radius: 10px 0 0 10px;" placeholder="Cari nama dokter atau poli..." value="<?= $this->input->get('keyword') ?>">
                    <button class="btn btn-outline-primary fw-bold" type="submit">CARI</button>
                    <?php if($this->input->get('keyword')): ?>
                        <a href="<?= base_url('admin') ?>" class="btn btn-danger fw-bold" style="border-radius: 0 10px 10px 0;">RESET</a>
                    <?php else: ?>
                        <button class="btn btn-outline-primary" style="border-radius: 0 10px 10px 0; border-left: 0;" disabled></button>
                    <?php endif; ?>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Poliklinik</th>
                            <th>Jadwal Praktik</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($dokter)): ?>
                            <?php $no = 1; foreach($dokter as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold"><?= $d['nama_dokter'] ?></td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-2 py-1"><?= $d['nama_poli'] ?></span></td>
                                <td><?= $d['jadwal'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm fw-bold me-1 text-white" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $d['id'] ?>">EDIT</button>
                                    <a href="<?= base_url('admin/hapus_dokter/'.$d['id']) ?>" class="btn btn-danger btn-sm fw-bold" style="border-radius: 8px;" onclick="return confirm('Yakin ingin menghapus dokter ini?')">HAPUS</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit<?= $d['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0" style="border-radius: 15px;">
                                        <div class="modal-header border-bottom">
                                            <h5 class="modal-title text-uppercase fw-bold">Edit Data Dokter</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('admin/update_dokter') ?>" method="post">
                                            <div class="modal-body text-start">
                                                <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label small text-muted text-uppercase fw-bold">Nama Dokter</label>
                                                    <input type="text" name="nama_dokter" class="form-control" style="border-radius: 10px;" value="<?= $d['nama_dokter'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small text-muted text-uppercase fw-bold">Poliklinik</label>
                                                    <select name="id_poli" class="form-select" style="border-radius: 10px;" required>
                                                        <?php foreach($poli as $p): ?>
                                                            <option value="<?= $p['id'] ?>" <?= ($p['id'] == $d['id_poli']) ? 'selected' : '' ?>><?= $p['nama_poli'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small text-muted text-uppercase fw-bold">Jadwal Praktik</label>
                                                    <input type="text" name="jadwal" class="form-control" style="border-radius: 10px;" value="<?= $d['jadwal'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top">
                                                <button type="button" class="btn btn-outline-secondary fw-bold" style="border-radius: 10px;" data-bs-dismiss="modal">BATAL</button>
                                                <button type="submit" class="btn btn-primary fw-bold" style="border-radius: 10px;">SIMPAN PERUBAHAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">Data dokter tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="poli" role="tabpanel">
        <div class="card p-4 border-0 shadow-sm mb-5" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" style="border-color: #eee !important;">
                <h4 class="fw-bold mb-0 text-uppercase">Manajemen Data Poli</h4>
                <button class="btn btn-primary fw-bold" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#modalTambahPoli">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Poli
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Poliklinik</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($poli)): ?>
                            <?php $no = 1; foreach($poli as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold text-primary"><?= $p['nama_poli'] ?></td>
                                <td><?= empty($p['deskripsi']) ? '-' : $p['deskripsi'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm fw-bold me-1 text-white" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modalEditPoli<?= $p['id'] ?>">EDIT</button>
                                    <a href="<?= base_url('admin/hapus_poli/'.$p['id']) ?>" class="btn btn-danger btn-sm fw-bold" style="border-radius: 8px;" onclick="return confirm('Yakin ingin menghapus poli ini?')">HAPUS</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditPoli<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-0" style="border-radius: 15px;">
                                        <div class="modal-header border-bottom">
                                            <h5 class="modal-title text-uppercase fw-bold">Edit Data Poli</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('admin/update_poli') ?>" method="post">
                                            <div class="modal-body text-start">
                                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label small text-muted text-uppercase fw-bold">Nama Poli</label>
                                                    <input type="text" name="nama_poli" class="form-control" style="border-radius: 10px;" value="<?= $p['nama_poli'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small text-muted text-uppercase fw-bold">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3" style="border-radius: 10px;"><?= $p['deskripsi'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top">
                                                <button type="button" class="btn btn-outline-secondary fw-bold" style="border-radius: 10px;" data-bs-dismiss="modal">BATAL</button>
                                                <button type="submit" class="btn btn-primary fw-bold" style="border-radius: 10px;">SIMPAN PERUBAHAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">Data poli tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="antrean" role="tabpanel">
        <div class="card p-4 border-0 shadow-sm mb-5" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" style="border-color: #eee !important;">
                <h4 class="fw-bold mb-0 text-uppercase">Antrean Pasien Menunggu</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Booking</th>
                            <th>Pasien</th>
                            <th>Tanggal & Poli</th>
                            <th>Metode Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($antrean)): ?>
                            <?php foreach($antrean as $a): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-primary fs-6"><?= $a['kode_booking'] ?></span><br>
                                    <small class="text-muted fw-bold">Antrean: <?= $a['no_antrian'] ?></small>
                                </td>
                                <td><strong><?= $a['nama'] ?></strong></td>
                                <td>
                                    <?= date('d M Y', strtotime($a['tgl_daftar'])) ?><br>
                                    <small class="text-muted"><?= $a['nama_poli'] ?> - <?= $a['nama_dokter'] ?></small>
                                </td>
                                <td><?= $a['metode_bayar'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/konfirmasi_selesai/'.$a['id']) ?>" class="btn btn-success btn-sm fw-bold" style="border-radius: 8px;" onclick="return confirm('Tandai kunjungan ini sebagai selesai?')">
                                        <i class="bi bi-check-circle me-1"></i> SELESAI
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada pasien dalam antrean.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0" style="border-radius: 15px;">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-uppercase fw-bold">Tambah Dokter Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/simpan_dokter') ?>" method="post">
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Nama Dokter</label>
                        <input type="text" name="nama_dokter" class="form-control" style="border-radius: 10px;" placeholder="Contoh: dr. Budi Santoso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Poliklinik</label>
                        <select name="id_poli" class="form-select" style="border-radius: 10px;" required>
                            <option value="">-- Pilih Poliklinik --</option>
                            <?php foreach($poli as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= $p['nama_poli'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Jadwal Praktik</label>
                        <input type="text" name="jadwal" class="form-control" style="border-radius: 10px;" placeholder="Contoh: Senin - Rabu, 09:00 - 14:00" required>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary fw-bold" style="border-radius: 10px;" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="border-radius: 10px;">SIMPAN DATA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahPoli" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0" style="border-radius: 15px;">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-uppercase fw-bold">Tambah Poli Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/simpan_poli') ?>" method="post">
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Nama Poli</label>
                        <input type="text" name="nama_poli" class="form-control" style="border-radius: 10px;" placeholder="Contoh: Poli Gigi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" rows="3" style="border-radius: 10px;" placeholder="Contoh: Melayani cabut gigi dan scaling..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary fw-bold" style="border-radius: 10px;" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="border-radius: 10px;">SIMPAN POLI</button>
                </div>
            </form>
        </div>
    </div>
</div>