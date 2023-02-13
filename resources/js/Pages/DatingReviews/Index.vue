<template>

    <main class="subpage review review_date">
        <!-- banner  -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Review</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 후기</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 소개팅 후기</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- //banner -->

        <div class="main-container">
            <div class="container">
                <div class="sub-top">
                    <h2 class="sub-title">
                        소개팅 후기
                    </h2>
                </div>

                <ul class="review-list col-group">
                    <li class="review-box" v-for="item in items.data" :key="item.id">
                        <a href="#" @click.prevent="move(item)">
                            <div class="bg-img">
                                <img :src="item.img ? item.img.url : ''" alt="">
                            </div>
                            <span class="sns-badge" v-if="item.platform === 'INSTAGRAM'"><img src="/images/sns-icon-insta.png" alt=""></span>
                            <span class="sns-badge" v-if="item.platform === 'NAVER'"><img src="/images/sns-icon-blog.png" alt=""></span>
                            <div class="txt-box">
                                <ul class="user-info col-group">
                                    <li>{{item.sex}}</li>
                                    <li>{{item.age}}</li>
                                    <li>{{item.job}}</li>
                                </ul>
                                <p class="title">
                                    {{item.title}}
                                </p>
                                <p class="txt">
                                    {{item.description.replace(/<\/?[^>]+>/ig, " ")}}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="m-empty type01" v-if="items.data.length === 0">데이터가 없습니다.</div>

                <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />

            </div>
        </div>

    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            items: this.$page.props.items,
            form: this.$inertia.form({
                page: 1,
            }),
        }
    },
    methods: {
        filter(){
            this.form.get("/datingReviews", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.items = page.props.items;
                }
            });
        },

        move(item){
            if(item.url)
                window.open(item.url, "pop", "_blank");

        }
    },
    computed: {

    }
}
</script>
