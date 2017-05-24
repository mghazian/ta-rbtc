<div class="container">
    <div class="col-sm-8" style="margin-left: auto; margin-right: auto">
        <h1> FORM PENDAFTARAN </h1>
        <form method="POST" action="<?php echo base_url ('admin/tambah'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Tugas Akhir : </label>
                <input type="text" name="judul" class="form-control" placeholder="" value="<?php echo set_value ('judul'); ?>">
            </div>

            <div class="form-group">
                <label for="nama">Nama Author : </label>
                <input type="text" name="nama" class="form-control" placeholder="" value="<?php echo set_value ('nama'); ?>">
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Publikasi : </label>
                <input type="text" name="tahun" class="form-control" placeholder="" value="<?php echo set_value ('tahun'); ?>">
            </div>

            <div class="form-group">
                <label for="rumpun">Rumpun Mata Kuliah : </label>
                <select name="rumpun" class="form-control">
                    <option selected hidden>Pilih RMK</option>
                    <?php foreach ($rmk as $row) echo "<option value='" . $row['id_rmk'] ."'>" . $row['nama_rmk'] . "</option>"; ?>
                </select>
            </div>

            <div class="form-group" style="background-color: #fff; border: 1px solid #ccc; padding: 9px; border-radius: 5px;">
                <label for="fileinput">Attached File</label>
                <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            </div>
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
        </form>
    </div>
</div>