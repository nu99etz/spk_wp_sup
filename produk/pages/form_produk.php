<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        // Ambil Data Produk sesuai data yang mau diedit
        $sql = "select*from produk where id = $id and 1=1";
        $query = mysqli_query($conn->connect(), $sql);
        $produk = mysqli_fetch_assoc($query);

        $nama_produk = $produk['nama_produk'];
        $gambar = $produk['gambar'];
    } else {
        $nama_produk = "";
        $gambar = "";
    }

?>

    <style>
        #gambar {
            display: none;
        }
    </style>

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
            <label for="gambar">Gambar Produk</label>
            <br />
            <input type="file" class="form-control rounded-0" name="gambar" id="gambar" placeholder="Gambar Produk">
            <?php if ($gambar == "") {
            ?>
                <img src="<?php echo Route::getAssetPath('Placeholder.jpg'); ?>" alt="Foto Produk" width="300" height="300" id="preview">
            <?php   } else {
            ?>
                <img src="<?php echo Route::getUploadPath('produk', $gambar); ?>" alt="Foto Produk" width="300" height="300" id="preview">
            <?php    } ?>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

    <script>
        function renderImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('click', '#preview', function() {
            $('#gambar').click();
            $(document).on('change', '#gambar', function() {
                renderImg(this);
            });
        });
    </script>

<?php
}
?>