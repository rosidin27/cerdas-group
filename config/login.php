<?php
	@session_start();
	if(isset($_SESSION['username'])){
		echo "<meta http-equiv='refresh' content='0,admin'>";
		exit();
	}else{
		if(isset($_POST['username']) && isset($_POST['password'])){
			$sql = "SELECT *FROM user WHERE username='".mysql_real_escape_string($_POST['username'])."' AND password='".mysql_real_escape_string(md5($_POST['password']))."'";
			$cek = JumlahData($sql);
			$data= PdoSelect($sql);
			if($cek > 0){
				$_SESSION['username'] = $data['username'];
				$_SESSION['level'] = $data['level'];
				$_SESSION['nama'] = $data['nama'];

				echo "<meta http-equiv='refresh' content='0,admin'>";
				exit();
			}else{
				login(1);
			}
		}else{
			login(0);
		}
	}

function login($error = NULL){ ?>
<div class="container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="?page=home"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></a>
				<h4 class="modal-title">Login</h4>
			</div>
			<form action="" method="POST" role="form">
				<div class="modal-body">
					<center><h3><strong><?php if($error==1) echo "Filed !"; ?></strong></h3></center>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Username"><br>
						<input type="password" class="form-control" name="password" placeholder="Password">
					</div>
				</div>
				<div class="modal-footer" style="margin-top: 0px;">
					<button type="reset" class="btn btn-default" style="margin-bottom: 0px;">Clear</button>
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } 
?>