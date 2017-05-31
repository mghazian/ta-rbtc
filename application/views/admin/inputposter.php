<h1 class="title-bar"> FORM PENDAFTARAN </h1>
<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8" style="margin-left: auto; margin-right: auto">
        <form method="POST" action="<?php echo base_url ('admin/tambah'); ?>" enctype="multipart/form-data">
            <div class="standard-form">
                <div class="standard-form-header">
                    <h3>DATA TUGAS AKHIR</h3>
                </div>
                <div class="standard-form-body">
                    <div class="form-group">
                        <label for="judul">Judul Tugas Akhir </label>
                        <input type="text" name="judul" class="form-control" placeholder="" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Author </label>
                        <input type="text" name="nama" class="form-control" placeholder="" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">NRP Author </label>
                        <input type="text" name="nrp" class="form-control" placeholder="" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Publikasi </label>
                        <input type="text" name="tahun" class="form-control" placeholder="" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="rumpun">Rumpun Mata Kuliah </label>
                        <select name="rumpun" class="form-control" required>
                            <option selected hidden value="none">Pilih RMK</option>
                            <?php foreach ($rmk as $row) echo "<option value='" . $row['id_rmk'] ."' ". (($row['id_rmk'] == $poster['id_rmk']) ? 'selected' : '') .">" . $row['nama_rmk'] . "</option>"; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="abstrak">Abstrak </label>
                        <textarea type="text" name="abstrak" class="form-control" placeholder="" value=""></textarea>
                    </div>

                    <div class="form-group">
                        <label for="keyword">Kata Kunci <a href="#" data-toggle="tooltip" title="Istilah yang berhubungan dengan TA. Tiap istilah yang berbeda dipisah dengan tanda koma"><i class="fa fa-question-circle"></i></a> </label>
                        <input type="text" name="keyword" class="form-control" placeholder="Kata kunci 1, Kata kunci 2, Kata kunci 3, ..." value="">
                    </div>

                    <div class="form-group">
                        <label for="dosbing_1">Pembimbing 1</label>
                        <input type="text" name="dosbing_1" class="form-control" placeholder="" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_2">Pembimbing 2</label>
                        <input type="text" name="dosbing_2" class="form-control" placeholder="" value="">
                    </div>

                    <div class="form-group" style="background-color: #fff; border: 1px solid #ccc; padding: 9px; border-radius: 5px;">
                        <label for="fileinput">Attached File</label>
                        <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit" name="submit">
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