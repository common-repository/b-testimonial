<style>
    <?php echo $class; ?> {
        background : <?php echo $this->get_option($sid, 'bts_bg_color_one', 'transparent') ?>
    }
    <?php echo $class; ?> .item h3 {
        color: <?php echo $this->get_option($sid, 'bts_name_color_one', '#3a3a3a') ?>;
    }
    <?php echo $class; ?> .item h4 {
        color: <?php echo $this->get_option($sid, 'bts_designation_color_one', '#3a3a3a') ?>;
    }
    <?php echo $class; ?> .item .description p{
        color: <?php echo $this->get_option($sid, 'bts_content_color_one', '#3a3a3a') ?>;
    }
    <?php echo $class; ?> .item .description p a {
        color: <?php echo $this->get_option($sid, 'bts_readmore_color_one', '#0274be') ?>;
    }
</style>
<div class="owl-carousel owl-theme carousel<?php echo $id; ?> show_all_less <?php echo $nav_position; ?> bts<?php echo $sid ?>" id="bts1">
    <?php while($query->have_posts()): $query->the_post(); ?>
    <?php $id = get_the_ID(); ?>
    <div class="item">
        <img src="<?php echo $this->get_testimonial($id, 'bts_image', '', $picture) ?>" alt="">
        <h3><?php echo $this->get_testimonial($id, 'bts_name', '', $name) ?></h3>
        <h4><?php echo $this->get_testimonial($id, 'bts_designation', '', $designation) ?></h4>
        <div class="description">
            <p class="show_all"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content),1000); ?><a href="#" class="bts3-show-less" data-id="129"><?php echo $read_less; ?></a></p>

            <p class="show_less"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content), $char, $read_more, 'class="bts3-show-all" data-id="'.$id.'"'); ?></p>
        </div>
    </div>    
<?php endwhile; wp_reset_postdata(); ?>
</div>
