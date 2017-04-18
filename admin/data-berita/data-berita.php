<?php
	if(isset($_POST['delete'])){
		$id = filter($_POST['delete']);
		$img = PdoSelect("SELECT gambar FROM berita WHERE id_berita='".$id."'");
		$gambar = $img['gambar'];
		$query = "DELETE FROM berita WHERE id_berita='".$id."'";
		if(PdoQuery($query)){
			@unlink("../img/berita/".$gambar);
			echo "<script>window.location = '?data=berita&aksi=list'</script>";
			exit();
		}
	}
	$query = getData();
	$no=1;
?>
<div class="container" style="margin-top: 90px;">
	<center><h3>Data Berita</h3></center><br>
	<a class="btn btn-primary" href='?data=berita&aksi=input'><span class="fa fa-plus"></span> Input Berita</a>
	<div class="table-responsive" style="margin-top: 10px;">
		<table class="table table-hover" id="data">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Kategori</th>
					<th>Post By</th>
					<th>Tanggal</th>
					<th>Viewers</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php while($data = $query->fetch(PDO::FETCH_ASSOC)){ ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><a target="_blank" href="<?php echo "../?page=berita&id=".$data['id_berita']; ?>" style="color:blue;"><?php echo $data['judul']; ?></a></td>
					<td><?php echo $data['kategori']; ?></td>
					<td><?php echo $data['username']; ?></td>
					<td><?php echo $data['tanggal']; ?></td>
					<td><?php echo $data['viewers']; ?></td>
					<td><a class="btn btn-info" href="?data=berita&aksi=edit&id=<?php echo $data['id_berita']; ?>">Edit</a> 
						<a class="btn btn-danger" data-toggle="modal" href='#berita_<?php echo $data['id_berita']; ?>'>Hapus</a>
						<div class="modal fade" id="berita_<?php echo $data['id_berita']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Peringatan !</h4>
									</div>
									<div class="modal-body">
										<p>Apakah anda yakin ingin menghapus berita <strong>"<?php echo $data['judul']; ?>"</strong> ? </p>
									</div>
									<div class="modal-footer">
										<form action="" method="POST">
											<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-danger" name="delete" value="<?php echo $data['id_berita']; ?>">Hapus</button>
										</form>
									</div>
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
		$sql = "SELECT *FROM berita INNER JOIN kategori ON (berita.id_kategori = kategori.id_kategori) ORDER BY id_berita DESC";
		$query = PdoQuery($sql);

		return $query;
	}
?>
<script type="text/javascript">
    $(document).ready(function() {
      $('.data').DataTable();
    });
</script>