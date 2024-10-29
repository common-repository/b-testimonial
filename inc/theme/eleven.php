<style>
    /* this is for all template */
    <?php echo $class; ?> .item h4 {
        color: <?php echo $this->get_option($sid, 'bts_name_color_eleven', '#ffffff') ?> !important;
    }
    <?php echo $class; ?> .item h4 small {
        color: <?php echo $this->get_option($sid, 'bts_designation_color_eleven', '#ffffff') ?> !important;
    }
    <?php echo $class; ?> .item .description p{
        color: <?php echo $this->get_option($sid, 'bts_content_color_eleven', '#222222') ?> !important;
        margin-bottom: 45px !important;
    }
    <?php echo $class; ?> .item .description p a {
        color: <?php echo $this->get_option($sid, 'bts_readmore_color_eleven', '#0274be') ?> !important;
    }
    /* Extra */
    <?php echo $class; ?> .testimonial-review {
        background: <?php echo $this->get_option($sid, 'bts_review_background_color_eleven', '#ffffff') ?> !important;
    }
    <?php echo $class; ?> .testimonial-review:before {
        border-top: 12px solid <?php echo $this->get_option($sid, 'bts_review_background_color_eleven', '#ffffff') ?> !important;
    }
   
   

</style>
<div class="owl-carousel owl-theme carousel<?php echo $id; ?> rating show_all_less equal_height_description <?php echo $nav_position; ?> bts<?php echo $sid; ?>" id="bts11">
    <?php while($query->have_posts()): $query->the_post(); $id = get_the_ID(); $star = $this->get_testimonial($id, 'bts_ratting');?>
    <div class="testimonial item">
        <div class="testimonial-review">
            <div class="description">
                <p class="show_all"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content),1000); ?><a href="#" class="bts3-show-less" data-id="129"><?php echo $read_less; ?></a></p>

                <p class="show_less"><?php echo $this->read_more($this->get_testimonial($id, 'bts_feedback', '', $content), $char, $read_more, 'class="bts3-show-all" data-id="'.$id.'"'); ?></p>
            </div>
        </div>
        <div class="pic">
            <img src="<?php echo $this->get_testimonial($id, 'bts_image', '', $picture) ?>" alt="">
            <h4 class="testimonial-title"><?php echo $this->get_testimonial($id, 'bts_name', '', $name) ?>
                <small><?php echo $this->get_testimonial($id, 'bts_designation', '', $designation) ?></small>
            </h4>
        </div>
    </div>
<?php endwhile; wp_reset_postdata(); ?>
</div>