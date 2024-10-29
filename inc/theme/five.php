<style>
    /* this is for all template */
    <?php echo $class; ?> .item h3 {
        color: <?php echo $this->get_option($sid, 'bts_name_color_five', '#3a3a3a') ?> !important;
    }
    <?php echo $class; ?> .item span {
        color: <?php echo $this->get_option($sid, 'bts_designation_color_five', '#3a3a3a') ?> !important;
    }
    <?php echo $class; ?> .item .description p{
        color: <?php echo $this->get_option($sid, 'bts_content_color_five', '#3a3a3a') ?> !important;
        margin-bottom: 45px !important;
    }
    <?php echo $class; ?> .item .description p a {
        color: <?php echo $this->get_option($sid, 'bts_readmore_color_five', '#0274be') ?>;
    }
    /* Extra */
    <?php echo $class; ?> .item,
    <?php echo $class; ?> .item .title{
        border: 1px solid <?php echo $this->get_option($sid, 'bts_testimonial_color_five', '#ea816b') ?> !important;
    }
    <?php echo $class; ?> .item .pic {
        border: 5px solid <?php echo $this->get_option($sid, 'bts_img_border_color_five', '#c7373c') ?> !important;
    }
    <?php echo $class; ?> .item .description:before {
        color: <?php echo $this->get_option($sid, 'bts_quote_color_five', '#d7d7d7') ?> !important;
    }
</style>
<div class="owl-carousel owl-theme carousel<?php echo $id; ?> <?php echo $nav_position; ?> equal_height_description_40 show_all_less bts<?php echo $sid; ?>" id="bts5">
    <?php while($query->have_posts()): $query->the_post(); $id = get_the_ID(); $star = $this->get_testimonial($id, 'bts_ratting', null, $rating);?>
    <div class="testimonial item">
        <div class="pic">
            <img src="<?php echo $this->get_testimonial($id, 'bts_image', '', $picture) ?>" alt="">
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
        <h3 class="title"><?php echo $this->get_testimonial($id, 'bts_name', '', $name) ?>
            <span class="post"> - <?php echo $this->get_testimonial($id, 'bts_designation', '', $designation) ?></span>
        </h3>
    </div>
<?php endwhile; wp_reset_postdata(); ?>
</div>