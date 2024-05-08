/* Листання слайдів */
let swiperHome = new Swiper(".home-swiper", {
    loop: true, // листання слайдів безліч раз
    grabCursor: true, // Зміна курсору при наведенні
    navigation: { // Навігація
        nextEl: ".swiper-button-next", // Елемент для переходу до наступного слайда
        prevEl: ".swiper-button-prev", // Елемент для переходу до попереднього слайда
    }
});