$(".wrap-slider-1").slick({
    dots: false,
    arrows: true,
    nextArrow: '<div class="my-slider-arrow ar-right"><i class="fright" aria-hidden="true"></i></div>',
	prevArrow: '<div class="my-slider-arrow ar-left"><i class="fleft" aria-hidden="true"></i></div>',
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
               
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
               
            },
        },
        {
            breakpoint: 475,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
              
            },
        },

        
    
    ],
});
