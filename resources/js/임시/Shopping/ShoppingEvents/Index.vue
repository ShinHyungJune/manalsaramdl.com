<template>
    <main class="inquiry-wrap events">
        <div class="container">
            <div class="sub-title col-group" v-if="form.type === '이벤트'">
                <h2>
                    이벤트
                </h2>
                <a href="/shopping/shoppingEvents?type=기획전">
                    기획전 바로가기
                    <i class="xi-angle-right"></i>
                </a>
            </div>
            <div class="sub-title col-group" v-else>
                <h2>
                    기획전
                </h2>
                <a href="/shopping/shoppingEvents?type=이벤트">
                    이벤트 바로가기
                    <i class="xi-angle-right"></i>
                </a>
            </div>
            <div class="sub-con">
                <ul class="board-list col-group">
                    <li v-if="shoppingEvents.data.length === 0" style="width:100%;">
                        <div class="m-empty type01">
                            데이터가 없습니다.
                        </div>
                    </li>
                    <li v-for="shoppingEvent in shoppingEvents.data" :key="shoppingEvent.id">
                        <a :href="`/shopping/shoppingEvents/${shoppingEvent.id}`">
                            <div class="img-box">
                                <img :src="shoppingEvent.img ? shoppingEvent.img.url : ''" alt="">
                            </div>
                            <div class="txt-box row-group">
                                <p class="title">
                                    {{ shoppingEvent.title }}
                                </p>
                                <p class="sub-title">
                                    {{ shoppingEvent.subtitle }}
                                </p>
                                <p class="date">
                                    이벤트 기간 :
                                    <span>{{ shoppingEvent.started_at }} ~ {{ shoppingEvent.finished_at }}</span>
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>

                <div style="margin-top:40px"></div>

                <pagination :meta="shoppingEvents.meta" @paginate="(page) => {form.page = page; filter()}" />
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
            shoppingEvents: this.$page.props.shoppingEvents,
            form: this.$inertia.form({
                page: 1,
                type: this.$page.props.type
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/shoppingEvents", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.shoppingEvents = page.props.shoppingEvents;
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
