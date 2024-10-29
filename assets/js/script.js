(function ($) {
  $(document).ready(function () {
    if (typeof bts != "undefined") {
      for (bts of bts) {
        $("." + bts.carousel).owlCarousel({
          items: parseInt(bts.items.top),
          autoplay: bts.bts_autoplay,
          margin: parseInt(bts.margin.right),
          loop: bts.loop,
          mouseDrag: bts.mouseDrag,
          touchDrag: bts.touchDrag,
          startPosition: bts.startPosition,
          nav: bts.bts_nav,
          lazyLoad: bts.lazyLoad,
          autoplayHoverPause: bts.autoplayHoverPause,
          dots: bts.bts_dots,
          autoplayTimeout: bts.autoplayTimeout,
          smartSpeed: bts.smartSpeed,
          responsive: {
            0: {
              items: parseInt(bts.items.left),
              dots: bts.bts_dots_mobile,
              nav: bts.bts_nav_mobile,
              autoplay: bts.bts_autoplay_mobile,
            },
            768: {
              items: parseInt(bts.items.bottom),
            },
            992: {
              items: parseInt(bts.items.right),
            },
            1200: {
              items: parseInt(bts.items.top),
            },
          },
        });
      }
    }

    // owl.on('mousewheel', '.owl-stage', function (e) {
    //     if (e.deltaY>0) {
    //         owl.trigger('next.owl');
    //     } else {
    //         owl.trigger('prev.owl');
    //     }
    //     e.preventDefault();
    // });

    // Select and loop the container element of the elements you want to equalise
    $("#bts3, .equal_height_item").each(function () {
      var highestBox = 0;
      $(".item", this).each(function () {
        if ($(this).height() > highestBox) {
          highestBox = $(this).height();
        }
      });
      highestBox = highestBox + 40;
      $(".item", this).css("min-height", highestBox);
    });

    /** Template 4 */
    $(".equal_height, .equal_height_description").each(function () {
      var highestBox = 0;
      $(".item .description", this).each(function () {
        if ($(this).height() > highestBox) {
          highestBox = $(this).height();
        }
      });
      $(".item .description", this).css("min-height", highestBox);
    });

    $(".equal_height_description_40").each(function () {
      var highestBox = 0;
      $(".item .description", this).each(function () {
        if ($(this).height() > highestBox) {
          highestBox = $(this).height();
        }
      });
      highestBox = highestBox + 40;
      $(".item .description", this).css("min-height", highestBox);
    });

    $(".equal_height_description_20").each(function () {
      var highestBox = 0;
      $(".item .description", this).each(function () {
        if ($(this).height() > highestBox) {
          highestBox = $(this).height();
        }
      });
      highestBox = highestBox + 20;
      $(".item .description", this).css("min-height", highestBox);
    });

    /**
     * this code for template three
     */
    $("#bts3 .testimonial-text")
      .find(".bts3-show-all")
      .on("click", function (e) {
        e.preventDefault();
        console.log($(this).attr("class"));
        //$(".show_less",this).hide();
        $(this).parent().hide();
        $(this).parent().parent().find(".show_all").show();
      });

    $("#bts3 .testimonial-text")
      .find(".bts3-show-less")
      .on("click", function (e) {
        e.preventDefault();
        console.log($(this).attr("class"));
        //$(".show_less",this).hide();
        $(this).parent().hide();
        $(this).parent().parent().find(".show_less").show();
      });

    /**
     * this code for template who use read more button
     */
    $(".show_all_less .description")
      .find(".bts3-show-all")
      .on("click", function (e) {
        e.preventDefault();
        $(this).parent().hide();
        $(this).parent().parent().find(".show_all").show();
      });

    $(".show_all_less .description")
      .find(".bts3-show-less")
      .on("click", function (e) {
        e.preventDefault();
        $(this).parent().hide();
        $(this).parent().parent().find(".show_less").show();
      });

    $(".bts3-show-alls").on("click", function (e) {
      const id = $(this).data("id");

      $.post(
        ajax.ajax_url,
        {
          action: "show_all_review_content",
          data: id,
        },
        function (data) {
          $(".bts3-show-all[data-id=" + id + "]")
            .parent()
            .html(data + '<a href="#" class="bts3-show-less" data-id="' + id + '">Show Less</a>');
          //console.log(data);
        }
      );

      e.preventDefault();
    });

    $(".bts3-show-lesss").on("click", function (e) {
      e.preventDefault();
      const id = $(this).data("id");
      //console.log($(this).data('id'));

      $.post(
        ajax.ajax_url,
        {
          action: "show_less_review_content",
          data: id,
        },
        function (data) {
          $(".bts3-show-all[data-id=" + id + "]")
            .parent()
            .html("<p>" + data + "</p>");
          //$(this).parent().html('<p>'+data+ '<a href="#" class="bts3-show-all" data-id="129">Show All</a>'+'</p>');
          //console.log(data);
        }
      );

      e.preventDefault();
    });
  });
})(jQuery);
