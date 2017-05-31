<h1 class="title-bar"> FORM PENDAFTARAN </h1>
<div class="container">
    <div class="col-sm-3">
        <div class="standard-form">
            <div class="standard-form-body">
                <h3><center><b><i class="fa fa-question-circle"></i> NOTICE </b></center></h3>
                <p><b><?php echo $message; ?></b></p>
            </div>
        </div>
    </div>
    <div class="col-sm-8" style="margin-left: auto; margin-right: auto; background-color">
        <form method="POST" action="<?php echo base_url ('mahasiswa/edit_berkas') . '/' . $poster['id_poster']; ?>" enctype="multipart/form-data">
            <div class="standard-form">
                <div class="standard-form-header">
                    <h3>DATA TUGAS AKHIR</h3>
                </div>
                <div class="standard-form-body">
                    <input type="hidden" name="id_poster" value="<?php echo $poster['id_poster']; ?>">
                    <div class="form-group">
                        <label for="judul">Judul Tugas Akhir </label>
                        <input type="text" name="judul" class="form-control" placeholder="" value="<?php echo $poster['judul_publikasi']; ?>" required disabled>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Author </label>
                        <input type="text" name="nama" class="form-control" placeholder="" value="<?php echo $poster['nama_penulis']; ?>" required disabled>
                    </div>

                    <div class="form-group">
                        <label for="nama">NRP Author </label>
                        <input type="text" name="nrp" class="form-control" placeholder="" value="<?php echo $poster['nrp_penulis']; ?>" required disabled>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Publikasi </label>
                        <input type="text" name="tahun" class="form-control" placeholder="" value="<?php echo $poster['tahun_publikasi']; ?>" required disabled>
                    </div>

                    <div class="form-group">
                        <label for="rumpun">Rumpun Mata Kuliah </label>
                        <select name="rumpun" class="form-control" required disabled>
                            <option selected hidden value="none">Pilih RMK</option>
                            <?php foreach ($rmk as $row) echo "<option value='" . $row['id_rmk'] ."' ". (($row['id_rmk'] == $poster['id_rmk']) ? 'selected' : '') .">" . $row['nama_rmk'] . "</option>"; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="abstrak">Abstrak </label>
                        <textarea type="text" name="abstrak" class="form-control" placeholder="" disabled><?php echo $poster['abstrak']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="keyword">Kata Kunci <a href="#" data-toggle="tooltip" title="Istilah yang berhubungan dengan TA. Tiap istilah yang berbeda dipisah dengan tanda koma"><i class="fa fa-question-circle"></i></a> </label>
                        <input type="text" name="keyword" class="form-control" placeholder="Kata kunci 1, Kata kunci 2, Kata kunci 3, ..." value="<?php echo $poster['kata_kunci']; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="dosbing_1">Pembimbing 1</label>
                        <input type="text" name="dosbing_1" class="form-control" placeholder="" value="<?php echo $poster['dosbing_1']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_2">Pembimbing 2</label>
                        <input type="text" name="dosbing_2" class="form-control" placeholder="" value="<?php echo $poster['dosbing_2']; ?>" disabled>
                    </div>

                    <div class="form-group" style="background-color: #fff; border: 1px solid #ccc; padding: 9px; border-radius: 5px;">
                        <label for="fileinput">Attached File</label>
                        <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready (function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>