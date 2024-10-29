;(function($){
    $(document).ready(function(){
        /**
         * replace placeholder in responsive columns
         */
        $("[name='btss_meta[bts_column][top]']").attr('placeholder', 'Desktop')
        $("[name='btss_meta[bts_column][right]']").attr('placeholder', 'Laptop')
        $("[name='btss_meta[bts_column][bottom]']").attr('placeholder', 'Tab')
        $("[name='btss_meta[bts_column][left]']").attr('placeholder', 'Mobile')

    })
})(jQuery);


        