<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}

if(isset($_GET['data'])){
	if($_GET['data']=="kontak"){
		$sql = "SELECT *FROM kontak ORDER BY id_kontak DESC";
		$data = PdoSelect($sql);
	}else{
		redirect(0,"../");
	}
}else{
	redirect(0,"../");
}

if(isset($_POST['data'])){
	$facebook = $_POST['facebook'];
	$twitter = str_replace("@", "", $_POST['twitter']);
	$google = $_POST['google'];
	$instagram = str_replace("@", "", $_POST['instagram']);
	$youtube = $_POST['youtube'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$fax = $_POST['fax'];
	$kontak = $_POST['kontak'];
	$maps = str_replace('<iframe', '<iframe class="img-rounded"', $_POST['maps']);
	$id = $data['id_kontak'];

	$data_field = array(
		'kontak'=>$kontak,
		'maps'=>$maps,
		'facebook'=>$facebook,
		'twitter'=>$twitter,
		'google'=>$google,
		'instagram'=>$instagram,
		'youtube'=>$youtube,
		'email'=>$email,
		'phone'=>$phone,
		'fax'=>$fax
	);

	if($_GET['data'] == "kontak"){
		edit($data_field,$id);
	}else{
		redirect(0,"../");
	}
}

function edit($data, $id){
	if(PdoQuery("UPDATE kontak SET 
				kontak='".$data['kontak']."',
				maps='".$data['maps']."',
				facebook='".$data['facebook']."',
				twitter='".$data['twitter']."',
				google='".$data['google']."',
				instagram='".$data['instagram']."',
				youtube='".$data['youtube']."',
				email='".$data['email']."',
				phone='".$data['phone']."',
				fax='".$data['fax']."'
				WHERE id_kontak='".$id."'")){
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
		<div class="container" style="margin-top: 100px;">
		<form action="" method="POST" enctype="multipart/form-data">
			<center><h3>Edit Data Kontak</h3></center><br>
			<div class="form-group">
				<label><h4>Facebook</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="facebook" type="text" class="form-control" placeholder="Masukkan link fan page anda" value="<?php if(isset($data)) echo $data['facebook']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-facebook fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Twitter</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="twitter" type="text" class="form-control" placeholder="Masukkan id twitter anda" value="<?php if(isset($data)) echo "@".$data['twitter']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-twitter fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Google Plus</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="google" type="text" class="form-control" placeholder="Masukkan link fan page anda" value="<?php if(isset($data)) echo $data['google']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-google-plus fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Instagram</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="instagram" type="text" class="form-control" placeholder="Masukkan id instagram anda" value="<?php if(isset($data)) echo "@".$data['instagram']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-instagram fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Youtube</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="youtube" type="text" class="form-control" placeholder="Masukkan link youtube anda" value="<?php if(isset($data)) echo $data['youtube']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-youtube fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Email</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="email" type="email" class="form-control" placeholder="Masukkan email anda" value="<?php if(isset($data)) echo $data['email']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-envelope fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Phone</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="phone" type="text" class="form-control" placeholder="Masukkan nomor handphone anda" value="<?php if(isset($data)) echo $data['phone']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-phone fa-size" ></i></button>
					</span>
				</div>
				<label><h4>Fax</h4></label> 
				<div class="input-group" style="margin-bottom: 20px;">
					<input name="fax" type="text" class="form-control" placeholder="Masukkan fax anda" value="<?php if(isset($data)) echo $data['fax']; ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" style="color:black"><i class="fa fa-envelope fa-size" ></i></button>
					</span>
				</div>
			</div>
			<div class="form-group" style="margin-bottom: 20px;">
				<label><h4>Alamat</h4></label> 
				<textarea class="form-control" name="kontak" style="width:100%; height:220px;"><?php if(isset($data)) echo $data['kontak']; ?></textarea>
			</div>
			<div class="form-group" style="margin-bottom: 20px;">
				<label><h4>Maps</h4></label> 
				<textarea class="form-control" name="maps" style="width:100%; height:420px;"><?php if(isset($data)) echo $data['maps']; ?></textarea>
				<p style="color:red;">Masukkan kode embed yang didapat dari google maps.</p>
			</div>
			<button type="submit" name="data" class="btn btn-primary" style="width:49%; margin-bottom: 50px; float: left">Simpan</button>
		</form>
			<a href="../"><button class="btn btn-danger" style="width:49%; margin-bottom: 50px;float: right">Batal</button></a>
		</div>
	</body>
</html>