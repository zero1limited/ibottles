var config = {
    paths: {            
            bannersliderLib: 'Custom_Banner/js/owl.carousel.min',
            gsap: 'Custom_Banner/js/gsap.min',
             gsap5: 'Custom_Banner/js/gsap-5',
            slickmin: 'Custom_Banner/js/slick.min'
        },   
    shim: {
        'bannersliderLib': {
            deps: ['jquery']
        },
        'gsap': {
            deps: ['jquery']
        },
        'gsap5': {
            deps: ['jquery']
        },
         'slickmin': {
            deps: ['jquery']
        }
    }
};