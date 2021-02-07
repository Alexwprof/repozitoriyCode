<script>
/*Сделать стрелки вверху влево иили вправо, этот вариант подойдёт*/ 
$(function(){
    	$('.your-class').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            appendArrows: $('.your-class-arrow'),
            prevArrow: '<button id="prev" type="button" class="btn btn-juliet"><i class="fa fa-chevron-left" aria-hidden="true"></i> Туда</button>',
            nextArrow: '<button id="next" type="button" class="btn btn-juliet">Сюда <i class="fa fa-chevron-right" aria-hidden="true"></i></button>'
    	});
    })

   

/*Сделать стрелки по бокам, этот вариант подойдёт*/ 

        $(".abracadabra").slick({
            dots: false,
            arrows: true,
            nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        arrows: true,
                        dots: false,
                    },
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });

        $(".service-list").slick({
            dots: false,
            arrows: true,
            nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: false,
                        arrows: true,
                        dots: false,
                    },
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
            ],
        });
    
</script>
