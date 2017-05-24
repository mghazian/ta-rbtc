<div class="container">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<h4> Pencarian </h4>
        <div id="search-bar">
            <form class="form-horizontal" role="form" method="GET" action="<?php echo base_url ('search/result'); ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="judul" value="<?php echo $request['judul']; ?>"/>
                    <div class="input-group-btn">
                        <div class="btn-group" role="group">
                            <div class="dropdown dropdown-lg">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <div class="form-group">
                                        <label for="contain">Author</label>
                                        <input class="form-control" type="text" name="author" value="<?php echo $request['author']; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="contain">Tahun</label>
                                        <input class="form-control" type="text" name="tahun" value="<?php echo $request['tahun']; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
		<div id="search-result">
			<?php foreach ($poster as $obj) { ?>
			<a href="<?php echo base_url ('search/poster') . '/' . $obj['id_poster']; ?>"><div class="content-block">
				<img src="<?php echo base_url ($obj['path_image']); ?>">
				<div class="title"><?php echo $obj['judul_publikasi']; ?></div>
				<div class="author"><?php echo $obj['nama_penulis']; ?></div>
				<div class="year"><?php echo $obj['tahun_publikasi']; ?></div>
			</div></a>
			<?php } ?>
		</div>
	</div>
</div>