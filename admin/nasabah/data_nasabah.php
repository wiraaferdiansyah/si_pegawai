<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Nasabah</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Kategori</th>
						<th>Berat</th>
						<th>Debit</th>
						<th>Kredit</th>
						<th>Saldo</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

				<?php
    $no = 1;
    $noInduk = $_GET["kode"];
    $sql = $koneksi->query("SELECT * FROM tb_setoran WHERE noInduk = $noInduk");
    while ($data = $sql->fetch_assoc()) {
        $id_jenis = $data['id_jenis'];

        // Use prepared statement to prevent SQL injection
        $stmt_kategori = $koneksi->prepare("SELECT jensiSampah FROM tb_jenis WHERE id_jenis = ?");
        $stmt_kategori->bind_param("s", $id_jenis);
        $stmt_kategori->execute();
        $stmt_kategori->bind_result($kategori_name);

        // Fetch the result
        $stmt_kategori->fetch();
        $stmt_kategori->close();


        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $kategori_name; ?></td>
            <td><?php echo $data['berat']; ?></td>
            <td><?php echo $data['debit']; ?></td>
            <td><?php echo $data['kredit']; ?></td>
            <td><?php echo $data['saldo']; ?></td>
            <td>
                <a href="?page=del-setoran&kode=<?php echo $data['idSetoran']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
					title="Hapus" class="btn btn-danger btn-sm">
					<i class="fa fa-trash"></i>
				</a>
                <a href="?page=edit-datasampah&kode=<?php echo $data['idSetoran']; ?>" 
					title="Edit" 
					class="btn btn-primary btn-sm">
					<i class="fa fa-edit"></i>
				</a>

            </td>
        </tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->