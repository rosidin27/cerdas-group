<?php
	if(isset($_POST['edit'])){
		include "include/upload_img.php";
		$tmp_file = img($data = array(''));
		$gambar = $tmp_file[0];
		$judul = filter($_POST['judul']);
		$keyword = filter($_POST['keyword']);
		$kategori = filter($_POST['kategori']);
		$deskripsi = filter($_POST['deskripsi']);
		$now = date("d M Y", time());
		$data_field = array(
			'kategori' => $kategori,
			'judul' => $judul,
			'gambar' => $gambar,
			'deskripsi' => $deskripsi,
			'keyword' => $keyword,
			'username' => $_SESSION['username'],
			'tanggal' => $now
		);

		input($data_field);
	}

	function input($data){
		if($data['gambar']=="" || $data['gambar']==NULL ){
			$img = "";
		}else{
			$pic = PdoSelect("SELECT gambar FROM berita WHERE id_berita='".filter($_GET['id'])."'");
			unlink("../img/berita/".$pic['gambar']);
			$img = "gambar = '".$data['gambar']."',";	
		}
		$update = "UPDATE berita SET 
			id_kategori = '".$data['kategori']."',
			judul = '".$data['judul']."',
			".$img."
			isi = '".$data['deskripsi']."',
			keyword = '".$data['keyword']."',
			username = '".$data['username']."'
			WHERE id_berita='".filter($_GET['id'])."'";
		if(PdoQuery($update)){
			echo "<script>alert('Data Tersimpan !'); window.location = '?data=berita&aksi=list'</script>";
			exit();
		}else{
			echo "<script>alert('Gagal Tersimpan !'); window.location = ''</script>";
			exit();
		}
	}

	$kategori = getKategori();
	$berita = getData(filter($_GET['id']));
?>
<div class="container" style="margin-top: 90px;">
	<form action="" method="POST" enctype="multipart/form-data">
		<legend>Input Berita</legend>

		<div class="form-group">
			<label for="">Judul</label>
			<input name="judul" type="text" class="form-control" value="<?php echo $berita['judul']; ?>" required>
		</div>
		<div class="form-group">
			<label for="">Kategori</label>
			<select name="kategori" class="form-control" required>
				<?php
					while ($kat = $kategori->fetch(PDO::FETCH_ASSOC)) {
						if($kat['id_kategori']==$berita['id_kategori']){
							echo '<option value="'.$kat['id_kategori'].'" selected>'.$kat['kategori'].'</option>';
						}else{
							echo '<option value="'.$kat['id_kategori'].'">'.$kat['kategori'].'</option>';
						}
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Keyword</label>
			<input name="keyword" type="text" class="form-control" value="<?php echo $berita['keyword']; ?>" required>
		</div>
		<div class="form-group">
			<label for="">Gambar</label>
			<input type="file" name="foto0">
			<a href="../img/berita/<?php echo $berita['gambar']; ?>" target="_blank"><img class="fit-view" src="../img/berita/<?php echo $berita['gambar']; ?>"></a>
		</div>
		<div class="form-group">
			<label for="">Deskripsi</label>
			<textarea name="deskripsi" style="height: 700px;" ><?php echo $berita['isi']; ?></textarea>
		</div>
		

		<button type="submit" class="btn btn-primary" name="edit">Submit</button>
	</form>
</div>

<?php 
	function getKategori(){
		$sql = "SELECT *FROM kategori ORDER BY id_kategori ASC";
		$kategori = PdoQuery($sql);

		return $kategori;
	}

	function getData($id){
		$sql = "SELECT *FROM berita INNER JOIN kategori ON (berita.id_kategori = kategori.id_kategori) WHERE id_berita='".$id."'";
		if(JumlahData($sql) > 0){
			$data = PdoSelect($sql);
			return $data;
		}else{
			echo "<script>alert('Not Found !'); window.location='?data=berita';</script>";
		}

	}

?>