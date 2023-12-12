<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No Induk</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="noInduk" name="noInduk" placeholder="No Induk" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Nasabah</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Nasabah" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No HP</label>
				<div class="col-sm-5">
					<input type="telp" class="form-control" id="noHp" name="noHp" placeholder="No HP" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=daftar-nasabah" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){

		if (!empty($_POST['noInduk']) && !empty($_POST['nama']) && !empty($_POST['alamat']) && !empty($_POST['noHp'])){
        $sql_simpan = "INSERT INTO tb_nasabah (noInduk, nama, alamat, noHp) VALUES (
            '".$_POST['noInduk']."',
			'".$_POST['nama']."',
			'".$_POST['alamat']."',
			'".$_POST['noHp']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        // mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=daftar-nasabah';
          }
      })</script>";
	}
	}else{
		echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-nasabah';
          }
      })</script>";
	}
	}
     //selesai proses simpan data
