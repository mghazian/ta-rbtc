<div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="title" style="margin: 40px; margin-bottom: 80px">
            <h1> PORTAL REPOSITORI POSTER RBTC </h1>
        </div>
        <div class="search-bar-container">
            <h4> Pencarian </h4>
            <div id="search-bar">
                <form class="form-horizontal" role="form" method="GET" action="<?php echo base_url ('search/result'); ?>">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="judul" />
                        <div class="input-group-btn">
                            <div class="btn-group" role="group">
                                <div class="dropdown dropdown-lg">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <div class="form-group">
                                            <label for="contain">Author</label>
                                            <input class="form-control" type="text" name="author" />
                                        </div>
                                        <div class="form-group">
                                            <label for="contain">Tahun</label>
                                            <input class="form-control" type="text" name="tahun" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>