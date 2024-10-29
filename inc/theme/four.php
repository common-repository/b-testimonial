<style>
<?php $class = '.bts' . $sid; ?>
    <?php echo $class; ?> .item .description {
        box-shadow: 0 7px rgba(0, 0, 0, 0.1), 0 5px <?php echo $this->get_option($sid, 'bts_boxshadow_color_four', '#e4ac01') ?> !important;
        border-bottom: 4px solid <?php echo $this->get_option($sid, 'bts_border_bottom_color_four', '#6b2014') ?> !important;
    }
    <?php echo $class; ?> .testimonial .pic {
        box-shadow: 0 7px rgba(0, 0, 0, 0.1), 0 5px <?php echo $this->get_option($sid, 'bts_boxshadow_color_four', '#e4ac01') ?> !important;
        border: 4px solid <?php echo $this->get_option($sid, 'bts_border_bottom_color_four', '#6b2014') ?> !important;
    }
    /* this is for all template */
    <?php echo $class; ?> .item h3 {
        color: <?php echo $this->get_option($sid, 'bts_name_color_four', '#3a3a3a') ?> !important;
    }
    <?php echo $class; ?> .item span {
        color: <?php echo $this->get_option($sid, 'bts_designation_color_four', '#3a3a3a') ?> !important;
    }
    <?php echo $class; ?> .item .description p{
        color: <?php echo $this->get_option($sid, 'bts_content_color_four', '#3a3a3a') ?> !important;
        margin-bottom: 45px !important;
    }
    <?php echo $class; ?> .item .description p a {
        color: <?php echo $this->get_option($sid, 'bts_readmore_color_four', '#0274be') ?>;
    }
</style>
<div class="owl-carousel owl-theme carousel<?php echo $id; ?> <?php echo $nav_position; ?> show_all_less equal_height_description_20 bts<?php echo $sid; ?>" id="bts4">
    <?php while($query->have_posts()): $query->the_post(); $id = get_the_ID(); $star = $this->get_testimonial($id, 'bts_ratting', null, $rating);?>
    <div class="testimonial item">
        <div class="pic">
            <img src="<?php echo $this->get_testimonial($id, 'bts_image', '', $picture) ?>">
        </div>
        <div class="description">
            <p class="show_all"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content),1000); ?><a href="#" class="bts3-show-less" data-id="129"><?php echo $read_less; ?></a></p>

            <p class="show_less"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content), $char, $read_more, 'class="bts3-show-all" data-id="'.$id.'"'); ?></p>
            <div class="testimonial-rating">
                <ul class="d-flex">
                    <?php for($i = 0; $i < $star; $i++){
                        echo '<li><span class="gs-Star-Solid"><svg class="icon"><use xlink:href="#star"></use></svg></span></li>';
                    } ?>
                </ul>
            </div>
        </div>
        
        <h3 class="title"><?php echo $this->get_testimonial($id, 'bts_name', '', $name) ?></h3>
        <span class="post"><?php echo $this->get_testimonial($id, 'bts_designation', '', $designation) ?></span>
    </div>
<?php endwhile; wp_reset_postdata(); ?>
</div>