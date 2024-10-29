<?php
if(!class_exists('CSF')){
    return;
}

$prefix = 'bts_meta';
CSF::createMetabox($prefix, array(
    'title' => 'Options',
    // 'class' => 'spt-main-class',
    'post_type' => 'btstestimonial',
    //'data_type' => 'unserialize',
    'class' => 'spt-main-class',
    'priority' => 'high',
));

CSF::createSection($prefix, array(
    'fields' => array(
        array(
            'id' => 'bts_image',
            'type' => 'upload',
            'title' => 'Person Image',
            'placeholder' => 'image',
            'button_title' => 'Add Image',
            'library' => array('image')
        ),
        array(
            'id' => 'bts_name',
            'type' => 'text',
            'title' => 'Name',
            'placeholder' => 'Name',
        ),
        array(
            'id' => 'bts_designation',
            'type' => 'text',
            'title' => 'Designation',
            'placeholder' => 'Designation'
        ),
        array(
            'id' => 'bts_ratting',
            'type' => 'button_set',
            'title' => 'Rating',
            'options' => array(
                '1' => '1 &#11088;',
                '2' => '2 &#11088;',
                '3' => '3 &#11088;',
                '4' => '4 &#11088;',
                '5' => '5 &#11088;',
            ),
            'default' => '5'
        ),
        array(
            'id' => 'bts_feedback',
            'type' => 'textarea',
            'title' => 'Feedback Content',
            'placeholder' => 'Feedback Content',
            'attributes' => array('style' => 'min-height: 75px;')
        )
    )
));

$prefix = 'btss_meta';
CSF::createMetabox($prefix, array(
    'title' => ' ',
    'class'     => 'spt-main-class',
    // 'class' => 'spt-main-class',
    'post_type' => 'btsshortcode',
    //'data_type' => 'unserialize',
    'theme' => 'light',
    'priority' => 'high',
    'show_restore' => true
));

CSF::createSection($prefix, array(
    'title' => 'General',
    'icon' => 'fa fa-cog',
    'fields' => array(
        array(
            'id' => 'bts_template',
            'type' => 'select',
            'title' => 'Select Template',
            'attributes' => array('id' => 'bts_template'),
            'subtitle' => 'Select a Template which you like',
            'options' => array(
                'one' => 'Template 1',
                'two' => 'Template 2',
                'three' => 'Template 3',
                'four' => 'Template 4',
                'five' => 'Template 5',
                'eleven' => 'Template 11',
            )
        ),
        array(
            'id'       => 'bts_column',
            'type'     => 'spacing',
            'title'    => 'Responsive Columns',
            'subtitle'     => 'Set number of columns for different divices to get responsive view',
            'default'  => array(
              'top'    => '1', //desktop
              'right'  => '1', //laptop
              'bottom' => '1', //tab
              'left'   => '1', //mobile
            ),
            'show_units' => false,
            'top_icon' => '<i class="fas fa-desktop"></i>',
            'right_icon' => '<i class="fas fa-laptop"></i>',
            'bottom_icon' => '<i class="fas fa-tablet-alt"></i>',
            'left_icon' => '<i class="fas fa-mobile-alt"></i>',
          ),
          array(
            'id' => 'bts_testimonial_select',
            'type' => 'button_set',
            'title' => 'Select Testimonials',
            'options' => array(
                'manually' => 'Manually',
                'category' => 'Category',
                'all' => 'All',
            ),
            'default' => 'all'
          ),
          array(
              'id' => 'bts_testimonials_manually',
              'type' => 'select',
              'title' => 'Select Testimonials Manually',
              'options' => 'posts',
              'query_args' => array(
                  'post_type' => 'btstestimonial'
              ),
              'sortable' => true,
              'multiple' => true,
              'chosen' => true,
              'dependency' => array('bts_testimonial_select', '==', 'manually'),
              'placeholder' => 'Select Testimonials'
          ),
          array(
            'id' => 'bts_testimonial_category',
            'type' => 'select',
            'title' => 'Select Testimonials Category',
            'options' => 'categories',
            'query_args' => array(
                'taxonomy' => 'btscategory',
            ),
            'dependency' => array('bts_testimonial_select', '==', 'category'),
            'placeholder' => 'Select Category',
            'multiple' => true,
            'chosen' => true
          ),
        array(
            'id' => 'bts_char_limit',
            'type' => 'number',
            'title' => 'Character Show Limit',
            'subtitle' => 'Set how many character do you want to show from review content ',
            'default' => '200',
            'desc' => 'number like 200,300, 400 or any numeric value'
        ),
        array(
            'id' => 'bts_limit',
            'type' => 'number',
            'title' => 'Limit',
            'desc' => 'set -1 to show all testimonial',
            'subtitle' => 'Limit number of testimonial to show',
            'default' => '-1'
        ),
        array(
            'id' => 'bts_orderby',
            'type' => 'select',
            'title' => 'Order By',
            'subtitle' => 'select order by option',
            'options' => array(
                'id' => 'Testimonial ID',
                'date' => 'Date',
                'title' => 'Title',
                'modified' => 'Modified',
                'rand' => 'Random Order',
            ),
            'default' => 'date'
        ),
        array(
            'id' => 'bts_ordertype',
            'type' => 'select',
            'title' => 'Order Type',
            'options' => array(
                'DESC' => 'Descending',
                'ASC' => 'Ascending',
            ),
            'default' => 'DESC'
        ),
        array(
            'id' => 'bts_readmore_text',
            'type' => 'text',
            'title' => 'Read More Text',
            'default' => 'Read More'
        ),
        array(
            'id' => 'bts_readless_text',
            'type' => 'text',
            'title' => 'Read Less Text',
            'default' => 'Read Less'
        ),
        
    )
));

CSF::createSection($prefix, array(
    'title' => 'Slider Settings',
    'icon' => 'fa fa-sliders',
    'fields' => array(
        array(
            'id' => 'bts_autoplay',
            'type' => 'button_set',
            'title' => 'Autoplay',
            'options' => array(
                'on' => 'On',
                'off' => 'Off',
                'mobile' => 'Off on Mobile'
            ),
            'default' => 'on'
        ),
        array(
            'id' => 'bts_autoplay_timeout',
            'type' => 'number',
            'title' => 'Autoplay Speed',
            'desc' => 'set autoplay speed speed in millisecond',
            'default' => 3000
        ),
        array(
            'id' => 'bts_pagination_speed',
            'type' => 'number',
            'title' => 'Pagination Speed',
            'desc' => 'Set Pagination Speed in millisecond',
            'default' => '600'
        ),
        array(
            'id' => 'bts_margin',
            'type' => 'spacing',
            'title' => 'Margin Right',
            'subtitle' => 'Space after every Testimonial',
            'left' => false,
            'top' => false,
            'bottom' => false,
            'default' => array(
                'right' => 10
            ),
            'units' => array('px')
        ),
        array(
            'id' => 'bts_loop',
            'type' => 'switcher',
            'title' => 'Loop',
            'text_on' => 'Yes',
            'text_off' => 'No',
            'default' => '0'
        ),
        array(
            'id' => 'bts_mousedrag',
            'type' => 'switcher',
            'title' => 'Mouse Drag',
            'text_on' => 'Yes',
            'text_off' => 'No',
            'default' => '1'
        ),
        array(
            'id' => 'bts_touchdrag',
            'type' => 'switcher',
            'title' => 'Touch Drag',
            'text_on' => 'Yes',
            'text_off' => 'No',
            'default' => '1'
        ),
        array(
            'id' => 'bts_start_position',
            'type' => 'number',
            'title' => 'Start Position',
            'subtitle' => 'Set Start Position',
            'default' => 0
        ),
        array(
            'id' => 'bts_nav',
            'type' => 'button_set',
            'title' => 'Navigation',
            'options' => array(
                'show' => 'Show',
                'hide' => 'Hide',
                'mobile' => 'Hide On Mobile'
            ),
            'default' => 'hide'
        ),
        // array(
        //     'id' => 'bts_nav',
        //     'type' => 'switcher',
        //     'title' => 'Show Navigation',
        //     'text_on' => 'Yes',
        //     'text_off' => 'No',
        //     'default' => '0'
        // ),
        array(
            'id' => 'bts_nav_position',
            'type' => 'button_set',
            'title' => 'Navigation Position',
            'options' => array(
                'nav_bottom' => 'Bottom',
                'nav_middle' => 'Middle'
            ),
            'default' => 'nav_bottom',
            'dependency' => array('bts_nav', '!=', 'hide')
        ),
        array(
            'id' => 'bts_dots',
            'type' => 'button_set',
            'title' => 'Pagination',
            'options' => array(
                'show' => 'Show',
                'hide' => 'Hide',
                'mobile' => 'Hide On Mobile'
            ),
            'default' => 'show'
        ),
        array(
            'id' => 'bts_lazyload',
            'type' => 'switcher',
            'title' => 'Lazy Load',
            'text_on' => 'Yes',
            'text_off' => 'No',
            'default' => '1'
        ),
        array(
            'id' => 'bts_pause_on_hover',
            'type' => 'switcher',
            'title' => 'Auto Play pause on mouse hover',
            'text_on' => 'Yes',
            'text_off' => 'No',
            'default' => '1'
        ),
        // array(
        //     'id' => 'bts_mousewheel',
        //     'type' => 'switcher',
        //     'title' => 'Enable Mousewheel',
        //     'text_on' => 'Yes',
        //     'text_off' => 'No',
        //     'default' => '0'
        // ),

        
    )
));

CSF::createSection($prefix, array(
    'title' => 'Style',
    'icon' => 'fas fa-paint-brush',
    'fields' => array(
        //this options for Template One
        array(
            'id' => 'bts_name_color_one',
            'type' => 'color',
            'title' => 'Name Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'one', 'all')
        ),
        array(
            'id' => 'bts_designation_color_one',
            'type' => 'color',
            'title' => 'Designation Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'one', 'all')
        ),
        array(
            'id' => 'bts_content_color_one',
            'type' => 'color',
            'title' => 'Content Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'one', 'all')
        ),
        array(
            'id' => 'bts_bg_color_one',
            'type' => 'color',
            'title' => 'Item Background Color',
            'default' => '#ffffff',
            'dependency' => array('bts_template', '==', 'one', 'all')
        ),
        array(
            'id' => 'bts_readmore_color_one',
            'type' => 'color',
            'title' => 'Read More Text Color',
            'default' => '#0274be',
            'dependency' => array('bts_template', '==', 'one', 'all')
        ),
        // this is for Template two
        array(
            'id' => 'bts_name_color_two',
            'type' => 'color',
            'title' => 'Name Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'two', 'all')
        ),
        array(
            'id' => 'bts_designation_color_two',
            'type' => 'color',
            'title' => 'Designation Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'two', 'all')
        ),
        array(
            'id' => 'bts_content_color_two',
            'type' => 'color',
            'title' => 'Content Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'two', 'all')
        ),
        array(
            'id' => 'bts_bg_color_two',
            'type' => 'color',
            'title' => 'Item Background Color',
            'default' => '#ffffff',
            'dependency' => array('bts_template', '==', 'two', 'all')
        ),
        array(
            'id' => 'bts_readmore_color_two',
            'type' => 'color',
            'title' => 'Read More Text Color',
            'default' => '#0274be',
            'dependency' => array('bts_template', '==', 'two', 'all')
        ),
        // this is for Template Three
        array(
            'id' => 'bts_name_color_three',
            'type' => 'color',
            'title' => 'Name Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'three', 'all')
        ),
        array(
            'id' => 'bts_designation_color_three',
            'type' => 'color',
            'title' => 'Designation Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'three', 'all')
        ),
        array(
            'id' => 'bts_content_color_three',
            'type' => 'color',
            'title' => 'Content Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'three', 'all')
        ),
        array(
            'id' => 'bts_bg_color_three',
            'type' => 'color',
            'title' => 'Item Background Color',
            'default' => '#ffffff',
            'dependency' => array('bts_template', '==', 'three', 'all')
        ),
        array(
            'id' => 'bts_topbox_bg_color_three',
            'type' => 'color',
            'title' => 'Item Top Box Background Color',
            'default' => '#E3057B',
            'dependency' => array('bts_template', '==', 'three', 'all')
        ),
        array(
            'id' => 'bts_readmore_color_three',
            'type' => 'color',
            'title' => 'Read More Text Color',
            'default' => '#0274be',
            'dependency' => array('bts_template', '==', 'three', 'all')
        ),
        // this is for Template Four
        array(
            'id' => 'bts_name_color_four',
            'type' => 'color',
            'title' => 'Name Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'four', 'all')
        ),
        array(
            'id' => 'bts_designation_color_four',
            'type' => 'color',
            'title' => 'Designation Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'four', 'all')
        ),
        array(
            'id' => 'bts_content_color_four',
            'type' => 'color',
            'title' => 'Content Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'four', 'all')
        ),
        array(
            'id' => 'bts_readmore_color_four',
            'type' => 'color',
            'title' => 'Read More Text Color',
            'default' => '#0274be',
            'dependency' => array('bts_template', '==', 'four', 'all')
        ),
        array(
            'id' => 'bts_border_bottom_color_four',
            'type' => 'color',
            'title' => 'Border Bottom Color',
            'default' => '#6b2014',
            'dependency' => array('bts_template', '==', 'four', 'all')
        ),
        array(
            'id' => 'bts_boxshadow_color_four',
            'type' => 'color',
            'title' => 'Box Shadow Color',
            'default' => '#e4ac01',
            'dependency' => array('bts_template', '==', 'four', 'all')
        ),
        // this is for Template Five
        array(
            'id' => 'bts_name_color_five',
            'type' => 'color',
            'title' => 'Name Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        array(
            'id' => 'bts_designation_color_five',
            'type' => 'color',
            'title' => 'Designation Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        array(
            'id' => 'bts_content_color_five',
            'type' => 'color',
            'title' => 'Content Color',
            'default' => '#3a3a3a',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        array(
            'id' => 'bts_readmore_color_five',
            'type' => 'color',
            'title' => 'Read More Text Color',
            'default' => '#0274be',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        array(
            'id' => 'bts_img_border_color_five',
            'type' => 'color',
            'title' => 'Image Border Color',
            'default' => '#c7373c',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        array(
            'id' => 'bts_testimonial_color_five',
            'type' => 'color',
            'title' => 'Testimonial Border Color',
            'default' => '#ea816b',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        array(
            'id' => 'bts_quote_color_five',
            'type' => 'color',
            'title' => 'Quote Color',
            'default' => '#d7d7d7',
            'dependency' => array('bts_template', '==', 'five', 'all')
        ),
        // this is for Template eleven
        array(
            'id' => 'bts_name_color_eleven',
            'type' => 'color',
            'title' => 'Name Color',
            'default' => '#333333',
            'dependency' => array('bts_template', '==', 'eleven', 'all')
        ),
        array(
            'id' => 'bts_designation_color_eleven',
            'type' => 'color',
            'title' => 'Designation Color',
            'default' => '#333333',
            'dependency' => array('bts_template', '==', 'eleven', 'all')
        ),
        array(
            'id' => 'bts_content_color_eleven',
            'type' => 'color',
            'title' => 'Content Color',
            'default' => '#222222',
            'dependency' => array('bts_template', '==', 'eleven', 'all')
        ),
        array(
            'id' => 'bts_readmore_color_eleven',
            'type' => 'color',
            'title' => 'Read More Text Color',
            'default' => '#0274be',
            'dependency' => array('bts_template', '==', 'eleven', 'all')
        ),
        array(
            'id' => 'bts_review_background_color_eleven',
            'type' => 'color',
            'title' => 'Testimonial Background',
            'default' => '#e6e6e6',
            'dependency' => array('bts_template', '==', 'eleven', 'all')
        ),
        // for all
        array(
            'id' => 'bts_nav_style',
            'type' => 'color_group',
            'title' => 'Navigation Color',
            'options' => array(
                'color' => 'Color',
                'hover' => 'Hover Color',
                'background' => 'Background',
                'hover_bg' => 'Hover Background'
            ),
            'default' => array(
                'color' => '#ffffff',
                'background' => '#444444',
                'hover' => '#ffffff',
                'hover_bg' => '#4527A4'
            )
        ),
        array(
            'id' => 'bts_nav_fontsize',
            'type' => 'number',
            'title' => 'Navigation Font Size',
            'default' => '25',
            'unit' => 'px',
        ),
        array(
            'id' => 'bts_container_padding',
            'type' => 'number',
            'title' => 'Testimonial Container Padding',
            'default' => '10',
            'unit' => 'px'
        ),
    )
));

CSF::createSection($prefix, array(
    'title' => 'Display Settings',
    'icon' => 'fa fa-eye',
    'fields' => array(
        array(
            'id' => 'bts_show_title',
            'type' => 'switcher',
            'title' => 'Show Testimonial Title',
            'default' => '1',
            'text_on' => 'Yes',
            'text_off' => 'No'
        ),
        array(
            'id' => 'bts_show_picture',
            'type' => 'switcher',
            'title' => 'Show Picture',
            'default' => '1',
            'text_on' => 'Yes',
            'text_off' => 'No'
        ),
        array(
            'id' => 'bts_show_name',
            'type' => 'switcher',
            'title' => 'Show Name',
            'default' => '1',
            'text_on' => 'Yes',
            'text_off' => 'No'
        ),
        array(
            'id' => 'bts_show_designation',
            'type' => 'switcher',
            'title' => 'Show Designation',
            'default' => '1',
            'text_on' => 'Yes',
            'text_off' => 'No'
        ),
        array(
            'id' => 'bts_show_content',
            'type' => 'switcher',
            'title' => 'Show Content',
            'default' => '1',
            'text_on' => 'Yes',
            'text_off' => 'No'
        ),
        array(
            'id' => 'bts_show_rating',
            'type' => 'switcher',
            'title' => 'Show Rating',
            'default' => '1',
            'text_on' => 'Yes',
            'text_off' => 'No'
        ),
    )
));