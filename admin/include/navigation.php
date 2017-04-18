<nav id="mainNav" class="navbar navbar-default  navbar-fixed-top">
	<div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="../"><?php echo $web['judul_web']; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right"><?php
                if($_SESSION['level']=="admin") {
                    admin();
                }elseif ($_SESSION['level']=="publisher") {
                    publisher();
                }else{
                    echo "<meta http-equiv='refresh' content='0,../'>";
                }
            ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!-- Navigation -->

<?php
function admin(){ ?>
    <li class="hidden">
        <a href="#page-top"></a>
    </li>
    <li>
        <a class="page-scroll" href="../?data=home">Beranda</a>
    </li>
    <li>
        <a class="page-scroll" href="?data=profil&aksi=edit">Profil</a>
    </li>
    <li>
        <a class="page-scroll" href="?data=galeri">Galeri</a>
    </li>
    <li class="dropdown">
        <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;">Artikel<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="?data=berita" style="color: #555">Berita</a></li>
            <li><a href="?data=kategori" style="color: #555">Kategori</a></li>
        </ul>
    </li>
    <li>
        <a class="page-scroll" href="?data=kontak">Kontak</a>
    </li>
    <li class="dropdown">
        <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;"><?php echo $_SESSION['nama']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="?data=custom" style="color: #555">Custom Web</a></li>
            <li><a href="?data=user" style="color: #555">Ganti Password</a></li>
            <li><a href="../?cmd=logout" style="color: #555">Logout</a></li>
        </ul>
    </li>
<?php
}

function publisher(){ ?>
    <li class="hidden">
        <a href="#page-top"></a>
    </li>
    <li>
        <a class="page-scroll" href="../?data=home">Beranda</a>
    </li>
    <li>
        <a class="page-scroll" href="?data=berita">Berita</a>
    </li>
    <li class="dropdown">
        <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;"><?php echo $_SESSION['nama']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="?data=user" style="color: #555">Ganti Password</a></li>
            <li><a href="../?cmd=logout" style="color: #555">Logout</a></li>
        </ul>
    </li>

<?php
}
?>