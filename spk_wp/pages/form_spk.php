<?php

if (Route::is_ajax()) {

    $sql_kriteria = "select id, nama_kriteria from kriteria where 1 = 1";
    $query_kriteria = mysqli_query($conn->connect(), $sql_kriteria);

    $record = [];
    while ($kriteria = mysqli_fetch_assoc($query_kriteria)) {
        $row = [];
        $row['id'] = $kriteria['id'];
        $row['nama_kriteria'] = $kriteria['nama_kriteria'];
        $record[] = $row;
    }

?>

    <form id="ranking" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/spk_wp/proses_ranking" enctype="multipart/form-data">

        <div class="form-group">
            <label for="nama_peranking">Nama Peranking</label>
            <input type="text" class="form-control rounded-0" name="nama_peranking" placeholder="Nama Peranking">
        </div>

        <?php
        for ($i = 0; $i < count($record); $i++) {
        ?>
            <div class="form-group">
                <label for="<?php echo $record[$i]['nama_kriteria']; ?>"><?php echo $record[$i]['nama_kriteria']; ?></label>
                <input type="number" min="1" max="100" class="form-control rounded-0" name="nilai[<?php echo $record[$i]['id']; ?>]; ?>" placeholder="Input 1 - 100">
            </div>
        <?php
        } ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-warning btn-flat"><i class="fas fa-redo"></i> Reset</button>
        </div>
    </form>

<?php
}
?>

<script>
    $('#nama_produk').select2({
        placeholder: '--PILIH PRODUK--',
    });
</script>