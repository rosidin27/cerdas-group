<?php
	if(isset($_POST['input'])){
		include "include/upload_img.php";
		$tmp_file = img($data = array(''));
		$gambar = $tmp_file[0];
		$judul = filter($_POST['judul']);
		$keyword = filter($_POST['keyword']);
		$kategori = filter($_POST['kategori']);
		$deskripsi = filter($_POST['deskripsi']);
		$now = date("d M Y", time());

		$data_field = array($kategori,$judul,$gambar,$deskripsi,$keyword,$_SESSION['username'],$now);

		input($data_field);
	}

	function input($data_field){
		$field = array('id_kategori','judul','gambar','isi','keyword','username','tanggal');
		$data = array($data_field);

		if(PdoInput("berita",$field,$data)){
			echo "<script>alert('Data Tersimpan !'); window.location = '?data=berita&aksi=list'</script>";
			exit();
		}else{
			echo "<script>alert('Gagal Tersimpan !'); window.location = ''</script>";
			exit();
		}
	}

	$kategori = getKategori();
?>
<div class="container" style="margin-top: 90px;">
	<form action="" method="POST" enctype="multipart/form-data">
		<legend>Input Berita</legend>

		<div class="form-group">
			<label for="">Judul</label>
			<input name="judul" type="text" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="">Kategori</label>
			<select name="kategori" class="form-control" required>
				<?php
					while ($kat = $kategori->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="'.$kat['id_kategori'].'">'.$kat['kategori'].'</option>';		
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Keyword</label>
			<input name="keyword" type="text" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="">Gambar</label>
			<input type="file" name="foto0" required>
		</div>
		<div class="form-group">
			<label for="">Deskripsi</label>
			<textarea name="deskripsi" style="height: 700px;" ></textarea>
		</div>
		

		<button type="submit" class="btn btn-primary" name="input">Submit</button>
	</form>
</div>

<?php 
	function getKategori(){
		$sql = "SELECT *FROM kategori ORDER BY id_kategori ASC";
		$kategori = PdoQuery($sql);

		return $kategori;
	}

?>