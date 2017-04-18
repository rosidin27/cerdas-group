<?php $qKat = getKategori(); ?>
<section id="menu-0">
    <nav class="navbar navbar-dropdown bg-color transparent navbar-fixed-top">
        <div class="container">
            <div class="mbr-table">
                <div class="mbr-table-cell">
                    <div class="navbar-brand">
                        <a class="navbar-caption" href="<?php echo $BASE_URL; ?>" style="font-size: 20px;
                                            font-family: arvo;
                                            font-weight: 300;
                                            letter-spacing: 3px;"><?php echo $web['judul_web']; ?></a>
                    </div>
                </div>
                <div class="mbr-table-cell">
                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>
                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                        <li class="nav-item">
                            <a class="nav-link link" href="?data=home">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?php echo $BASE_URL; ?>#profil">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?php echo $BASE_URL; ?>#visi">Visi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?php echo $BASE_URL; ?>#misi">Misi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?php echo $BASE_URL; ?>#berita">Berita</a>
                        </li>
                        <!-- <li class="nav-item dropdown open">
                            <a class="nav-link link dropdown-toggle" data-toggle="dropdown-submenu" href="https://mobirise.com/" aria-expanded="true">Artikel</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo $BASE_URL; ?>#berita">Berita</a>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle" data-toggle="dropdown-submenu" href="https://mobirise.com/">Kategori</a>
                                    <div class="dropdown-menu dropdown-submenu">
                                        <?php while($kategori = $qKat->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <a class="dropdown-item" href="?page=berita&kategori=<?php echo $kategori['id_kategori']; ?>">
                                            <?php echo $kategori['kategori']; ?>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link link" href="<?php echo $BASE_URL; ?>#social-buttons4-c">Kontak</a>
                        </li>
                    </ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</section>
<?php 
function getKategori(){
    $sql = "SELECT DISTINCT(a.id_kategori), b.kategori FROM berita a, kategori b WHERE a.id_kategori = b.id_kategori";
    $query = PdoQuery($sql);

    return $query;
}
?>