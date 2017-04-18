<?php $queryBerita = getBerita(); ?>
<section class="mbr-cards mbr-section mbr-section-nopadding" id="berita" style="background-color: rgb(255, 255, 255);">
<section class="mbr-section mbr-section__container article" id="header3-8" style="background: #f8f8f8; padding-top: 50px; padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2">Berita Terbaru</h3>
                <small class="mbr-section-subtitle">Berita yang dikemas berdasarkan fakta.</small>
            </div>
        </div>
    </div>
</section>
    <div class="mbr-cards-row row">
        <?php while($berita = $queryBerita->fetch(PDO::FETCH_ASSOC)){
        $desc = "";
        if(strlen($berita['isi']) > 100){
            $desc = substr($berita['isi'], 0,250)."...";
        }else{
            $desc = $berita['isi'];
        }
        ?>
        <div class="mbr-cards-col col-xs-12 col-lg-3" style="padding-top: 30px; padding-bottom: 50px;">
            <div class="container">
              <div class="card cart-block" style="text-align: justify;">
                  <div class="card-img"><img class="card-img fit-view" src="img/berita/<?php echo $berita['gambar']; ?>" class="card-img-top"></div>
                  <div class="card-block">
                    <h4 class="card-title"><?php echo $berita['judul']; ?></h4>
                    <h5 class="card-subtitle"><?php echo "Posted by ".$berita['username']." ".$berita['tanggal']; ?></h5>
                    <p class="card-text"><?php echo $desc; ?><a href="?page=berita&id=<?php echo $berita['id_berita']; ?>" > [Selengkapnya]</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <center><h2><a href="?page=berita" class="btn btn-primary" style="width: 200px;">MORE</a></h2></center>
</section>

<?php 
function getBerita(){
    $sql = "SELECT *FROM berita ORDER BY id_berita DESC LIMIT 4";
    $query = PdoQuery($sql);

    return $query;
}
?>