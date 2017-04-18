<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}

$title = "Tambah Data Profil";

$target_file = array('','','');

for($i=0;$i<count($target_file);$i++){
	if(isset($_FILES['foto'.$i])){
		$target_file[$i] = upload($target_file, $i);
	}
}

function upload($target_file, $i){
    $file_name = basename( $_FILES["foto".$i]["name"]);
    $target_dir = "../img/galeri/profil/";
    $uploadOk = 1;
    
    // Check if image file is a actual image or fake image
    if(!empty($_FILES['foto'.$i]['name'])) {

        $target_file[$i] = $target_dir . basename($_FILES["foto".$i]["name"]);
        $extention = array ('jpg','png','jpeg','bmp','gif');
        $imageFileType = pathinfo($target_file[$i],PATHINFO_EXTENSION);
        $getExtensi = strtolower(end(explode('.', $_FILES['foto'.$i]['name'])));
        
        $check = getimagesize($_FILES["foto".$i]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Gambar Tidak Valid !</div>";
            echo "<meta http-equiv='refresh' content='2,'/>";
            $uploadOk = 0;
            exit();
        }
        
        // Check file size
        if ($_FILES["foto".$i]["size"] > 16000000) {
            echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Ukuran Gambar Maksimal 15Mb !</div>";
            echo "<meta http-equiv='refresh' content='2,'/>";
            $uploadOk = 0;
            exit();
        }
        // Allow certain file formats
        if(!in_array($getExtensi, $extention)){
            echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Hanya Menerima Ekstensi JPG, JPEG, PNG dan GIF !</div>";
            echo "<meta http-equiv='refresh' content='2,'/>";
            $uploadOk = 0;
            exit();
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Unggah Gambar Gagal !</div>";
            echo "<meta http-equiv='refresh' content='2,'/>";
            exit();

        // if everything is ok, try to upload file
        } else {
        	$target_file[$i] = md5(microtime()) . ".$getExtensi";
            if (move_uploaded_file($_FILES["foto".$i]["tmp_name"], $target_dir . $target_file[$i])) {
                //Input atau Edit
            } else {
                echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Terjadi Kesalahan Saat Unggah Gambar !</div>";
                echo "<meta http-equiv='refresh' content='2,'/>";
                exit();
            }
        }
    }else{
        /*if(isset($_POST['input'])){
            echo "<div class='alert alert-danger' style='margin-left:5px;margin-right:5px;margin-top:75px;margin-bottom:0px'>&nbsp <strong>Failed !</strong> Harap Pilih Gambar !</div>";
            echo "<meta http-equiv='refresh' content='2,'/>";
            exit();
        }*/
    }
    return $target_file[$i];
}

if(isset($_GET['data'])){
	if($_GET['data'] == "profil" && $_GET['aksi'] == "tambah"){
		$title = "Tambah Data Profil";
	}
	elseif($_GET['data'] == "profil" && $_GET['aksi'] == "edit"){
		$title = "Edit Data Profil";
		$d_profil = PdoSelect("SELECT *FROM profil ORDER BY id_profil DESC");	
	}else{
		redirect(0,"../");
	}
}else{
	redirect(0,"../");
}

if(isset($_POST['data'])){
	$profil = filter($_POST['profil']);
	$visi = filter($_POST['visi']);
	$misi = filter($_POST['misi']);
	$foto_profil = filter($target_file[0]);
	$foto_visi = filter($target_file[1]);
	$foto_misi = filter($target_file[2]);

	$data_field = array(
		'profil'=>$profil,
		'visi'=>$visi,
		'misi'=>$misi,
		'foto_profil'=>$foto_profil,
		'foto_visi'=>$foto_visi,
		'foto_misi'=>$foto_misi
	);

	if($_GET['aksi'] == "tambah" && $_GET['data'] == "profil"){
		foreach ($data_field as $d) {
			$df[] = $d;
		}
		tambah($df);
	}
	elseif($_GET['aksi'] == "edit" && $_GET['data'] == "profil"){
		edit($data_field,$d_profil['id_profil']);
	}else{
		redirect(0,"../");
	}
}

function tambah($data_field){
	$field = array('detail_profil','visi','misi','foto');
	$data = array($data_field);

	if(PdoInput("profil",$field,$data)){
        echo "<script>alert('Data Tersimpan !'); window.location = '../'</script>";
    }else{
        echo "<script>alert('Gagal Tersimpan !'); window.location = ''</script>";
    }
}

function edit($data_field = array(), $id){

	$img_profil="";
	if(isset($data_field['foto_profil']) AND $data_field['foto_profil']!='' AND $data_field['foto_profil']!=NULL){
        $img_profil = ", foto_profil = '".$data_field['foto_profil']."'";
        $sql1 = "SELECT foto_profil FROM profil WHERE id_profil='$id' AND foto_profil <> '' ";
        $img = PdoSelect($sql1);
        if(JumlahData($sql1)>0 AND $data_field['foto_profil']!=''){
	        @unlink("../img/galeri/profil/$img[foto_profil]");    	
        }
        //echo "Profil : ".$data_field['foto_profil']."<br>";
    }

    $img_visi="";
	if(isset($data_field['foto_visi']) && $data_field['foto_visi']!='' AND $data_field['foto_visi']!=NULL){
        $img_visi = ", foto_visi = '".$data_field['foto_visi']."'";
        $sql2 = "SELECT foto_visi FROM profil WHERE id_profil='$id' AND foto_visi <> '' ";
        $img = PdoSelect($sql2);
        if(JumlahData($sql2)>0 AND $data_field['foto_visi']!=''){
	        @unlink("../img/galeri/profil/$img[foto_visi]");    	
        }
        //echo "Misi : ".$data_field['foto_misi']."<br>";
    }

    $img_misi="";
	if(isset($data_field['foto_misi']) AND $data_field['foto_misi']!='' AND $data_field['foto_misi']!=NULL){
        $img_misi = ", foto_misi = '".$data_field['foto_misi']."'";
        $sql3 = "SELECT foto_misi FROM profil WHERE id_profil='$id' AND foto_misi <> '' ";
        $img = PdoSelect($sql3);
        if(JumlahData($sql3)>0 AND $data_field['foto_misi']!=''){
	        @unlink("../img/galeri/profil/$img[foto_misi]");    	
        }
        //echo "Visi : ".$data_field['foto_visi']."<br>";
    }

	if(PdoQuery("UPDATE profil SET detail_profil = '".$data_field['profil']."', 
		visi = '".$data_field['visi']."', misi = '".$data_field['misi']."' $img_profil $img_visi $img_misi WHERE id_profil='".$id."'"))
	{
		echo "<script>alert('Data Tersimpan !'); window.location = ''</script>";
    }
    else{
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
				<center><h3><?php echo $title; ?></h3></center><br>
				<div class="form-group">
					<label><h4>Profil</h4></label> 
					<!--<input class="form-control" type="text" name="judul0" placeholder="Judul">-->
					<textarea class="form-control" name="profil" style="width:100%; height:250px;"><?php if(isset($d_profil)) echo $d_profil['detail_profil']; ?></textarea>
					<p style="color:red;">Ketik "<strong><i>&lt;br&gt;</i></strong>" (tanpa tanda kutip) disetiap akhir kalimat atau kata untuk membuat baris baru.</p>
				</div>
				<!--<img src="../img/slider/1.jpg" class="col-md-12" style="padding-right: 0px; padding-left: 0px;">-->
				<div class="form-group">
					<label><h4>Visi</h4></label>
					<textarea class="form-control" name="visi" style="width:100%; height:250px;"><?php if(isset($d_profil)) echo $d_profil['visi']; ?></textarea>
					<p style="color:red;">Ketik "<strong><i>&lt;br&gt;</i></strong>" (tanpa tanda kutip) disetiap akhir kalimat atau kata untuk membuat baris baru.</p>
				</div>
				<div class="form-group">
					<label><h4>Misi</h4></label>
					<textarea class="form-control" name="misi" style="width:100%; height:250px;"><?php if(isset($d_profil)) echo $d_profil['misi']; ?></textarea>
					<p style="color:red;">Ketik "<strong><i>&lt;br&gt;</i></strong>" (tanpa tanda kutip) disetiap akhir kalimat atau kata untuk membuat baris baru.</p>
				</div>
				<div class="form-group">
					<label><h4>Gambar Profil</h4></label>
					<input type="file" name="foto0">
				</div>
				<div class="form-group">
					<label><h4>Gambar Visi</h4></label>
					<input type="file" name="foto1">
				</div>
				<div class="form-group">
					<label><h4>Gambar Misi</h4></label>
					<input type="file" name="foto2">
				</div>
				<button type="submit" name="data" class="btn btn-primary" style="width:49%; margin-bottom: 50px; float: left">Simpan</button>
			</form>
				<a href="../"><button class="btn btn-danger" style="width:49%; margin-bottom: 50px;float: right">Batal</button></a>
		</div>
	</body>
</html>