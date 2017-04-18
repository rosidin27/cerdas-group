<?php 
  $web = getCustom();
  
  function getCustom(){
    $sql = "SELECT *FROM deskripsi_web ORDER BY id_deskripsi DESC LIMIT 1";
    $data = PdoSelect($sql);
    return $data;
  }
?>
<title><?php echo $web['judul_web']; ?></title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
<meta name="description" content="">

<!-- Bootstrap Core CSS -->
<link href="css/jquery.dataTables.min.css" rel="stylesheet">
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

<!-- Theme CSS -->
<link href="css/agency.min.css" rel="stylesheet">
  <style type="text/css">
    .fit-view{
      width: 320px;
      height: 200px;
      object-fit: cover;
      background-position: center center;
      background-repeat: no-repeat;
      overflow: hidden;
    }
  </style>