<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}

if(isset($_GET['data'])){
	if($_GET['data']=="user"){
		$sql = "SELECT *FROM user";
		$data = PdoSelect($sql);
	}else{
		redirect(0,"../");
	}
}else{
	redirect(0,"../");
}

if(isset($_POST['data'])){
	$password = filter($_POST['password']);
	$password1 = filter($_POST['password1']);
	$password2 = filter($_POST['password2']);

	if($password1 == $password2){
		$sql = "SELECT *FROM user WHERE username='".$_SESSION['username']."' AND password='".md5($password)."'";
		$cek = JumlahData($sql);
		if($cek > 0){
			if($_GET['data'] == "user"){
				edit($password1,$password);
			}else{
				redirect(0,"../");
			}
		}else{
			echo "<script>alert('Ganti password gagal !');</script>";
		}
	}else{
		echo "<script>alert('Password tidak sama !');</script>";
	}
}

function edit($new,$old){

	if(PdoQuery("UPDATE user SET password = '".md5($new)."' WHERE password = '".md5($old)."' AND username = '".$_SESSION['username']."'")){
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
				<center><h3>Ubah Password</h3></center><br>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Password Lama"><br>
					<input class="form-control" type="password" name="password1" placeholder="Password Baru"><br>
					<input class="form-control" type="password" name="password2"  placeholder="Konfirmasi Password Baru">
				</div>
				<button type="submit" name="data" class="btn btn-primary" style="width:49%; margin-bottom: 50px; float: left">Simpan</button>
			</form>
				<a href="../"><button class="btn btn-danger" style="width:49%; margin-bottom: 50px;float: right">Batal</button></a>
		</div>
	</body>
</html>