<?php 
$berita = getBerita(filter($_GET['id']));
$queryBerita = getMore($berita['id_kategori']);
?>
<section class="engine"><a rel="external" href="https://mobirise.com">Mobirise</a></section><section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-7" style="background-image: url(<?php echo "img/berita/".$berita['gambar']; ?>); padding-top: 120px; padding-bottom: 120px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2">BERITA TERKINI</h3>
                <div class="lead"><p>Informasi berita yang dikemas berdasarkan fakta. </p></div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section mbr-section__container article" id="header3-8" style="background-color: rgb(255, 255, 255); padding-top: 30px; padding-bottom: 20px; padding-left: 15px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-10">
                <h3 class="mbr-section-title display-2" style="text-align: left;"><?php echo $berita['judul']; ?></h3>
                <small class="mbr-section-subtitle" style="text-align: left;"><?php echo "Kategori <a href='#'>$berita[kategori]</a>  | Posted by  $berita[username] $berita[tanggal]" ?></small>
            </div>
        </div>
    </div>
</section>

<?php $queryKat = getKategori(); ?>
<section class="mbr-section article mbr-section__container" id="content1-9" style="background-color: rgb(255, 255, 255); padding-top: 0px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-10 lead" style="border-right: 1px solid #d2d2d2;"><img class="col-xs-6" src="<?php echo "img/berita/".$berita['gambar'];?>"><p><?php echo $berita['isi']; ?></p>
                <div class="mbr-social-likes" data-counters="false" style="margin-top: 20px;">
                    <strong>Share this page : </strong>
                    <span class="btn btn-social facebook" title="Share link on Facebook">
                        <i class="socicon socicon-facebook"></i>
                    </span>
                    <span class="btn btn-social twitter" title="Share link on Twitter">
                        <i class="socicon socicon-twitter"></i>
                    </span>
                    <span class="btn btn-social plusone" title="Share link on Google+">
                        <i class="socicon socicon-googleplus"></i>
                    </span>
                </div>
            </div>
            <div class="col-xs-12 col-lg-2">
                <h3><strong>Kategori</strong></h3>
                <ul>
                    <?php while ($kat = $queryKat->fetch(PDO::FETCH_ASSOC)) { 
                            echo "<li><a href='?page=berita&kategori=$kat[id_kategori]'>$kat[kategori]</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="row mbr-cards mbr-section mbr-section-nopadding" style="margin-top: 80px;">
            <div class="mbr-cards-row row">
            <div class="col-xs-10 lead">
            <h3>Baca berita lainnya :</h3>
                <?php while($berita = $queryBerita->fetch(PDO::FETCH_ASSOC)){
                $desc = "";
                if(strlen($berita['isi']) > 100){
                    $desc = substr($berita['isi'], 0, 250)."...";
                }else{
                    $desc = $berita['isi'];
                }
                ?>
                <div class="mbr-cards-col col-xs-10 col-lg-3" style="padding-top: 0px; padding-bottom: 0px;">
                    <div class="container">
                      <div class="card cart-block"  style="text-align: justify;">
                          <div class="card-img"><img class="card-img fit-view" src="img/berita/<?php echo $berita['gambar']; ?>" class="card-img-top"></div>
                          <div class="card-block">
                            <h4 class="card-title"><?php echo $berita['judul']; ?></h4>
                            <h5 class="card-subtitle">
                                <?php echo "Posted by $berita[username] $berita[tanggal]"; ?>
                            </h5>
                            <p class="card-text"><?php echo $desc; ?><a href="?page=berita&id=<?php echo $berita['id_berita']; ?>"> [Selengkapnya]</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            </div>
        </div>
    </div>

</section>

<?php 
function getMore($kategori){
    $sql = "SELECT *FROM berita WHERE id_kategori='".$kategori."' ORDER BY id_berita DESC LIMIT 3";
    $jml = JumlahData($sql);
    if($jml < 3){
        $sql = "SELECT *FROM berita ORDER BY id_berita DESC LIMIT 3";
    }
    $query = PdoQuery($sql);

    return $query;
}
?>
<?php 
function getBerita($id){
    $sql = "SELECT a.id_kategori, a.judul, b.kategori, a.keyword, a.isi, a.gambar, a.username, a.tanggal FROM berita a, kategori b WHERE a.id_kategori = b.id_kategori AND id_berita='".$id."'";
    
    $cek = JumlahData($sql);
    $data = PdoSelect($sql);

    if($cek > 0){
        PdoQuery("UPDATE berita SET viewers=viewers+1 WHERE id_berita='".$id."'");
        return $data;
    }else{
        echo "<script>alert('Not Found !'); window.location='?page=berita'</script>";
        exit();
    }
}

?>