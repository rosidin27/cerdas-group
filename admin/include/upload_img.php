<?php

function img($array = array()){
    $target_file = $array;

    for($i=0;$i<count($target_file);$i++){
    	if(isset($_FILES['foto'.$i])){
    		$target_file[$i] = upload($target_file, $i);
    	}
    }
    return $target_file;
}

function upload($target_file, $i){
    $file_name = basename( $_FILES["foto".$i]["name"]);
    $target_dir = "../img/berita/";
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
?>