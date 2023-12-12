<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Nasabah</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-nasabah" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>No.Induk</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>No Hp</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * from tb_nasabah");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['noInduk']; ?>
						</td>
						<td>
							<?php echo $data['nama']; ?>
						</td>
						<td>
							<?php echo $data['alamat']; ?>
						</td>
						<td>
							<?php echo $data['noHp']; ?>
						</td>

						<td>
							<a href="?page=del-nasabah&kode=<?php echo $data['noInduk']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
							<i class="fa fa-trash"></i>
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