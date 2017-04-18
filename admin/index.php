<?php
    include "../config/koneksi.php";
    @session_start();
    if(!isset($_SESSION['username'])){
        echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "include/header.php"; ?>
</head>
<body>
	<div id="wrapper">
	<?php 
		include "include/navigation.php";
		if(isset($_GET['data'])){
			switch ($_GET['data']) {
				case 'berita':
					if(cekPublisher() || cekAdmin()){
						include "data-berita/redirect-berita.php"; 
						break;
					}else{
						back();
					}
				case 'profil':
					if(cekAdmin()){
	                    include "data-profil/profil.php";
	                    break;
	                }else{
	                	back();
	                }
                case 'galeri':
                	if(cekAdmin()){
	                    include "data-galeri/galeri-redirect.php";
	                    break;
	                }else{
	                	back();
	                }
                case 'kontak':
                	if(cekAdmin()){
	                    include "data-kontak/kontak.php";
	                    break;
	                }else{
	                	back();
	                }
                case 'user':
                	if(cekPublisher() || cekAdmin()){
	                    include "data-user/user.php";
	                    break;
                	}else{
                		back();
                	}
                case 'custom':
                	if(cekAdmin()){
	                    include "data-custom/custom.php";
	                    break;
	                }else{
	                	back();
	                }
                case 'client':
                	if(cekAdmin()){
	                    include "data-client/client.php";
	                    break;
	                }else{
	                	back();
	                }
                case 'pelayanan':
                	if(cekAdmin()){
	                    include "data-pelayanan/pelayanan.php";
	                    break;
	                }else{
	                	back();
	                }
                case 'kategori':
                	if(cekAdmin()){
	                    include "data-kategori/data-kategori.php";
	                    break;
	                }else{
	                	back();
	                }
				default:
					if(cekPublisher() || cekAdmin()){
						include "data-berita/redirect-berita.php";
						break;
					}else{
						back();
					}
			}
		}
		else{
			if(cekPublisher() || cekAdmin()){
				include "data-berita/redirect-berita.php";
			}else{
				back();
			}
		}
	    //include "../include/footer.php";
	?>
	</div>

<script src="js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin Tiny MCE -->
<script src="../assets/tinymce/jquery.tinymce.min.js"></script>
<script src="../assets/tinymce/tinymce.min.js"></script>
<?php
	if(isset($_GET['data'])){
		if($_GET['data']!="custom"){ ?>
			<script>tinymce.init({ selector:'textarea' });</script>
		<?php }
	} 
?>
<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="js/agency.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $('#data').DataTable();
    } );
</script>
<?php
	function cekAdmin(){
		if($_SESSION['level']=="admin"){
			return true;
		}else{
			return false;
		}
	}
	
	function cekPublisher(){
		if($_SESSION['level']=="publisher"){
			return true;
		}else{
			return false;
		}
	}

	function back(){
		echo "<meta http-equiv='refresh' content='0,../'>";
		exit();
	}
?>



  