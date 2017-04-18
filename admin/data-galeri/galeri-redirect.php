<?php
	@session_start();
	if(!isset($_SESSION['username'])){
	    echo "<meta http-equiv='refresh' content='0,../?cmd=login'>";
	    exit();
	}

	if(!isset($_GET['aksi'])){
		control('view');
	}else{
		control($_GET['aksi']);
	}

	function control($action){
		switch ($action) {
			case 'view':
				include "galeri.php";
				break;
			case 'edit':
				# code...
				break;
			default:
				include "galeri.php";
				break;
		}
	}
?>