<?php
	if(isset($_POST['delete'])){
		$id = filter($_POST['delete']);
		$query = "DELETE FROM kategori WHERE id_kategori='".$id."'";
		if(PdoQuery($query)){
			echo "<script>window.location = '?data=kategori'</script>";
			exit();
		}
	}elseif (isset($_POST['edit'])) {
		$id = filter($_POST['edit']);
		$kategori = filter($_POST['kategori']);
		$query = PdoQuery("UPDATE kategori SET kategori = '".$kategori."' WHERE id_kategori = '".$id."'");
		if($query){
			echo "<script>alert('Data Tersimpan !'); window.location = '?data=kategori'</script>";
			exit();
		}else{
			echo "<script>alert('Data Gagal Tersimpan !');</script>";
			exit();
		}
	}elseif (isset($_POST['input'])) {
		$kategori = filter($_POST['kategori']);
		$field = array('kategori');
		$data = array(array($kategori));

		if(PdoInput("kategori",$field,$data)){
			echo "<script>alert('Data Tersimpan !'); window.location = '?data=kategori'</script>";
			exit();
		}else{
			echo "<script>alert('Data Gagal Tersimpan !');</script>";
			exit();
		}
	}
	$query = getData();
	$no=1;
?>
<div class="container" style="margin-top: 90px;">
	<center><h3>Data Kategori</h3></center><br>
	<a class="btn btn-primary" data-toggle="modal" href='#modal-input'><span class="fa fa-plus"></span> Input Kategori</a>
	<div class="modal fade" id="modal-input">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Input Kategori</h4>
				</div>
				<form action="" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label>Kategori</label>
							<input class="form-control" type="text" name="kategori" placeholder="Masukkan kategori" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary" name="input">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="table-responsive" style="margin-top: 10px;">
		<table class="table table-hover" id="data">
			<thead>
				<tr>
					<th>No</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php while($data = $query->fetch(PDO::FETCH_ASSOC)){ ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data['kategori']; ?></td>
					<td>
						<a class="btn btn-info" data-toggle="modal" href='#edit_<?php echo $data['id_kategori']; ?>'>Edit</a>
							<div class="modal fade" id="edit_<?php echo $data['id_kategori']; ?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Edit Kategori</h4>
										</div>
										<form action="" method="POST">
											<div class="modal-body">
												<div class="form-group">
													<label>Kategori</label><br>
													<input class="form-control" type="text" name="kategori" placeholder="Masukkan kategori" value="<?php echo $data['kategori']; ?>" style="width: 520px;" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" name="edit" value="<?php echo $data['id_kategori'];?>">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						<a class="btn btn-danger" data-toggle="modal" href='#hapus_<?php echo $data['id_kategori']; ?>'>Hapus</a>
							<div class="modal fade" id="hapus_<?php echo $data['id_kategori']; ?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Peringatan !</h4>
										</div>
										<form action="" method="POST">
											<div class="modal-body">
												<div class="form-group">
													<p>Apakah anda yakin ingin menghapus kategori <strong>"<?php echo $data['kategori']; ?>"</strong> ?</p>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
												<button type="submit" class="btn btn-danger" name="delete" value="<?php echo $data['id_kategori'];?>">Hapus</button>
											</div>
										</form>
									</div>
								</div>
							</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php
	function getData(){
		$sql = "SELECT *FROM kategori ORDER BY id_kategori DESC";
		$query = PdoQuery($sql);

		return $query;
	}
?>
<script type="text/javascript">
    $(document).ready(function() {
      $('.data').DataTable();
    });
</script>