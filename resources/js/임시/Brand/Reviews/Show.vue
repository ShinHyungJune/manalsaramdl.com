<template>
    <main class="review review_detail">
        <div class="sub-con">
            <div class="container col-group">
                <div class="prod-more mb">
                    <a :href="`/shopping/products/${review.product.id}`" class="prod-box col-group" target="_blank">
                        <div class="left">
                            <div class="img-box">
                                <img :src="review.product.img.url" alt="">
                            </div>
                        </div>
                        <div class="txt-box row-group">
                            <h2>
                                {{ review.product.title }}
                            </h2>
                            <span>
                                    view more
                                </span>
                        </div>
                    </a>
                </div>
                <div class="slide-wrap">
                    <div class="swiper review-slide2" style="overflow:hidden;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(img, index) in review.imgs" :key="index">
                                <div class="img-box">
                                    <img :src="img.url" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper review-slide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="(img, index) in review.imgs" :key="index">
                                <div class="img-box">
                                    <img :src="img.url" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-wrap row-group">
                    <div class="prod-box col-group pc">
                        <a target="_blank" :href="`/shopping/products/${review.product.id}`" class="left">
                            <div class="img-box">
                                <img :src="review.product.img ? review.product.img.url : ''" alt="">
                            </div>
                        </a>
                        <div class="txt-box row-group">
                            <h2>
                                {{review.product.title}}
                            </h2>
                            <div>
                                    <span class="non-discount-price" v-if="review.product.value_discount">
                                        {{ review.product.price.toLocaleString() }}
                                    </span>
                                <p class="discount-price">
                                    SALE
                                    <span>
                                            {{ review.product.discounted_price.toLocaleString() }}
                                        </span>
                                </p>
                                <ul class="store-type col-group">
                                    <li v-if="review.product.department_store">
                                        백화점
                                    </li>
                                    <li v-if="review.product.direct_store">
                                        온라인
                                    </li>
                                    <li v-if="review.product.agency_store">
                                        대리점
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="review-box">
                        <div class="review-top">
                            <div class="col-group">
                                <span :class="`review-score s${review.point}`"></span>
                                <span class="date">{{review.created_at}}</span>
                            </div>
                            <div class="col-group">
                                <p class="title">
                                    {{ review.title }}
                                </p>
<!--                                <span class="writer">
                                        {{ review }}
                                    </span>-->
                            </div>
                        </div>
                        <div class="review-con">
                                <pre v-html="review.description"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-wrap container col-group">
            <a href="#" @click="back">
                뒤로가기
            </a>
<!--            <a href="/review_edit.html" class="edit-btn"> &lt;!&ndash; 본인이 작성한 리뷰일 때 보이기 &ndash;&gt;
                수정
            </a>-->
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import State from "../../../Components/State";
import Sidebar from "../../../Components/Sidebar";

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {
            review: this.$page.props.review.data,
            swiper: "",
            swiper2: "",
        }
    },
    methods:{
        back(e) {
            e.preventDefault();

            window.history.back();
        }
    },
    mounted() {

        let self = this;

        this.swiper  = new Swiper(".review-slide", {
            spaceBetween: 8,
            slidesPerView: 6,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                768: {
                    spaceBetween: 16,
                }
            },
        });

        this.swiper2 = new Swiper(".review-slide2", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            on: {
                "slideChange" : function(){
                    self.swiper.slideTo(this.activeIndex);

                    $(".review-slide .swiper-slide").removeClass("swiper-slide-thumb-active");
                    $(".review-slide .swiper-slide").eq(this.activeIndex).addClass("swiper-slide-thumb-active");
                }
            }
        });

        $(".review-slide .swiper-slide").click(function(){
            self.swiper2.slideTo($(this).index());
        });
    }
}
</script>
