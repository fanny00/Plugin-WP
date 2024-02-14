<div id="carouselExampleIndicators" class="carousel slide slide-movile" data-ride="carousel">
                <?php

                    
                        $slide1 = ATR_DIR_URI . '/public/img/slide/slide-2-1.jpg';
                        $slide2 = ATR_DIR_URI . '/public/img/slide/slide-2-2.jpg';
                        $slide3 = ATR_DIR_URI . '/public/img/slide/slide-2-3.jpg';

                ?>
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100 w-100-slide" src="<?php echo $slide1; ?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100 w-100-slide" src="<?php echo $slide2; ?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100 w-100-slide" src="<?php echo $slide3; ?>" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!--/carrousel-->