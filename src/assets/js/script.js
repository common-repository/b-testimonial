(function ($) {
  $(document).ready(function () {
    const settings = $(".bTestimonialSettings");

    if (typeof settings === "object") {
      for (setting of settings) {
        let singleSettings = JSON.parse($(setting).attr("settings"));
        const slider = $(setting).find(".owl-carousel");

        $(slider).owlCarousel({ ...singleSettings });
      }
    }
  });
})(jQuery);
