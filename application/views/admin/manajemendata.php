<div class="container">
    <div class="col-sm-8" style="margin-left: auto; margin-right: auto">
        <h1> FORM PENDAFTARAN </h1>
        <form method="POST" action="<?php echo base_url ('admin/edit') . '/' . $poster['id_poster']; ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_poster" value="<?php echo $poster['id_poster']; ?>">
            <div class="form-group">
                <label for="judul">Judul Tugas Akhir : </label>
                <input type="text" name="judul" class="form-control" placeholder="" value="<?php echo $poster['judul_publikasi']; ?>">
            </div>

            <div class="form-group">
                <label for="nama">Nama Author : </label>
                <input type="text" name="nama" class="form-control" placeholder="" value="<?php echo $poster['nama_penulis']; ?>">
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Publikasi : </label>
                <input type="text" name="tahun" class="form-control" placeholder="" value="<?php echo $poster['tahun_publikasi']; ?>">
            </div>

            <div class="form-group">
                <label for="rumpun">Rumpun Mata Kuliah : </label>
                <select name="rumpun" class="form-control">
                    <option selected hidden value="none">Pilih RMK</option>
                    <?php foreach ($rmk as $row) echo "<option value='" . $row['id_rmk'] ."' ". (($row['id_rmk'] == $poster['id_rmk']) ? 'selected' : '') .">" . $row['nama_rmk'] . "</option>"; ?>
                </select>
            </div>

            <div class="form-group" style="background-color: #fff; border: 1px solid #ccc; padding: 9px; border-radius: 5px;">
                <label for="fileinput">File input</label>
                <input type="file" name="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            </div>
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">

        </form>
    </div>
</div>