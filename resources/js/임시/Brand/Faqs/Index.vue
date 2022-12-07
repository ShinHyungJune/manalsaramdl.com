<template>
    <main class="inquiry faq">
        <div class="sub-top">
            <h2>
                자주 묻는 질문
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
                    <a href="/brand/faqs">
                        고객지원
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="#">
                        자주 묻는 질문
                    </a>
                </li>
            </ul>
            <div class="section container">
                <div class="sec-top col-group">
                    <ul class="tab-link col-group">
                        <li :class="form.type === '' ? 'active' : ''" @click="form.type = ''; filter()">
                            전체
                        </li>
                        <li :class="form.type === type ? 'active' : ''" @click="form.type = type; filter()" v-for="type in types" :key="type">
                            {{ type }}
                        </li>
                    </ul>
                    <form action="" @submit.prevent="filter">
                        <div class="search-box">
                            <input type="text" placeholder="궁금한 내용을 검색하세요." v-model="form.word">
                            <button type="submit">
                                <img src="/images/icon_search.svg" alt="">
                            </button>

                            <div class="m-input-error">{{form.errors.word}}</div>
                        </div>
                    </form>
                </div>
                <div class="sec-mid">
                    <div class="m-empty type01" v-if="faqs.data.length === 0">
                        데이터가 없습니다.
                    </div>

                    <ul class="faq-list tab-content active" id="tab_1" style="display:block;">
                        <li v-for="faq in faqs.data" :key="faq.id">
                            <div class="qs col-group">
                                    <span class="icon">
                                        Q
                                    </span>
                                <p>
                                    {{ faq.title }}
                                </p>
                                <span class="open">
                                        <i class="xi-angle-down"></i>
                                    </span>
                            </div>
                            <div class="ans">
                                <div class="col-group">
                                        <span class="icon">
                                            A
                                        </span>
                                    <pre v-html="faq.description"></pre>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="pagination" class="pagination col-group">
                    <pagination :meta="faqs.meta" @paginate="(page) => {form.page = page; filter()}" />
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
            faqs: this.$page.props.faqs,
            types: this.$page.props.types,
            form: this.$inertia.form({
                page: 1,
                type: this.$page.props.type,
                word: this.$page.props.word,
            }),

        }
    },
    methods:{
        filter(){
            this.form.get("/brand/faqs", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.faqs = page.props.faqs;

                    let self = this;

                    setTimeout(function(){
                        self.initEvent();
                    }, 300);
                }
            });
        },

        initEvent(){
            $(".qs").off("click");
            $('.qs').click(function(){
                $(this).toggleClass('.close')
                $('.ans').stop().slideUp();
                $(this).next('.ans').stop().slideToggle();
            });

            //탭
            $(".tab-link li").off("click");
            $('.tab-link li').click(function(){
                $(".tab-link li").removeClass("active");
                $(this).addClass("active");
                var tab_id = $(this).attr('data-tab');
                $('.tab-content').removeClass('active');

                $(".tab-content#"+tab_id).addClass('active');
            });
        }
    },

    mounted() {
        this.initEvent();

    }
}
</script>
