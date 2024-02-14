<div class="row">
    <div class="sidebar-form col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php get_search_form(); ?>
    </div>
    <div class="sidebar-widgets col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php
            //Aqui pondremos el nombre que le dimos al sidebar al crearlo
             dynamic_sidebar('sidebar_blog'); 
        ?>
    </div>
</div>


    