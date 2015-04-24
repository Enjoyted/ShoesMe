$(window).load(function() {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "centered-btns"
      });

      // Slideshow 2
      $("#slider2").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "transparent-btns"
      });

      // Slideshow 3
      $("#slider3").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "large-btns"
      });
  }
);