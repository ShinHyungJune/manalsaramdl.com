<template>
    <main class="review">
        <div class="sub-top">
            <h2>
                고객 후기
            </h2>
        </div>
        <div class="sub-con">
            <ul class="sub-con-top container col-group">
                <li>
                    <a href="/brand">
                        <i class="xi-home"></i>
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/brand/reviews">
                        흙소식
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/brand/reviews">
                        고객후기
                    </a>
                </li>
            </ul>
            <div class="sec-1">
                <div class="sec-con container">
                    <div class="swiper-container review-slide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="bestReview in bestReviews.data" :key="bestReview.id">
                                <a :href="`/brand/reviews/${bestReview.id}`" class="row-group">
                                    <div class="img-box">
                                        <img :src="bestReview.imgs.length > 0 ? bestReview.imgs[0].url : ''" alt="">
                                        <div class="txt-box row-group">
                                            <h4>
                                                {{ bestReview.product.title }}
                                            </h4>
<!--                                            <p>
                                                현대백화점 신촌점
                                            </p>-->
                                        </div>
                                    </div>
                                    <div class="review-box">
                                        <span :class="`review-score s${bestReview.point}`"></span>
                                        <h3>
                                            {{ bestReview.title }}
                                        </h3>
                                        <p>
                                            {{ bestReview.description }}
                                        </p>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="sec-2" v-if="reviewTip">
                <div class="sec-con container">
                    <img :src="reviewTip.pc ? reviewTip.pc.url : ''" alt="" class="pc">
                    <img :src="reviewTip.m ? reviewTip.m.url : ''" alt="" class="m">
                </div>
            </div>
            <div class="sec-3">
                <div class="sec-con container">
                    <h3>
                        찾으시는 제품의 후기가 있으신가요?
                    </h3>
                    <form action="" @submit.prevent="filter">
                        <div class="search-box">
                            <input type="text" placeholder="제품명을 입력해주세요" v-model="form.word">
                            <button type="submit">
                                <img src="/images/icon_search.svg" alt="">
                            </button>
                        </div>
                    </form>
                    <div class="sec-menu col-group">
                        <ul class="tab-link col-group">
                            <li :class="`${form.photo === '' ? 'active' : ''}`" @click="form.photo = ''; filter();">
                                전체보기
                            </li>
                            <li :class="`${form.photo === 1 ? 'active' : ''}`" @click="form.photo = 1; filter();">
                                포토리뷰
                            </li>
                            <li :class="`${form.photo === 0 ? 'active' : ''}`" @click="form.photo = 0; filter();">
                                텍스트 리뷰
                            </li>
                        </ul>
                        <a href="/brand/reviews/create">
                            <i class="xi-pen"></i>
                            리뷰쓰기
                        </a>
                    </div>
                    <div class="tab-content active">
                        <div class="m-empty type01" v-if="reviews.data.length === 0">
                            데이터가 없습니다.
                        </div>
                        <ul class="review-list col-group">
                            <li v-for="review in reviews.data" :key="review.id">
                                <a :href="`/brand/reviews/${review.id}`" class="img-box">
                                    <img :src="review.imgs.length > 0 ? review.imgs[0].url : ''" alt="">
                                    <div class="hover-box">
                                        <span :class="`review-score s${review.point}`"></span>
                                        <h3>
                                            {{ review.title }}
                                        </h3>
                                        <div class="txt-box col-group">
                                            <h4>
                                                {{ review.product.title }}
<!--                                                <span>
                                                        현대백화점 신촌점
                                                    </span>-->
                                            </h4>
                                            <i class="xi-angle-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="reviews.meta" @paginate="(page) => {form.page = page; filter()}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<style>
    .m {display:none !important;}

    @media screen and (max-width:768px) {
        .pc {display:none !important; width:100% !important;}
        .m {display:block !important; width:100% !important;}
    }
</style>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import State from "../../../Components/State";
import Sidebar from "../../../Components/Sidebar";

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {
            reviews: this.$page.props.reviews,
            bestReviews: this.$page.props.bestReviews,
            reviewTip: this.$page.props.reviewTip ? this.$page.props.reviewTip.data : '',

            form: this.$inertia.form({
                page: 1,
                photo: this.$page.props.photo,
                word: "",
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/brand/reviews", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.reviews = page.props.reviews;
                }
            });
        },

    },
    mounted() {
        var Snsswiper = new Swiper('.review-slide', {
            slidesPerView: 'auto',
            spaceBetween: 24,
            autoplay: {
                delay: 3000,
            },
            speed: 500,
            pagination: {
                el: '.swiper-pagination',
                type: "progressbar",
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    spaceBetween: 16,
                }
            }
        });
    }
}
</script>
