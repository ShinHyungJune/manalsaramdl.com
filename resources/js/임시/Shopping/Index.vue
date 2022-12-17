<template>
    <main class="mainpage">
        <div class="main-banner swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="shoppingBanner in shoppingBanners.data" :key="shoppingBanner.id">
                    <img :src="shoppingBanner.img ? shoppingBanner.img.url : ''" alt="">
                    <div class="txt-box row-group">
                        <h2 class="title" v-if="shoppingBanner.title">
                            {{ shoppingBanner.title }}
                        </h2>
                        <pre class="sub-title" v-if="shoppingBanner.subtitle">
                                {{ shoppingBanner.subtitle }}
                            </pre>
                        <a :href="shoppingBanner.link" v-if="shoppingBanner.link">
                            더보기
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-scrollbar"></div>
            <div class="swiper-controller col-group">
                <div class="col-group">
                    <div class="swiper-button-prev swiper-button-white"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next swiper-button-white"></div>
                </div>
                <div class="swiper-button-play">
                    <i class="xi-pause"></i>
                </div>
            </div>
        </div>
        <div class="main-section sec-1 container swiper-container">
            <ul class="sec-con col-group swiper-wrapper">
                <li class="swiper-slide" v-for="shoppingEvent in shoppingEvents.data" :key="shoppingEvent.id">
                    <a :href="shoppingEvent.url">
                        <div class="img-box">
                            <img :src="shoppingEvent.img ? shoppingEvent.img.url : ''" alt="">
                        </div>
                        <div class="txt-box row-group">
                            <h3>
                                {{ shoppingEvent.title }}
                            </h3>
                            <p class="row-group">
                                <span>{{ shoppingEvent.subtitle }}</span>
                                <span>{{ shoppingEvent.started_at }} ~ {{ shoppingEvent.finished_at }}</span>
                            </p>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="swiper-pagination sec1-paging mb"></div>
        </div>
        <div class="main-section sec-2 prod-sec">
            <div class="sec-title col-group container">
                <h3>
                    NEW MUDMAT
                </h3>
                <p>
                    흙표흙침대의 새로운 상품을 만나보세요
                </p>
            </div>
            <div class="sec-con">
                <div class="swiper-container sec-con-list sec2-slide">
                    <ul class="swiper-wrapper">
                        <li class="swiper-slide" v-for="newProduct in newProducts.data" :key="newProduct.id">
                            <a :href="`/shopping/products/${newProduct.id}`">
                                <div class="img-box">
                                    <img :src="newProduct.img ? newProduct.img.url : ''" alt="">
                                </div>
                                <div class="txt-box row-group">
                                    <h2>
                                        {{ newProduct.title }}
                                    </h2>
                                    <div>
                                            <span class="non-discount-price" v-if="newProduct.value_discount">
                                                SALE {{ newProduct.price.toLocaleString() }} 원
                                            </span>
                                        <p class="discount-price">

                                            <span>
                                                    {{ newProduct.discounted_price.toLocaleString() }} 원
                                                </span>
                                        </p>
                                        <ul class="store-type col-group">
                                            <li v-if="newProduct.department_store">
                                                백화점
                                            </li>
                                            <li v-if="newProduct.direct_store">
                                                온라인
                                            </li>
                                            <li v-if="newProduct.agency_store">
                                                대리점
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="swiper-pagination sec2-paging pc"></div>
                </div>
            </div>
        </div>
        <div class="banner-section">
            <div class="container">
                <a href="/brand/homecare" target="_blank">
                    <p class="pc">
                        전문적인 홈케어 서비스로
                        <br>
                        흙표흙침대와 함께 쾌적하고 기분좋은 수면을 누리세요
                    </p>
                    <p class="mb">
                        홈케어 서비스 알아보기
                    </p>
                </a>
            </div>
        </div>
        <div class="main-section sec-3 prod-sec">
            <div class="sec-title col-group container">
                <h3>
                    BEST MUDMAT
                </h3>
                <p>
                    흙표흙침대의 인기상품을 소개합니다
                </p>
            </div>
            <div class="sec-con">
                <div class="swiper-container sec-con-list sec3-slide">
                    <ul class="swiper-wrapper">
                        <li class="swiper-slide" v-for="bestProduct in bestProducts.data" :key="bestProduct.id">
                            <a :href="`/shopping/products/${bestProduct.id}`">
                                <div class="img-box">
                                    <img :src="bestProduct.img ? bestProduct.img.url : ''" alt="">
                                </div>
                                <div class="txt-box row-group">
                                    <h2>
                                        {{ bestProduct.title }}
                                    </h2>
                                    <div>
                                            <span class="non-discount-price" v-if="bestProduct.value_discount">
                                                SALE {{ bestProduct.price.toLocaleString() }} 원
                                            </span>
                                        <p class="discount-price">

                                            <span>
                                                    {{ bestProduct.discounted_price.toLocaleString() }} 원
                                                </span>
                                        </p>
                                        <ul class="store-type col-group">
                                            <li v-if="bestProduct.department_store">
                                                백화점
                                            </li>
                                            <li v-if="bestProduct.direct_store">
                                                온라인
                                            </li>
                                            <li v-if="bestProduct.agency_store">
                                                대리점
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="swiper-pagination sec3-paging pc"></div>
                </div>
            </div>
        </div>
        <div class="main-section sec-4 col-group">
            <div class="sec-title col-group mb">
                <h3>
                    recommend
                </h3>
                <p>
                    흙표흙침대의 추천상품을 소개합니다
                </p>
            </div>
            <div class="left-wrap swiper-container sec4-slide">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" v-for="recommendProduct in recommendProducts.data" :key="recommendProduct.id">
                        <a href="/shopping/products">
                            <img :src="recommendProduct.img ? recommendProduct.img.url : ''" alt="">
                            <div class="txt-box">
                                <h2>
                                    {{ recommendProduct.title }}
                                </h2>
                                <p>
                                    {{ recommendProduct.subtitle }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-pagination sec4-paging"></div>
            </div>

            <div class="right-wrap row-group">
                <div class="sec-title col-group pc">
                    <h3>
                        recommend
                    </h3>
                    <p>
                        흙표흙침대의 추천상품을 소개합니다
                    </p>
                </div>
                <div class="sec-con swiper-container recommend-slide">
                    <ul class="recommend-list swiper-wrapper">
                        <li class="swiper-slide col-group" v-for="product in selectedRecommendProduct.products" :key="product.id" v-if="selectedRecommendProduct">
                            <div class="img-wrap">
                                <div class="img-box">
                                    <img :src="product.img ? product.img.url : ''" alt="">
                                </div>
                            </div>
                            <div class="txt-box">
                                <p>
                                    {{ product.title }}
                                </p>
                                <a :href="`/shopping/products/${product.id}`">
                                    view more
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-section sec-5">
            <div class="container">
                <div class="sec-title col-group">
                    <div class="col-group">
                        <h3>
                            BEST REVIEW
                        </h3>
                        <p>
                            흙표흙침대를 구매한 고객들의 후기를 만나보세요
                        </p>
                    </div>
                </div>
                <div class="sec-con">
                    <ul class="review-list col-group">
                        <li v-for="review in reviews.data" :key="review.id">
                            <a :href="`/brand/reviews/${review.id}`">
                                <img :src="review.imgs.length > 0 ? review.imgs[0].url : ''" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
<!--    <pagination :meta="shoppingEvents.meta" @paginate="(page) => {form.page = page; filter()}" />-->
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            shoppingBanners: this.$page.props.shoppingBanners,
            shoppingEvents: this.$page.props.shoppingEvents,
            bestProducts: this.$page.props.bestProducts,
            newProducts: this.$page.props.newProducts,
            recommendProducts: this.$page.props.recommendProducts,
            reviews: this.$page.props.reviews,
            form: this.$inertia.form({
                page: 1,
                category_id: "",
                mood_id: "",
                usage_id: ""
            }),
            selectedRecommendProduct: "",
            recommendSwiper: "",
        }
    },
    methods:{
        search(){
            this.form.get("/searches");
        },
        initRecommendSwiper(){
            let self = this;

            setTimeout(function(){
                self.recommendSwiper =  new Swiper('.recommend-slide', {
                    direction: "vertical",
                    slidesPerView: "auto",
                    // centeredSlides: true,
                    spaceBetween: 40,
                    freeMode: true,
                    mousewheel: true,
                    autoplay: {
                        delay: 2000,
                    },
                    loop: true,
                    speed: 1000,
                    breakpoints: {
                        768: {
                            direction: "horizontal",
                            spaceBetween: 8,
                        }
                    }
                });

                $(".recommend-slide .swiper-slide").click(function(){
                    $(this).addClass("swiper-slide-active");
                })
            }, 100);
        }
    },
    computed: {
        selectedCategory() {
            if(this.categories.data.length === 0)
                return null;

            return this.categories.data.find(category => category.id == this.form.category_id);
        },

        selectedMood() {
            if(this.selectedCategory)
                return this.selectedCategory.moods.find(mood => mood.id == this.form.mood_id);

            return null;
        },

        selectedUsage() {
            if(this.selectedCategory)
                return this.selectedCategory.usages.find(usage => usage.id == this.form.usage_id);

            return null;
        },

    },
    mounted() {
        let self = this;
        if(this.recommendProducts.data.length > 0)
            this.selectedRecommendProduct = this.recommendProducts.data[0];

        //메인 배너 슬라이드
        var Mainswiper = new Swiper('.main-banner', {
            effect : 'fade',
            autoplay: {
                delay: 3000,
            },
            speed: 1000,
            pagination: {
                el: '.swiper-pagination',
                type: "fraction",
            },
         /*   navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },*/
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });

        //메인 배너 슬라이드 컨트롤
        $(".swiper-button-play").click(function(){
            $(this).toggleClass("pause");
            if($(this).hasClass("pause")){
                $(this).children("i").removeClass('xi-pause');
                $(this).children("i").addClass('xi-play');
                Mainswiper.autoplay.stop();
            }else{
                $(this).children("i").addClass('xi-pause');
                $(this).children("i").removeClass('xi-play');
                Mainswiper.autoplay.start();
            }
        });


        let length = $(".main-banner .swiper-slide").length;

        $(".main-banner .swiper-button-prev").click(function(){
            if(Mainswiper.activeIndex === 0)
                return Mainswiper.slideTo(length - 1);

            return Mainswiper.slideTo(Mainswiper.activeIndex - 1);
        });

        $(".main-banner .swiper-button-next").click(function(){
            if(Mainswiper.activeIndex === length - 1)
                return Mainswiper.slideTo(0);

            return Mainswiper.slideTo(Mainswiper.activeIndex + 1);
        });

        if( ($(document).width()) < 768 ) {

            var sec1_slide = new Swiper('.sec-1', {
                slidesPerView: 1,
                spaceBetween: 32,
                autoplay: false,
                speed: 500,
                pagination: {
                    el: '.sec1-paging',
                },
            });

        }

        var sec2_slide = new Swiper('.sec2-slide', {
            slidesPerView: 'auto',
            spaceBetween: 32,
            autoplay: {
                delay: 3000,
            },
            speed: 500,
            pagination: {
                el: '.sec2-paging',
                type: "progressbar",
            },
            breakpoints: {
                768: {
                    spaceBetween: 8,
                    pagination: false,
                }
            }
        });

        var sec3_slide = new Swiper('.sec3-slide', {
            slidesPerView: 'auto',
            spaceBetween: 32,
            autoplay: {
                delay: 3000,
            },
            speed: 500,
            pagination: {
                el: '.sec3-paging',
                type: "progressbar",
            },
            breakpoints: {
                768: {
                    spaceBetween: 8,
                    pagination: false,
                }
            }
        });

        this.recommendSwiper = this.initRecommendSwiper();

        var sec4_slide = new Swiper('.sec4-slide', {
            effect : 'fade',
            autoplay: {
                delay: 10000,
            },
            centeredSlides:true,
            speed: 1000,
            pagination: {
                el: '.sec4-paging',
            },
            on: {
                "slideChange" : function(){
                    self.selectedRecommendProduct = self.recommendProducts.data[this.activeIndex];

                    if(self.recommendSwiper)
                        self.recommendSwiper.destroy();

                    self.initRecommendSwiper();
                }
            }
        });

    }
}
</script>
