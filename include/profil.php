<?php
	$profil = getProfil();
	if(strlen($profil['detail_profil']) > 1100){
		$des_profil = substr($profil['detail_profil'], 0,1100)."...<a href='?page=profil#d_profil'>[Selengkapnya]</a>"; 
	}else{
		$des_profil = $profil['detail_profil'];
	}
?>

<!-- What is -->
<div id="profil" class="content-section-b" style="border-top: 0; padding-top: 30px; padding-bottom: 80px;">
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
			<img class="col-xs-12 col-lg-5 card-img" src="<?php echo "img/profil/".$profil['foto_profil']; ?>" style="padding-right: 10px; padding-left: 0px;">
				<?php echo $des_profil; ?>
			<!-- <p><button class="btn btn-info" style="float: right;">Selengkapnya</button></p> -->
		</div><!-- /.row -->
	</div>
</div>

<!-- Use it -->
<div id ="visi" class="content-section-a" style="background: #f8f8f8; padding-top: 80px; padding-bottom: 80px;">
    <div class="container">
        <div class="row">
			<div class="col-xs-12 col-lg-6 pull-right wow fadeInRightBig">
                <img class="fit-view card-img" src="<?php echo "img/profil/".$profil['foto_visi']; ?>" alt="">
            </div>
	
            <div class="col-xs-12 col-lg-6 wow fadeInLeftBig"  data-animation-delay="200">   
                <h3 class="mbr-section-title display-2">Visi</h3>
				<small class="mbr-section-subtitle">Visi kami dalam mewujudkan cita-cita perusahaan ini yaitu: </small>
                <p class="lead">
					<?php echo $profil['visi']; ?>
				</p>
			</div>   
        </div>
    </div>
    <!-- /.container -->
</div>

<div id="misi" class="content-section-b" style=" padding-top: 80px; padding-bottom: 80px;"> 
	
	<div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-6 wow fadeInRightBig"  data-animation-delay="200">   
                <h3 class="mbr-section-title display-2">Misi</h3>
				<small class="mbr-section-subtitle">Misi kami dalam mewujudkan cita-cita perusahaan ini yaitu: </small>
                <p class="lead">
					<?php echo $profil['misi']; ?>
				</p>
			</div>  			
            <div class="col-xs-12 col-lg-6 pull-left wow fadeInRightBig">
                <img class="fit-view card-img" src="<?php echo "img/profil/".$profil['foto_visi']; ?>" alt="">
            </div>
			
		</div>
    </div>
</div>
<?php
	function getProfil(){
		$sql_profil = "SELECT *FROM profil ORDER BY id_profil DESC LIMIT 1";
		$profil = PdoSelect($sql_profil);

		return $profil;
	}

?>