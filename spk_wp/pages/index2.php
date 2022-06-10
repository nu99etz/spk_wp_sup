<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sql = "select*from kriteria where 1 = 1";
$query_kriteria = mysqli_query($conn->connect(), $sql);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Ranking Weighted Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Ranking WP</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="float: right;">
                    <button type="button" class="btn btn-sm btn-flat btn-primary float-right btn-add"><i class="fas fa-trophy"></i> Ranking</button>
                    <br />
                    <br />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Nilai Parameter Kriteria</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>Nama Kriteria</th>
                                <th>Nilai</th>
                            </thead>
                            <tbody id="nilai_param"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Ranking Weighted Product</h5>
                    </div>
                    <div class="card-body">
                        <table id="ranking" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <th>No</th>
                                <th>Id Produk</th>
                                <th>Nama Produk</th>
                                <th>Vektor V</th>
                                <th>Vektor S</th>
                            </thead>
                            <tbody id="isi_ranking"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php
$modal_title = "Form Ranking";
$modal_id = "modal_ranking";
$modal_size = "sm";
include(Route::getViewPath("include/modal"));
?>

<script>
    let _table = $("#ranking");
    let _modal = $('#modal_ranking');

    $(document).on('click', '.btn-add', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/form_spk";
        getViewModal(_url, _modal);
    });

    $(document).on('submit', 'form#ranking', function() {
        event.preventDefault();
        let _data = new FormData($(this)[0]);
        let _url = $(this).attr('action');

        send((data, xhr = null) => {
            if (data.status == 422) {
                FailedNotif(data.messages);
            } else if (data.status == 200) {
                SuccessNotif(data.messages);
                _modal.modal('hide');
                _table.DataTable().destroy();
                $('#isi_ranking').html(data.html);
                _table.DataTable();
            }
        }, _url, "json", "post", _data);
    });
</script>

<?php Page::buildLayout(); ?>