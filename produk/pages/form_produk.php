<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        // Ambil Data Produk sesuai data yang mau diedit
        $sql = "select*from produk where id = $id and 1=1";
        $query = mysqli_query($conn->connect(), $sql);
        $produk = mysqli_fetch_assoc($query);

        $nama_produk = $produk['nama_produk'];
    } else {
        $nama_produk = "";
    }

?>

    <form id="produk" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/produk/proses_input" enctype="multipart/form-data">

        <?php if ($p_act == "edit" && !empty($id)) {
        ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" class="form-control rounded-0" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

<?php
}
?>