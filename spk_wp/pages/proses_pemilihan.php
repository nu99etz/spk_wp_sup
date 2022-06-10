<?php

if (Route::is_ajax()) {

    function addCheckList($conn, $id)
    {
        $sql = "insert into temp_list (id_produk) values ('$id')";
        $query = mysqli_query($conn->connect(), $sql);
    }

    function deleteCheckList($conn, $id)
    {
        $sql = "delete from temp_list where id_produk = $id";
        $query = mysqli_query($conn->connect(), $sql);
    }

    if ($p_act == 'add') {

        if (!empty($id)) {
            addCheckList($conn, $id);
        } else {
            $sql = "select id from produk where id in (select id_produk from kriteria_produk)";
            $query = mysqli_query($conn->connect(), $sql);

            $sqlDelete = "delete from temp_list";
            $queryDelete = mysqli_query($conn->connect(), $sqlDelete);

            while ($produk = mysqli_fetch_assoc($query)) {
                addCheckList($conn, $produk['id']);
            }
        }

        $response = [
            'status' => 200,
        ];
    } else if ($p_act == 'delete') {

        if (!empty($id)) {
            deleteCheckList($conn, $id);
        } else {
            $sqlDelete = "delete from temp_list";
            $queryDelete = mysqli_query($conn->connect(), $sqlDelete);
        }

        $response = [
            'status' => 200,
        ];
    }

    echo json_encode($response);
}
