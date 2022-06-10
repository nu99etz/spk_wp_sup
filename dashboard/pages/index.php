<?php

defined('__VALID_ENTRANCE') or die('Dilarang Akses Halaman Ini :v');

Page::useLayout("app");

$sqlProduk = "select count(*) as total_produk from produk";
$queryProduk = mysqli_query($conn->connect(), $sqlProduk);
$totalProduk = mysqli_fetch_assoc($queryProduk);

$sqlProdukAlternatif = "select count(*) as total_produk from produk where id in (select id_produk from kriteria_produk)";
$queryProdukAlternatif = mysqli_query($conn->connect(), $sqlProdukAlternatif);
$totalProdukAternatif = mysqli_fetch_assoc($queryProdukAlternatif);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Dashboard </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
                    <li class="breadcrumb-item active">Dashboard</li>
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
            <div class="col-lg-3"></div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalProduk['total_produk']; ?></h3>

                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <a href="<?php echo $config['base_url'] . $config['path']; ?>/produk" class="small-box-footer">
                        Produk <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalProdukAternatif['total_produk']; ?></h3>

                        <p>Data Alternatif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <a href="<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif" class="small-box-footer">
                        Data Alternatif <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php Page::buildLayout(); ?>