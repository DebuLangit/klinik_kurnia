<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card p-5 border-0 shadow-sm" style="border-radius: 20px;">
            <h3 class="mb-4 text-uppercase border-bottom pb-2" style="border-color: #eee !important; color: var(--primary);">Form Pendaftaran</h3>
            
            <form action="<?= base_url('pasien/simpan_daftar') ?>" method="post">
                
                <label class="small text-muted text-uppercase fw-bold mb-1">Pilih Poli Tujuan</label>
                <select id="pilih_poli" class="form-select mb-2" style="border-radius: 10px;" onchange="filterDokter()">
                    <option value="">-- Pilih Poli --</option>
                    <?php foreach($poli as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nama_poli'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label class="small text-muted text-uppercase fw-bold mb-1 mt-2">Pilih Dokter & Jadwal</label>
                <select name="id_dokter" id="pilih_dokter" class="form-select" style="border-radius: 10px;" disabled>
                    <option value="">-- Silakan Pilih Poli Terlebih Dahulu --</option>
                </select>
                <?= form_error('id_dokter', '<small class="text-danger fw-bold">', '</small>') ?>

                <label class="small text-muted text-uppercase fw-bold mb-1 mt-3">Tanggal Kunjungan</label>
                <input type="date" name="tgl_daftar" class="form-control" style="border-radius: 10px;" value="<?= set_value('tgl_daftar') ?>">
                <?= form_error('tgl_daftar', '<small class="text-danger fw-bold">', '</small>') ?>

                <label class="small text-muted text-uppercase fw-bold mb-1 mt-3">Keluhan Utama</label>
                <textarea name="keluhan" class="form-control" rows="3" style="border-radius: 10px;"><?= set_value('keluhan') ?></textarea>
                <?= form_error('keluhan', '<small class="text-danger fw-bold">', '</small>') ?>

                <label class="small text-muted text-uppercase fw-bold mb-1 mt-3">Metode Pembayaran</label>
                <select name="metode_bayar" id="metode_bayar" class="form-select" style="border-radius: 10px;" onchange="cekBPJS()">
                    <option value="Umum" <?= set_select('metode_bayar', 'Umum') ?>>Umum (Biaya Mandiri)</option>
                    <option value="BPJS" <?= set_select('metode_bayar', 'BPJS') ?>>BPJS Kesehatan</option>
                    <option value="Asuransi" <?= set_select('metode_bayar', 'Asuransi') ?>>Asuransi Swasta</option>
                </select>
                <?= form_error('metode_bayar', '<small class="text-danger fw-bold">', '</small>') ?>

                <div id="form_bpjs" style="<?= set_value('metode_bayar') == 'BPJS' ? 'display: block;' : 'display: none;' ?> margin-top:15px;">
                    <label class="small text-muted text-uppercase fw-bold mb-1">Nomor Kartu BPJS</label>
                    <input type="text" name="no_bpjs" id="input_bpjs" class="form-control" style="border-radius: 10px;" placeholder="Masukkan 13 Digit Nomor BPJS" value="<?= set_value('no_bpjs') ?>">
                    <?= form_error('no_bpjs', '<small class="text-danger fw-bold">', '</small>') ?>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4 py-2 fw-bold" style="border-radius: 12px; font-size: 1.1rem;">
                    KONFIRMASI PENDAFTARAN
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const dataDokter = [
    <?php foreach($jadwal as $j): ?>
    {
        id: "<?= $j['id'] ?>",
        id_poli: "<?= $j['id_poli'] ?>",
        nama_dokter: "<?= $j['nama_dokter'] ?>",
        jadwal: "<?= $j['jadwal'] ?>"
    },
    <?php endforeach; ?>
];

function filterDokter() {
    var idPoli = document.getElementById("pilih_poli").value;
    var selectDokter = document.getElementById("pilih_dokter");
    
    selectDokter.innerHTML = '<option value="">-- Pilih Dokter --</option>';
    
    if (idPoli === "") {
        selectDokter.innerHTML = '<option value="">-- Silakan Pilih Poli Terlebih Dahulu --</option>';
        selectDokter.disabled = true;
        return;
    }
    
    selectDokter.disabled = false;
    
    var dokterTersedia = dataDokter.filter(function(d) {
        return d.id_poli === idPoli;
    });
    
    if (dokterTersedia.length > 0) {
        dokterTersedia.forEach(function(d) {
            var option = document.createElement("option");
            option.value = d.id;
            option.text = d.nama_dokter + " | Jadwal: " + d.jadwal;
            selectDokter.appendChild(option);
        });
    } else {
        selectDokter.innerHTML = '<option value="">-- Dokter Belum Tersedia di Poli Ini --</option>';
        selectDokter.disabled = true;
    }
}

function cekBPJS() {
    var metode = document.getElementById("metode_bayar").value;
    var formBpjs = document.getElementById("form_bpjs");
    
    if(metode === "BPJS") {
        formBpjs.style.display = "block";
    } else {
        formBpjs.style.display = "none";
        document.getElementById("input_bpjs").value = "";
    }
}
</script>