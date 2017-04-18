<?php include "config/koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <?php include "include/header.php"; ?>
</head>
<body>
<?php 
	if(isset($_GET['page'])){
		include "include/navigation.php";
		switch ($_GET['page']) {
			case 'home':
				include "include/slider.php"; 
	   			include "include/profil.php";
	   			include "include/berita.php";
				break;
			case 'profil':
				include "include/slider.php"; 
	   			include "halaman/detail_profil.php";
	   			break;
			case 'berita':
				if(isset($_GET['id'])){
					include "halaman/detail_berita.php";					
				}else{
					include "halaman/berita.php";
				}
				break;
			default:
				include "include/slider.php"; 
	   			include "include/profil.php";
	   			include "include/berita.php";
				break;
		} 
	}elseif(isset($_GET['cmd'])){
		switch ($_GET['cmd']) {
			case 'login':
				include "config/login.php";
				exit();
				break;
			case 'logout':
				include "config/logout.php";
				exit();
				break;
			default:
				include "include/slider.php"; 
				include "include/profil.php";
			   	include "include/berita.php";
				break;
		}
	}
	else{
		include "include/navigation.php";
		include "include/slider.php"; 
		include "include/profil.php";
	   	include "include/berita.php";
	}
    include "include/footer.php"; 
    include "include/js.php"; 
?>
</body>
</html>