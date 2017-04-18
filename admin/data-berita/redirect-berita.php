<?php
@session_start();
if(!isset($_SESSION['username'])){
    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
    exit();
}
if(isset($_GET['aksi'])){
	switch ($_GET['aksi']) {
		case 'list':
			include "data-berita.php";
			break;
		case 'input':
			include "input-berita.php";
			break;
		case 'edit':
			if(isset($_GET['id'])){
				include "edit-berita.php";
				break;
			}else{
				echo "<meta http-equiv='refresh' content='0,?data=berita'>";
				exit();
			}
		default:
			include "data-berita.php";
			break;
	}
}else{
	include "data-berita.php";
}

?>