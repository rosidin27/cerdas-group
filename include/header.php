<?php 
  $web = getCustom();
  if(isset($_GET['page']) && isset($_GET['id'])){
    $meta = getMeta($_GET['id']);
    $cek = 1;
  }else{
    $cek = 0;
  }

  function getMeta($id){
    $meta = PdoSelect("SELECT *FROM berita WHERE id_berita='".$id."'");
    return $meta;
  }

  function getCustom(){
    $sql = "SELECT *FROM deskripsi_web ORDER BY id_deskripsi DESC LIMIT 1";
    $data = PdoSelect($sql);
    return $data;
  }
?>
  <title><?php if($cek == 1){echo $meta['judul']." | ";} echo $web['judul_web']; ?></title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="<?php if($cek==1)echo $meta['judul']; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php if($cek==1)echo $meta['judul']; else echo $web['judul_web']; ?>">
  <meta name="keyword" content="<?php if($cek==1)echo $meta['keyword']; else echo $web['judul_web']; ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">
  <link rel="stylesheet" href="assets/et-line-font-plugin/style.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <script language="JavaScript" src="assets/captcha/scripts/gen_validatorv31.js" type="text/javascript"></script>  

  <style type="text/css">
    .fit-view{
      width: 100%;
      min-height: 220px;
      height: auto;
      object-fit: cover;
      background-position: center center;
      background-repeat: no-repeat;
      overflow: hidden;
    }
  </style>
