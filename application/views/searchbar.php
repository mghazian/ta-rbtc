<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php base_url('assets/css/searchbar.css'); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <h1> FORM PENCARIAN </h1>
                <div class="input-group" id="adv-search">
                    <input type="text" class="form-control" placeholder="Search" />
                    <div class="input-group-btn">
                        <div class="btn-group" role="group">
                            <div class="dropdown dropdown-lg">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label for="filter">Filter by</label>
                                            <select class="form-control">
                                        <option value="0" selected>All</option>
                                        <option value="1">Recommended</option>

                                    </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="contain">Author</label>
                                            <input class="form-control" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label for="contain">Contains the words</label>
                                            <input class="form-control" type="text" />
                                        </div>
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </form>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>