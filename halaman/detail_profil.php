<?php
	$profil = getProfil();
	$des_profil = $profil['detail_profil'];
?>

<!-- What is -->
<div id="d_profil" class="content-section-b" style="border-top: 0; padding-top: 30px; padding-bottom: 80px;">
	<div class="container">
		<center>
		<div class="col-md-12 col-md-offset-3 text-center wrap_title" style="margin-left:0px;">
			<section class="mbr-section mbr-section__container article" id="header3-8" style="background-color: rgb(255, 255, 255); padding-top: 50px; padding-bottom: 20px;">
			    <div class="container">
			        <div class="row">
			            <div class="col-xs-12">
			                <h3 class="mbr-section-title display-2">Profil</h3>
			                <small class="mbr-section-subtitle">Sejarah berdirinya perusahaan</small>
			            </div>
			        </div>
			    </div>
			</section>
		</div>
		</center>
		<div class="row lead">
				<?php echo $des_profil; ?>
			<img class="col-xs-12 col-lg-12 card-img" src="<?php echo "img/profil/".$profil['foto_profil']; ?>" style="padding-right: 10px; padding-left: 0px;">
			<!-- <p><button class="btn btn-info" style="float: right;">Selengkapnya</button></p> -->
		</div><!-- /.row -->
	</div>
</div>

<?php
	function getProfil(){
		$sql_profil = "SELECT *FROM profil ORDER BY id_profil DESC LIMIT 1";
		$profil = PdoSelect($sql_profil);

		return $profil;
	}

?>