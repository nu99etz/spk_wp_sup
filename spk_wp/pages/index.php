<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sql = "select*from kriteria where id in (select id_kriteria from nilai_bobot_kriteria)";
$query_kriteria = mysqli_query($conn->connect(), $sql);

$sql = "select count(id) as total from produk where id in (select id_produk from kriteria_produk)";
$query = mysqli_query($conn->connect(), $sql);
$total = mysqli_fetch_assoc($query);

function total($conn)
{
    $sql = "select count(id) as total from temp_list";
    $query = mysqli_query($conn->connect(), $sql);
    $total = mysqli_fetch_assoc($query);
    return $total['total'];
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Data Alternatif</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo $config['base_url'] . $config['path']; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Data Alternatif</li>
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
            <!-- /.col-md-6 -->
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fa fa-info"></i> <b>Perhatian!</b></h5>
                    Silahkan untuk memilih minimal 3 produk untuk melakukan perankingan.
                </div>
            </div>
            <?php if (!empty($_SESSION['apps']['validation'])) {
            ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fa fa-ban"></i> <b>Gagal!</b></h5>
                        <?php echo $_SESSION['apps']['validation']; ?>
                    </div>
                </div>
            <?php unset($_SESSION['apps']['validation']);
            } ?>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Data Alternatif</h5>
                    </div>
                    <div class="card-body">
                        <?php if (total($conn) > 2) {
                        ?>
                            <div style="float: right;">
                                <button type="button" class="btn btn-sm btn-flat btn-primary btn-rank"><i class="fa fa-trophy"></i> Ranking</button>
                            </div>
                            <br />
                            <br />
                        <?php } ?>
                        <table id="alternatif" class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <?php if ($total['total'] != total($conn)) {
                                ?>
                                    <th><input type="checkbox" id="pilih" act="<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/proses_pemilihan/add/"></th>
                                <?php } else {
                                ?>
                                    <th><input type="checkbox" id="pilih" act="<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/proses_pemilihan/delete/" checked></th>
                                <?php   } ?>
                                <th>Nama Produk</th>
                                <?php while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
                                ?>
                                    <th><?php echo ucwords($kriteria['nama_kriteria']); ?></th>
                                <?php  } ?>
                            </thead>
                            <tbody></tbody>
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
    let _table = $("#alternatif");
    let _url = "<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/list_alternatif";
    let _modal = $('#modal_ranking');

    DataTables(_url, _table);

    $(document).on('click', '#pilih', function() {
        let _url = $(this).attr('act');
        send((data, xhr = null) => {
            if (data.status == 200) {
                window.location.href = "<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/";
            }
        }, _url, "json", "get");
    });

    $(document).on('click', '.btn-rank', function() {
        let _url = "<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/form_spk";
        getViewModal(_url, _modal);
    });
</script>

<?php Page::buildLayout(); ?>