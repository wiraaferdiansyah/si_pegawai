<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_nasabah WHERE noInduk='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

    </style>
</head>
<body>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Isi Data</h3>
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
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
                    <input type="number" class="form-control" id="berat" name="berat" placeholder="Berat Sampah" required onchange="updateCredit()">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Debit</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="debit" name="debit" placeholder="Debit" required onchange="updateCredit()">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kredit</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="kredit" name="kredit" placeholder="Kredit" readonly>
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=daftar-laporan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    function updateCredit() {
    var harga = document.getElementById('kategori').options[document.getElementById('kategori').selectedIndex].getAttribute('data-harga');
    var berat = document.getElementById('berat').value;
    var debit = document.getElementById('debit').value;

    // Handle the case when debit is 0
    var kredit = (berat * harga);

    kredit = Math.max(0, kredit);

    document.getElementById('kredit').value = kredit;
}
</script>

</body>
</html>

<?php

if (isset($_POST['Simpan'])) {
    if (!empty($_POST['noInduk']) && !empty($_POST['tanggal']) && !empty($_POST['berat']) && !empty($_POST['debit']) && !empty($_POST['kredit'])) {
        // Assuming you have a database connection named $koneksi
    
        // Step 1: Retrieve the previous credit amount
        $sql_previous_data = "SELECT kredit, debit FROM tb_setoran WHERE noInduk = ? ORDER BY tanggal DESC LIMIT 1";
        $stmt_previous_data = mysqli_prepare($koneksi, $sql_previous_data);
        mysqli_stmt_bind_param($stmt_previous_data, "s", $_POST['noInduk']);
        mysqli_stmt_execute($stmt_previous_data);
        mysqli_stmt_bind_result($stmt_previous_data, $previous_credit, $previous_debit);
        mysqli_stmt_fetch($stmt_previous_data);
        mysqli_stmt_close($stmt_previous_data);

        // Step 2: Calculate the new "saldo" value
        $saldo = $previous_credit - $previous_debit + ($_POST['kredit'] - $_POST['debit']);

// Ensure kredit is non-negative
$kredit = max(0, $_POST['kredit']);

// Step 3: Insert the new record with the calculated "saldo" value
$sql_simpan = "INSERT INTO tb_setoran (id_jenis, noInduk, tanggal, berat, debit, kredit, saldo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $sql_simpan);

// Assuming id_jenis is an integer, change "sssss" to "isssss"
mysqli_stmt_bind_param($stmt, "sssssss", $_POST['id_jenis'], $_POST['noInduk'], $_POST['tanggal'], $_POST['berat'], $_POST['debit'], $kredit, $saldo);

$query_simpan = mysqli_stmt_execute($stmt);

        // Your existing success/failure handling code...

        // Check if $stmt is defined before closing it
        

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = 'index.php?page=daftar-laporan';
                }
            })</script>";
        }
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = 'index.php?page=add-nasabah';
            }
        })</script>";
    }
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
}