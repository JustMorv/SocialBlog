words = [];
const arrayWords = document.querySelectorAll('.slider__item-title');
arrayWords.forEach(function (item){
    words.push(item.textContent);
});

const swiper = new Swiper('.swiper-container-slider', {
    direction: 'horizontal',
    loop: true,

    autoplay: {
        delay: 5000,
    },
    fadeEffect: {
        crossFade: true,
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,

        renderBullet: function (index, className) {
            return '<div class="slider__navigation-control ' + className + '">' + words[index] + '</div>';
        },
    },

    scrollbar: {
        el: '.swiper-scrollbar',
    },
});