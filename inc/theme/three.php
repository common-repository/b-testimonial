<style>
    <?php echo $class; ?> .item .bts3-top-background {
        background : <?php echo $this->get_option($sid, 'bts_topbox_bg_color_three', '#E3057B') ?> !important;
    }
    <?php echo $class; ?> .item {
        background : <?php echo $this->get_option($sid, 'bts_bg_color_three', 'transparent') ?> !important;
    }
    <?php echo $class; ?> .item h3 {
        color: <?php echo $this->get_option($sid, 'bts_name_color_three', '#3a3a3a') ?>;
    }
    <?php echo $class; ?> .item h4 {
        color: <?php echo $this->get_option($sid, 'bts_designation_color_three', '#3a3a3a') ?> !important;
    }
    <?php echo $class; ?> .item .description p{
        color: <?php echo $this->get_option($sid, 'bts_content_color_three', '#3a3a3a') ?> !important;
    }
    <?php echo $class; ?> .item .description p a {
        color: <?php echo $this->get_option($sid, 'bts_readmore_color_three', '#0274be') ?>;
        display: block;
    }
</style>
<div class="owl-carousel owl-theme carousel<?php echo $id; ?> <?php echo $nav_position; ?> bts<?php echo $sid; ?>" id="bts3">
    <?php while($query->have_posts()): $query->the_post(); ?>
    <?php $id = get_the_ID(); $star = $this->get_testimonial($id, 'bts_ratting', null, $rating); ?>

    <div class="item">
        <div class="bts3-top-background"></div>
        <div class="client-image">
            <img src="<?php echo $this->get_testimonial($id, 'bts_image', '', $picture) ?>" alt="">
        </div>
        <div class="client-info">
            <h3><?php echo $this->get_testimonial($id, 'bts_name', '', $name) ?></h3>
            <div class="testimonial-rating">
                <ul class="d-flex">
                    <?php for($i = 0; $i < $star; $i++){
                        echo '<li><span class="gs-Star-Solid"><svg class="icon"><use xlink:href="#star"></use></svg></span></li>';
                    } ?>
                </ul>
            </div>
            <h4><?php echo $this->get_testimonial($id, 'bts_designation', '', $designation) ?></h4>
        </div>
        <div class="testimonial-text description">
            <p class="show_all"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content),1000); ?><a href="#" class="bts3-show-less" data-id="129"><?php echo $read_less; ?></a></p>

            <p class="show_less"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content), $char, $read_more, 'class="bts3-show-all" data-id="'.$id.'"'); ?></p>
        </div>
    </div>
       
<?php endwhile; wp_reset_postdata(); ?>
</div>
