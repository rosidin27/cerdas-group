<?php $tmpSilder = getSlider("result") ?>
<section class="engine"><a rel="external" href="https://mobirise.com">Website Generator</a></section><section class="mbr-slider mbr-section mbr-section__container carousel slide mbr-section-nopadding mbr-after-navbar" data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false" data-interval="5000" id="slider-0">
    <div>
        <div>
            <div>
                <ol class="carousel-indicators">
                    <li data-app-prevent-settings="" data-target="#slider-0" class="active" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#slider-0" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#slider-0" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $j = JumlahData(getSlider("query")); $i=0; 
                     while($slider = $tmpSilder->fetch(PDO::FETCH_ASSOC)){ ?>
                    <div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full <?php if($i==$j-1) echo "active"; ?>" data-bg-video-slide="false" style="background-image: url(<?php echo "img/galeri/".$slider['foto']; ?>);">
                        <div class="mbr-table-cell">
                            <div class="mbr-overlay"></div>
                            <div class="container-slide container">
                                
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2 text-xs-center">
                                        <h4 class="mbr-section-title display-4" style="
                                            font-size: 50px;
                                            font-family: arvo;
                                            font-weight: 300;
                                            letter-spacing: 6px;"
                                        >
                                        <?php echo $slider['keterangan']; ?></h4>
                                        <!-- <p class="mbr-section-lead lead">Choose from the large selection of latest pre-made blocks - jumbotrons, hero images, parallax scrolling, video backgrounds, hamburger menu, sticky header and more.</p>

                                        <div class="mbr-section-btn"><a class="btn btn-lg btn-success" href="https://mobirise.com">FOR WINDOWS</a> <a class="btn btn-lg btn-white btn-white-outline" href="https://mobirise.com">FOR MAC</a></div> -->
                                    </div>
                                </div>
                                <div class="mbr-section-btn" style="padding-top: 50px; text-align: center;">
                                    <a href="#profil">
                                        <img src="img/circle.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; } ?>
                </div>
                <a data-app-prevent-settings="" class="left carousel-control" role="button" data-slide="prev" href="#slider-0">
                    <span class="icon-prev" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a data-app-prevent-settings="" class="right carousel-control" role="button" data-slide="next" href="#slider-0">
                    <span class="icon-next" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php
    function getSlider($type){
        $sql_slider = "SELECT foto, keterangan FROM galeri WHERE slider = '1' ORDER BY id_galeri DESC";
        $slider = PdoQuery($sql_slider);
        if($type == "result"){
            return $slider;
        }elseif($type == "query"){
            return $sql_slider;
        }
    }
?>