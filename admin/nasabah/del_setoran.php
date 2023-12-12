<?php

if(isset($_GET['kode']) && isset($_GET['idNasabah'])){
    $previousUrl = 'index.php?page=data-nasabah&kode=' . $_GET['idNasabah'];
    $sql_cek = "select * from tb_setoran where idSetoran='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
}
?>

<?php
    $sql_hapus = "DELETE FROM tb_setoran WHERE idSetoran='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {window.location = 'index.php?page=daftar-laporan';}});
    </script>";
        }else{
            echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=daftar-laporan';}});
        </script>";
    }
