<template>
    <main class="mainpage">
        <div class="main-banner swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide" v-for="brandBanner in brandBanners.data" :key="brandBanner.id">
                    <img :src="brandBanner.img ? brandBanner.img.url : ''" alt="">
                    <div class="txt-box row-group">
                        <h2 class="title" v-if="brandBanner.title">
                            {{ brandBanner.title }}
                        </h2>
                        <pre class="sub-title" v-if="brandBanner.subtitle">{{ brandBanner.subtitle }}</pre>
                        <a :href="brandBanner.url" v-if="brandBanner.url">더보기</a>
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

        <div class="main-section sec-1">
            <div class="sec-title-box row-group">
                <ul class="sec-title">
                    <li class="active tab-content" name="sec1_1">
                        흙침대의 가치
                    </li>
                    <li class="tab-content" name="sec1_2">
                        흙표흙침대의 효과
                    </li>
                    <li class="tab-content" name="sec1_3">
                        흙표흙침대의 철학
                    </li>
                    <li class="tab-content" name="sec1_4">
                        수상 및 인증
                    </li>
                </ul>
                <ul class="sec-sub-title">
                    <li class="active tab-content" name="sec1_1">
                        흙침대의 핵심, 황토
                        <br/>조상들의 지혜를 재현하다
                    </li>
                    <li class="tab-content" name="sec1_2">
                        온열,원적외선,피톤치드 등
                        <br/>다양한 황토의 우수성을 직접 만나보세요.
                    </li>
                    <li class="tab-content" name="sec1_3">
                        꾸준한 기술 개발로 발전한 흙표흙침대는
                        <br/>기술력 뿐 아니라 재료까지 꼼꼼하게 신경썼습니다.
                    </li>
                    <li class="tab-content" name="sec1_4">
                        1992년부터 시작해 차원이 다른 최고의
                        <br/>흙침대를 만들기위해 노력했습니다.
                    </li>
                </ul>
                <a href="/brand/story1" class="tab-content active"  name="sec1_1">바로가기</a>
                <a href="/brand/story2" class="tab-content"  name="sec1_2">바로가기</a>
                <a href="/brand/story3" class="tab-content"  name="sec1_3">바로가기</a>
                <a href="/brand/certification" class="tab-content"  name="sec1_4">바로가기</a>
            </div>
            <div class="sec-con">
                <ul class="sec-con-list row-group">
                    <li class="active" data-tab="sec1_1">
                        <span>01</span>
                        <span class="pc">흙침대의 가치</span>
                    </li>
                    <li data-tab="sec1_2">
                            <span>
                                02
                            </span>
                        <span class="pc">
                       흙표흙침대의 효과
                            </span>
                    </li>
                    <li data-tab="sec1_3">
                            <span>
                                03
                            </span>
                        <span class="pc">
                            흙표흙침대의 철학
                            </span>
                    </li>
                    <li data-tab="sec1_4">
                            <span>
                                04
                            </span>
                        <span class="pc">
                        수상 및 인증
                            </span>
                    </li>
                </ul>
            </div>
            <ul class="bg-box">
                <li class="active tab-content" name="sec1_1">
                    <img src="/images/brand1.jpg" alt="">
                </li>
                <li class="tab-content" name="sec1_2">
                    <img src="/images/brand2.jpg" alt="">
                </li>
                <li class="tab-content" name="sec1_3">
                    <img src="/images/brand3.jpg" alt="">
                </li>
                <li class="tab-content" name="sec1_4">
                    <img src="/images/brand4.jpg" alt="">
                </li>
            </ul>
        </div>

        <div class="main-section sec-2">
            <div class="container">
                <div class="sec-title row-group">
                    <h3>
                        MUDMAT PICK
                    </h3>
                    <p>
                        원하는 가구의 위치와 종류, 디자인을 선택해주세요.
                        <br>
                        알맞은 제품을 찾아드립니다.
                    </p>
                </div>
                <div class="sec-con row-group">
                    <form action="" @submit.prevent="search">
                        <div class="prod-search">
                            <ul class="search-box col-group">
                                <li>
                                    <div class="select-box col-group">
                                        <div class="user">
                                            <input type="text" :value="selectedCategory ? selectedCategory.title : '선택'" id="select_1" name="select-1" class="select-default" readonly>
                                            <ul class="select-list row-group" data-select="select-1">
                                                <li v-for="category in categories.data" :key="category.id" @click="form.category_id = category.id;">{{ category.title }}</li>
                                            </ul>
                                            <i class="xi-angle-down select-down"></i>
                                        </div>
                                        <p class="default">
                                            를 찾아요
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="select-box col-group"> <!-- '침대' 선택 시 -->
                                        <div class="user">
                                            <input type="text" :value="selectedUsage ? selectedUsage.title : '선택'" id="select_2" name="select-2" class="select-default" readonly>
                                            <ul class="select-list row-group" data-select="select-2" v-if="selectedCategory">
                                                <li v-for="usage in selectedCategory.usages" :key="usage.id" @click="form.usage_id = usage.id;">{{ usage.title }}</li>
                                            </ul>
                                            <i class="xi-angle-down select-down"></i>
                                        </div>
<!--                                        <p class="default">
                                            에서 사용할
                                        </p>-->
                                    </div>
                                </li>
                                <li>
                                    <div class="select-box col-group">
                                        <div class="user">
                                            <input type="text" :value="selectedMood ? selectedMood.title : '선택'" id="select_3" name="select-3" class="select-default" readonly>
                                            <ul class="select-list row-group" data-select="select-3" v-if="selectedCategory">
                                                <li v-for="mood in selectedCategory.moods" :key="mood.id" @click="form.mood_id = mood.id;">{{ mood.title }}</li>
                                            </ul>
                                            <i class="xi-angle-down select-down"></i>
                                        </div>
<!--                                        <p class="default">
                                            제품이 필요해요
                                        </p>-->
                                    </div>
                                </li>
                            </ul>
                            <button type="submit" class="next-btn">
                                <i class="xi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="main-section sec-3" v-if="newProducts.data.length > 0">
            <div class="container">
                <div class="sec-title col-group">
                    <div class="row-group">
                        <h3>
                            NEW MUDMAT
                        </h3>
                        <p>
                            새로운 라이프스타일을 제시하는
                            <br class="mb">
                            흙표흙침대의 새로운 상품을 확인해보세요.
                            <br>
                            건강과 인테리어를 함께 디자인합니다.
                        </p>
                    </div>
                    <ul class="tab-link col-group">
                        <li :class="newProduct.id == selectedNewProduct.id ? 'active' : ''" :data-tab="newProduct.id" v-for="newProduct in newProducts.data" :key="newProduct.id" @click="selectedNewProduct = newProduct">
                            {{ newProduct.title }}
                        </li>
                    </ul>
                </div>
                <div class="sec-con" data-aos="fade-up">
                    <div :class="newProduct.id == selectedNewProduct.id ? 'tab-content active' : 'tab-content'" :id="newProduct.id" v-for="newProduct in newProducts.data" :key="newProduct.id">
                        <div class="col-group">
                            <div class="left-box animate__animated">
                                <a :href="newProduct.url" class="img-box">
                                    <img :src="newProduct.img_left ? newProduct.img_left.url : ''" alt="">
                                </a>
                            </div>
                            <div class="right-box row-group">
                                <div class="top-box animate__animated">
                                    <a :href="newProduct.url" class="img-box">
                                        <img :src="newProduct.img_top ? newProduct.img_top.url : ''" alt="">

                                    </a>
                                </div>
                                <div class="btm-box animate__animated">
                                    <a :href="newProduct.url" class="img-box">
                                        <img :src="newProduct.img_bottom ? newProduct.img_bottom.url : ''" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-section sec-4">
            <div class="container">
                <div class="sec-title row-group">
                    <h3>
                        mudmat official
                    </h3>
                    <p>
                        흙표흙침대의 SNS소식을 만나보세요
                    </p>
                </div>
                <div class="sec-footer col-group">
                    <ul class="sns-list col-group">
                        <li>
                            <a href="https://www.youtube.com/channel/UCYehxk_hWKW4Q_IjwC1Mlfw?view_as=subscriber" target="_blank">
                                <img src="/images/sns-icon-utb.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/gomudmat" target="_blank">
                                <img src="/images/sns-icon-faceb.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://blog.naver.com/mudmat1" target="_blank">
                                <img src="/images/sns-icon-blog.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/mudmat_official" target="_blank">
                                <img src="/images/sns-icon-insta.png" alt="">
                            </a>
                        </li>
                    </ul>
                    <div class="swiper-navigation col-group">
                        <div class="swiper-button-prev swiper-button-black sns-prev"></div>
                        <div class="swiper-button-next swiper-button-black sns-next"></div>
                    </div>
                </div>
                <div class="sec-con">
                    <div class="swiper-container sns-slide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="social in socials.data" :key="social.id">
                                <a :href="social.url" target="_blank" class="img-box">
                                    <img :src="social.img ? social.img.url : ''" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="swiper-pagination sns-paging mb"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-section sec-5">
            <div class="sec-wrap col-group">
                <div class="sec-left">
                    <div class="sec-title row-group">
                        <h3>
                            흙표흙침대 온라인몰 가기
                        </h3>
                        <p>
                            흙표몰에서 흙표흙침대의 다양한 가구를 확인하고
                            <br>
                            새로운 라이프스타일을 만나보세요.
                        </p>
                    </div>
                    <a href="/shopping" target="_blank">
                        바로가기
                    </a>
                </div>
                <div class="sec-right">
                    <div class="sec-title row-group">
                        <h3>
                            흙표흙침대 매장 찾기
                        </h3>
                        <p>
                            전국의 흙표흙침대 매장정보를 알려드립니다
                            <br>
                            가까운 매장에 방문해보세요.
                        </p>
                    </div>
                    <a href="/brand/stores">
                        바로가기
                    </a>
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
            categories: this.$page.props.categories,
            brandBanners: this.$page.props.brandBanners,
            newProducts: this.$page.props.newProducts,
            recommendProducts: this.$page.props.recommendProducts,
            socials: this.$page.props.socials,
            form: this.$inertia.form({
                page: 1,
                category_id: "",
                mood_id: "",
                usage_id: ""
            }),
            selectedNewProduct: ""
        }
    },
    methods:{
        search(){
            location.href=`/brand/searches?category_id=${this.form.category_id}&mood_id=${this.form.mood_id}&usage_id=${this.form.usage_id}`
            /*this.form.get("/brand/searches", {
                preserveScroll: false
            });*/
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
        if(this.newProducts.data.length > 0)
            this.selectedNewProduct = this.newProducts.data[0];

        //메인 배너 슬라이드
        setTimeout(function(){
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
                allowSlideNext: true,
                allowSlidePrev: true,
                /*navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },*/
                scrollbar: {
                    el: '.swiper-scrollbar',
                },
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

            //알맞은 제품 찾기
            $(".select-default").click(function(){
                $('.select-default').css('z-index', 'unset');
                $(this).css('z-index', '99');
                $('.user').removeClass('active');
                $(this).parent('.user').toggleClass('active');
                $(".select-list").hide();
                $(this).siblings('.select-list').stop().slideToggle();

                if( $(this).next('.select-list').children('li').length === 3 ) {
                    $(this).parent('.user').addClass('box3');
                }

                if( $(this).next('.select-list').children('li').length === 4 ) {
                    $(this).parent('.user').addClass('box4');
                }

                $(".select-list li").click(function(){
                    var select_option = $(this).html();
                    var select_num = $(this).parent('.select-list').attr('data-select');
                    $(".select-list").hide();
                    $('input[name='+select_num+']').attr("value", select_option);
                    $(this).parent('.select-list').parent('.user').removeClass('active');
                    $(this).css('z-index', 'unset');
                });
            });

            $(".select-down").click(function(){
                if( $(this).parent('.user').hasClass('active') ) {
                    $('.user').removeClass('active');
                    $(".select-list").hide();
                }
            });

            //sns 슬라이드
            var Snsswiper = new Swiper('.sns-slide', {
                slidesPerView: 'auto',
                // centeredSlides: true,
                spaceBetween: 32,
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                speed: 500,
                pagination: {
                    el: '.sns-paging',
                    type: "progressbar",
                },
                navigation: {
                    nextEl: '.sns-next',
                    prevEl: '.sns-prev',
                },
            });

            //흙침대 이야기
            if( ($(document).width()) < 768 ) {
                var sec2_slide = new Swiper('.sec2-slide', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    autoplay: false,
                    speed: 500,
                    pagination: {
                        el: '.sec2-paging',
                    },
                });
            }

            //탭
            $('.sec-3 .tab-link li').click(function(){
                $(".sec-3 .tab-link li").removeClass("active");
                $(this).addClass("active");
                var tab_id = $(this).attr('data-tab');
                $('.sec-3 .tab-content').removeClass('active');

                $(".sec-3 .tab-content#"+tab_id).addClass('active');

                if( $(".sec-3 .tab-content").hasClass('active') ) {
                    $('.left-box').removeClass('animate__fadeInLeft')
                    $('.top-box').removeClass('animate__fadeInRight')
                    $('.btm-box').removeClass('animate__fadeInUp')
                    $(".sec-3 .tab-content.active").find('.left-box').addClass('animate__fadeInLeft')
                    $(".sec-3 .tab-content.active").find('.top-box').addClass('animate__fadeInRight')
                    $(".sec-3 .tab-content.active").find('.btm-box').addClass('animate__fadeInUp')
                }

            });

            //탭
            $('.sec-1 .sec-con-list li').click(function(){
                $(".sec-1 .sec-con-list li").removeClass("active");
                $(this).addClass("active");
                var tab_id = $(this).attr('data-tab');
                $('.sec-1 .tab-content').removeClass('active');

                $(".sec-1 .tab-content[name="+tab_id+"]").addClass('active');

            });

            AOS.init({
                easing: 'ease-out',
                delay: 50
            });
        }, 300);

    }
}
</script>
