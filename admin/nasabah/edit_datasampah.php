<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_setoran WHERE idSetoran='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Profil</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
	<div class="card-body">

<div class="form-group row">
	<label class="col-sm-2 col-form-label">No Induk</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="noInduk" name="noInduk" value="<?php echo $data_cek['noInduk']; ?>" readonly/>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 col-form-label">Tanggal</label>
	<div class="col-sm-5">
		<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data_cek['tanggal']; ?>"required>
	</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Kategori</label>
<div class="col-sm-5">
	<select class="form-select form-control" id="kategori" name="id_jenis" aria-label="Default select example" onchange="updateCredit()">
		<option selected>Pilih Kategori Sampah</option>
		<?php
			// Assuming you have a $koneksi connection
			$sql_kategori = "SELECT * FROM tb_jenis";
			$query_kategori = mysqli_query($koneksi, $sql_kategori);

			while ($data_kategori = mysqli_fetch_array($query_kategori, MYSQLI_BOTH)) {
				echo '<option value="' . $data_kategori['id_jenis'] . '" data-harga="' . $data_kategori['harga'] . '">' . $data_kategori['jensiSampah'] . '</option>';
			}
		?>
	</select>
</div>
</div>



<div class="form-group row">
	<label class="col-sm-2 col-form-label">Berat</label>
	<div class="col-sm-5">
		<input type="number" class="form-control" id="berat" name="berat" placeholder="Berat Sampah" value="<?php echo $data_cek['berat']; ?>" required onchange="updateCredit()">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 col-form-label">Debit</label>
	<div class="col-sm-5">
		<input type="number" class="form-control" id="debit" name="debit" placeholder="Debit" value="<?php echo $data_cek['debit']; ?>" required onchange="updateCredit()">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-2 col-form-label">Kredit</label>
	<div class="col-sm-5">
		<input type="number" class="form-control" id="kredit" name="kredit" placeholder="Kredit" value="<?php echo $data_cek['kredit']; ?>" readonly>
	</div>
</div>

</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-profil" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE tb_setoran SET 
    tanggal='".$_POST['tanggal']."', 
    berat='".$_POST['berat']."', 
    debit='".$_POST['debit']."'
    WHERE idSetoran='".$_GET['kode']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=daftar-laporan';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=daftar-laporan';
        }
      })</script>";
    }}
