;(function($){
$(document).ready(function(){
    setTimeout(() => {
        $(".owl-carousel").owlCarousel({ 
            items: 1,
            loop: true
        });
    }, 3000);
    
    console.log('working')
});
})(jQuery)