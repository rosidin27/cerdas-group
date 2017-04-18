<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}

if(isset($_GET['data'])){
	if($_GET['data']=="client"){
		$sql = "SELECT *FROM client ORDER BY id_client ASC LIMIT 6";
		$tmp = PdoQuery($sql);
		$i=1;
		$data = array(array());
		while ($temp = $tmp->fetch(PDO::FETCH_ASSOC)) {
			$data[$i][0] = $temp['id_client'];
			$data[$i][1] = $temp['nama'];
			$data[$i++][2] = $temp['alamat'];
		}
	}else{
		redirect(0,"../");
	}
}else{
	redirect(0,"../");
}

if(isset($_POST['data'])){
	for ($i=1; $i <= 6 ; $i++) { 
		$data_field[$i][0] = $_POST['id'][$i];
		$data_field[$i][1] = $_POST['nama'][$i];
		$data_field[$i][2] = $_POST['alamat'][$i];
	}

	if($_GET['data'] == "client"){
		edit($data_field,$data);
	}else{
		redirect(0,"../");
	}
}

function edit($data, $matching){
	$cek = 0;
	for ($i=1; $i <= 6 ; $i++) { 
		if($data[$i][0] != $matching[$i][0]){
			if(PdoQuery("INSERT INTO client VALUES('".$data[$i][0]."','".$data[$i][1]."','".$data[$i][2]."')")){
				$cek += 1;
			}
		}else{
			if(PdoQuery("UPDATE client SET nama='".$data[$i][1]."', alamat='".$data[$i][2]."' WHERE id_client='".$data[$i][0]."'")){
				$cek += 1;
			}
		}
	}

	if($cek == 6){
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
			<center><h3>Edit Data Client</h3></center><br>
			<?php 
				for($i=1; $i<=6; $i++){ ?>
				<div class="form-group">
					<label><h4>Nama Client <?php echo $i; ?></h4></label> 
					<input type="text" name="nama[<?php echo $i; ?>]" class="form-control" value="<?php getData($data,$i,1);?>">
				</div>
				<div class="form-group">
					<label><h4>Alamat Client <?php echo $i; ?></h4></label> 
					<textarea class="form-control" name="alamat[<?php echo $i; ?>]" style="width:100%; height:120px;"><?php getData($data,$i,2);?></textarea>
				</div>
				<input type="hidden" name="id[<?php echo $i; ?>]" value="<?php getData($data,$i,0);?>">
				<br>
			<?php } ?>
			<button type="submit" name="data" class="btn btn-primary" style="width:49%; margin-bottom: 50px; float: left">Simpan</button>
		</form>
			<a href="../"><button class="btn btn-danger" style="width:49%; margin-bottom: 50px;float: right">Batal</button></a>
	</body>
</html>

<?php 
function getData($data = array(array()),$i,$j){
	if(isset($data[$i][$j])){
		echo $data[$i][$j];
	}else{
		if(!isset($data[$i][0])){
			$max = PdoSelect("SELECT MAX(id_client) FROM client");
			if($max > 0){
				echo $max+1;
			}else{
				echo 1;
			}
		}
		if(!isset($data[$i][1]) || !isset($data[$i][2])){
			echo "";
		}
	}
}
?>