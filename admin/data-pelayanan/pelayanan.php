<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}

if(isset($_GET['data'])){
	if($_GET['data']=="pelayanan"){
		$sql = "SELECT *FROM pelayanan ORDER BY id_pelayanan DESC";
		$data = PdoSelect($sql);
	}else{
		redirect(0,"../");
	}
}else{
	redirect(0,"../");
}

if(isset($_POST['data'])){
	$pelayanan1 = $_POST['pelayanan1'];
	$pelayanan2 = $_POST['pelayanan2'];
	$pelayanan3 = $_POST['pelayanan3'];
	$pelayanan4 = $_POST['pelayanan4'];
	$pelayanan5 = $_POST['pelayanan5'];
	$video = str_replace('<iframe', '<iframe class="img-rounded"', $_POST['video']);
	$id = $data['id_pelayanan'];

	$data_field = array(
		'pelayanan1'=>$pelayanan1,
		'pelayanan2'=>$pelayanan2,
		'pelayanan3'=>$pelayanan3,
		'pelayanan4'=>$pelayanan4,
		'pelayanan5'=>$pelayanan5,
		'video'=>$video,
	);

	if($_GET['data'] == "pelayanan"){
		edit($data_field,$id);
	}else{
		redirect(0,"../");
	}
}

function edit($data, $id){
	if(PdoQuery("UPDATE pelayanan SET 
			pelayanan1='".$data['pelayanan1']."', 
			pelayanan2='".$data['pelayanan2']."', 
			pelayanan3='".$data['pelayanan3']."', 
			pelayanan4='".$data['pelayanan4']."', 
			pelayanan5='".$data['pelayanan5']."', 
			video='".$data['video']."' 
			WHERE id_pelayanan='".$id."'")){
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
	</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data">
			<center><h3>Edit Data Pelayanan</h3></center><br>

			<div class="form-group">
				<label><h4>Pelayanan 1</h4></label> 
				<input class="form-control" type="text" name="pelayanan1" value="<?php if(isset($data)) echo $data['pelayanan1']; ?>">
			</div>
			<div class="form-group">
				<label><h4>Pelayanan 2</h4></label> 
				<input class="form-control" type="text" name="pelayanan2" value="<?php if(isset($data)) echo $data['pelayanan2']; ?>">
			</div>
			<div class="form-group">
				<label><h4>Pelayanan 3</h4></label> 
				<input class="form-control" type="text" name="pelayanan3" value="<?php if(isset($data)) echo $data['pelayanan3']; ?>">
			</div>
			<div class="form-group">
				<label><h4>Pelayanan 4</h4></label> 
				<input class="form-control" type="text" name="pelayanan4" value="<?php if(isset($data)) echo $data['pelayanan4']; ?>">
			</div>
			<div class="form-group">
				<label><h4>Pelayanan 5</h4></label> 
				<input class="form-control" type="text" name="pelayanan5" value="<?php if(isset($data)) echo $data['pelayanan5']; ?>">
			</div>
			<div class="form-group">
				<label><h4>Video</h4></label> 
				<textarea class="form-control" name="video" style="width:100%; height:370px;"><?php if(isset($data)) echo $data['video']; ?></textarea>
				<p style="color:red;">Masukkan kode embed yang didapat dari youtube.</p>
			</div>
			<button type="submit" name="data" class="btn btn-primary" style="width:49%; margin-bottom: 50px; float: left">Simpan</button>
		</form>
			<a href="../"><button class="btn btn-danger" style="width:49%; margin-bottom: 50px;float: right">Batal</button></a>
	</body>
</html>