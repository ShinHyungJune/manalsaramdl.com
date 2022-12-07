<template>
    <main class="events">
        <div class="sub-top">
            <h2>
                이벤트
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
                    <a href="/brand/events">
                        이벤트
                    </a>
                </li>
            </ul>
            <div class="section container">
                <div class="sec-top col-group">
                    <ul class="tab-link col-group">
                        <li :class="form.type === '이벤트' ? 'active' : ''">
                            <a href="#" @click.prevent="form.type = '이벤트'; filter()">
                                진행중 이벤트
                            </a>
                        </li>
                        <li :class="form.type === '당첨자 발표' ? 'active' : ''">
                            <a href="#" @click.prevent="form.type = '당첨자 발표'; filter()">
                                당첨자 발표
                            </a>
                        </li>
<!--                        <li :class="form.type === 'SNS' ? 'active' : ''">
                            <a href="#" @click.prevent="form.type = 'SNS'; filter()">
                                SNS
                            </a>
                        </li>-->
                    </ul>

                    <ul class="sns-box col-group pc">
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
                </div>

                <div class="sec-mid">
                    <div class="tab-content active" style="display:block;">
                        <div class="m-empty type01" v-if="brandEvents.data.length === 0">데이터가 없습니다.</div>

                        <ul class="board-list col-group">
                            <li v-for="brandEvent in brandEvents.data" :key="brandEvent.id">
                                <a :href="`/brand/brandEvents/${brandEvent.id}`">
                                    <div class="img-box">
                                        <img :src="brandEvent.img ? brandEvent.img.url : ''" alt="">
                                    </div>
                                    <div class="txt-box row-group">
                                        <p class="title">
                                            {{ brandEvent.title }}
                                        </p>
                                        <p class="sub-title">
                                            {{ brandEvent.subtitle }}
                                        </p>
                                        <p class="date">
                                            이벤트 기간 :
                                            <span>
                                                    {{brandEvent.started_at}} ~ {{brandEvent.finished_at}}
                                                </span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="brandEvents.meta" @paginate="(page) => {form.page = page; filter()}" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            brandEvents: this.$page.props.brandEvents,
            form: this.$inertia.form({
                page: 1,
                type: this.$page.props.type
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/brand/brandEvents", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.brandEvents = page.props.brandEvents;
                }
            });
        },
    },
    mounted() {
        $('.qs').click(function(){
            $(this).toggleClass('.close')
            $('.ans').stop().slideUp();
            $(this).next('.ans').stop().slideToggle();
        });

        //탭
        $('.tab-link li').click(function(){
            $(".tab-link li").removeClass("active");
            $(this).addClass("active");
            var tab_id = $(this).attr('data-tab');
            $('.tab-content').removeClass('active');

            $(".tab-content#"+tab_id).addClass('active');
        });
    }
}
</script>
