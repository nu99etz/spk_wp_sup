<?php

if (Route::is_ajax()) {

    if ($p_act == "edit" && !empty($id)) {

        $sql_data_alternatif = "select*from kriteria_produk where id_produk = $id";
        $query_data_alternatif = mysqli_query($conn->connect(), $sql_data_alternatif);

        $recordKriteriaProduk = [];
        while ($kriteriaProduk = mysqli_fetch_assoc($query_data_alternatif)) {
            $row = [];
            $row['nilai_kriteria'] = $kriteriaProduk['nilai_kriteria'];
            $recordKriteriaProduk[] = $row;
        }

        $sql_produk = "select id, nama_produk from produk where id in (select id_produk from kriteria_produk where id_produk = $id)";
    } else {

        $sql_produk = "select id, nama_produk from produk where id not in (select id_produk from kriteria_produk)";
        $recordKriteriaProduk = '';
    }


    $query_produk = mysqli_query($conn->connect(), $sql_produk);

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

    <form id="alternatif" method="post" action="<?php echo $config['base_url'] . $config['path']; ?>/data_alternatif/proses_input" enctype="multipart/form-data">

        <?php if ($p_act == "edit" && !empty($id)) {
        ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <select class="custom-select rounded-0" style="width: 100%;" id="nama_produk" name="nama_produk">
                <option></option>
                <?php while ($produk = mysqli_fetch_assoc($query_produk)) {
                    if (!empty($id)) {
                        if ($produk['id'] == $id) {
                ?>
                            <option value="<?php echo $produk['id']; ?>" selected><?php echo $produk['nama_produk']; ?></option>
                        <?php  } else {
                        ?>
                            <option value="<?php echo $produk['id']; ?>"><?php echo $produk['nama_produk']; ?></option>
                        <?php    }
                    } else {
                        ?>
                        <option value="<?php echo $produk['id']; ?>"><?php echo $produk['nama_produk']; ?></option>
                    <?php    }
                    ?>
                <?php  } ?>
            </select>
        </div>

        <?php if (empty($recordKriteriaProduk)) {
            for ($i = 0; $i < count($record); $i++) {
        ?>
                <div class="form-group">
                    <label for="<?php echo $record[$i]['nama_kriteria']; ?>"><?php echo $record[$i]['nama_kriteria']; ?></label>
                    <input type="text" class="form-control rounded-0" name="nilai[<?php echo $record[$i]['id']; ?>]; ?>" placeholder="<?php echo $record[$i]['nama_kriteria']; ?>">
                </div>
            <?php   }
        } else if (!empty($recordKriteriaProduk)) {
            for ($i = 0; $i < count($record); $i++) {
            ?>
                <div class="form-group">
                    <label for="<?php echo $record[$i]['nama_kriteria']; ?>"><?php echo $record[$i]['nama_kriteria']; ?></label>
                    <input type="text" class="form-control rounded-0" name="nilai[<?php echo $record[$i]['id']; ?>]; ?>" placeholder="<?php echo $record[$i]['nama_kriteria']; ?>" value="<?php echo $recordKriteriaProduk[$i]['nilai_kriteria']; ?>">
                </div>
        <?php   }
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