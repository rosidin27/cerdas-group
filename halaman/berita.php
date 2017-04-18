<?php 
    $per_hal = 5;
    $page = 1;
    if(isset($_GET['hal'])){
        $page = filter((int)$_GET['hal']);   
    }
    $start = ($page * $per_hal) - ($per_hal);
    if($start < 0){
        $start = 0;
    }
    $hingga = ($start + ($per_hal));

    if(isset($_GET['kategori'])){
        $kategori = "AND b.id_kategori = '".filter($_GET['kategori'])."'";
    }else{
        $kategori = "";
    }
    $sql = "SELECT 
                a.id_berita,
                a.id_kategori, 
                a.judul, 
                b.kategori, 
                a.keyword, 
                a.isi, 
                a.gambar, 
                a.username, 
                a.tanggal 
            FROM berita a, kategori b 
            WHERE a.id_kategori = b.id_kategori ".$kategori."
            ORDER BY id_berita 
            DESC LIMIT ".$per_hal." OFFSET ".$start."";
    $jmlData = JumlahData("SELECT 
                a.id_berita,
                a.id_kategori, 
                a.judul, 
                b.kategori, 
                a.keyword, 
                a.isi, 
                a.gambar, 
                a.username, 
                a.tanggal 
            FROM berita a, kategori b 
            WHERE a.id_kategori = b.id_kategori ".$kategori."
            ORDER BY id_berita 
            DESC");
    $cek = JumlahData($sql);
    $list = PdoQuery($sql);
    $jml_hal = ceil($jmlData / $per_hal);
    if($cek <= 0){
        echo "<script>alert('Not Found !'); window.location='?page=berita'</script>";
        exit();
    }

    $query = $list; 
    $berita = array();
    $i = 0;
    while($data = $query->fetch(PDO::FETCH_ASSOC)){
        if(strlen($data['isi']) > 300){
            $berita[$i]['isi'] = substr($data['isi'], 0, 500)."...<a href='?page=berita&id=$data[id_berita]'>[Selengkapnya]</a>";
        }else{
            $berita[$i]['isi'] = $data['isi']."...<a href='?page=berita&id=$data[id_berita]'>[Selengkapnya]</a>";
        }
        $berita[$i]['judul'] = $data['judul'];
        $berita[$i]['username'] = $data['username'];
        $berita[$i]['tanggal'] = $data['tanggal'];
        $berita[$i]['gambar'] = $data['gambar'];
        $i++;
    }
    if($i > 0){
        $bg = "img/berita/".$berita[0]['gambar'];
    }else{
        $bg = "assets/images/desert.jpg";
    }
?>
<section class="engine"><a rel="external" href="https://mobirise.com">Mobirise</a></section><section class="mbr-section article mbr-parallax-background mbr-after-navbar" id="msg-box8-7" style="background-image: url(<?php echo $bg; ?>); padding-top: 120px; padding-bottom: 120px;">

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
            <div class="col-md-10 col-sm-12 lead" style="margin-bottom: 50px;border-right: 1px solid #d2d2d2;">
                <?php for($i=0; $i<count($berita); $i++){ ?>
                <div class="col-md-12 col-sm-12 lead" style="margin-bottom: 50px;">
                <h3 style="text-align: left; margin-bottom: 5px;"><strong><?php echo $berita[$i]['judul']; ?></strong></h3>
                <small class="mbr-section-subtitle" style="text-align: left;">Posted by <?php echo $berita[$i]['username']." ".$berita[$i]['tanggal']?></small>
                <img class="col-xs-4" style="padding-left: 0px;" src="<?php echo "img/berita/".$berita[$i]['gambar'];?>">
                <p><?php echo $berita[$i]['isi']; ?></p>
                </div>
            <?php }

            $queryKat = getKategori();
            ?>
            </div>
            <div class="col-md-2 col-sm-12">
                <h3><strong>Kategori</strong></h3>
                <ul>
                    <?php while ($kat = $queryKat->fetch(PDO::FETCH_ASSOC)) { 
                            echo "<li><a href='?page=berita&kategori=$kat[id_kategori]'>$kat[kategori]</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php 
if(isset($_GET['hal'])){
    if($_GET['hal'] > 1){
       $prev = $_GET['hal']-1;
    }else{
        $prev = 1;
    }
    $next = $_GET['hal']+1;
}else{
    $next = 2;
    $prev = 1;
}
?>
<section class="mbr-section article mbr-section__container" id="content1-9" style="background-color: rgb(255, 255, 255); padding-top: 0px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-10 lead">
                <?php if(isset($_GET['hal']) && $_GET['hal'] >= $jml_hal){ ?>
                <a href="?page=berita&hal=<?php echo $prev; ?>" style="color: white">
                    <button class="btn btn-primary" style="margin-left: 20px;"><- Sebelumnya</button>
                </a>
                <?php } ?>
                <?php if((isset($_GET['hal']) && $jml_hal > $_GET['hal']) || !isset($_GET['hal'])){ ?>
                <a href="?page=berita&hal=<?php echo $next; ?>" style="color: white">
                    <button class="btn btn-primary" style="float: right">Selanjutnya -></button>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>


<?php 

    


?>