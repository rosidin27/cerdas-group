<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}

if(isset($_GET['data'])){
	if($_GET['data']=="custom"){
		$sql = "SELECT *FROM deskripsi_web ORDER BY id_deskripsi DESC LIMIT 1";
		$data = PdoSelect($sql);
	}else{
		redirect(0,"../");
	}
}else{
	redirect(0,"../");
}

if(isset($_POST['data'])){
	$deskripsi = $_POST['deskripsi'];
	$id = $data['id_deskripsi'];
	$judul = $_POST['judul'];

	$data_field = array($judul,$deskripsi);

	if($_GET['data'] == "custom"){
		edit($data_field,$id);
	}else{
		redirect(0,"../");
	}
}

function edit($data_field, $id){

	if(PdoQuery("UPDATE deskripsi_web SET judul_web = '".$data_field[0]."', deskripsi = '".$data_field[1]."' WHERE id_deskripsi = '".$id."'")){
        echo "<script>alert('Data Tersimpan !'); window.location = ''</script>";
    }else{
        echo "<script>alert('Gagal Tersimpan !'); window.location = ''</script>";
    }
	
}

function redirect($delay,$link){
	echo "<meta http-equiv='refresh' content = '".$delay.",".$link."'>";
}
?>
 

<html>
	<head>
		<title>Menu Admin</title>
		<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    	<script>tinymce.init({ selector:'textarea' });</script>-->
	</head>
	<body>
		<div class="container" style="margin-top: 100px;">
		<form action="" method="POST" enctype="multipart/form-data">
			<center><h3>Edit Data Web</h3></center><br>
			<label><h4>Judul Web</h4></label> 	
			<div class="form-group">
				<input type="text" name="judul" class="form-control" value="<?php if(isset($data)) echo $data['judul_web']; ?>">
			</div>
			<div class="form-group">
				<label><h4>Deskripsi Meta Data</h4></label> 
				<textarea class="form-control" name="deskripsi" style="width:100%; height:320px;"><?php if(isset($data)) echo $data['deskripsi']; ?></textarea>
				<p style="color:red;">Ketik "<strong><i>&lt;br&gt;</i></strong>" (tanpa tanda kutip) disetiap akhir kalimat atau kata untuk membuat baris baru.</p>
			</div>
			<button type="submit" name="data" class="btn btn-primary" style="width:49%; margin-bottom: 50px; float: left">Simpan</button>
		</form>
			<a href="../"><button class="btn btn-danger" style="width:49%; margin-bottom: 50px;float: right">Batal</button></a>
		</div>
	</body>
</html>