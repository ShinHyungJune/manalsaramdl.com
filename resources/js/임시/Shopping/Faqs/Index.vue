<template>
    <main class="inquiry-wrap inquiry faq">
        <div class="container">
            <div class="sub-top col-group">
                <ul class="col-group">
                    <li>
                        <a href="/shopping/faqs" class="row-group active">
                            <h4>
                                FAQ
                            </h4>
                            <P>
                                자주 묻는 질문
                            </P>
                        </a>
                    </li>
                    <li>
                        <a href="/shopping/notices" class="row-group">
                            <h4>
                                NOTICE
                            </h4>
                            <P>
                                공지사항
                            </P>
                        </a>
                    </li>
                    <li>
                        <a href="/shopping/qnas/create" class="row-group">
                            <h4>
                                Q&A
                            </h4>
                            <P>
                                1:1 문의하기
                            </P>
                        </a>
                    </li>
                </ul>
                <div class="col-group">
                    <div class="row-group">
                        <p>
                            흙표흙침대 고객센터
                            <strong>
                                080-315-5233
                            </strong>
                        </p>
                    </div>
                    <div class="row-group">
                        <p>
                            월요일-금요일 09:00~16:30
                            <span>
                                    토/일요일/공휴일 휴무
                                </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="sub-con">
                <div class="sub-con-top col-group">
                    <div class="sub-title col-group">
                        <h2>
                            FAQ
                        </h2>
                        <p>
                            자주 묻는 질문
                        </p>
                    </div>
                    <form action="" @submit.prevent="filter">
                        <div class="search-box">
                            <input type="text" placeholder="궁금한 내용을 검색하세요." v-model="form.word">
                            <button type="submit">
                                <img src="/images/icon_search.svg" alt="">
                            </button>
                        </div>
                    </form>
                </div>
                <ul class="faq-list tab-content active" id="tab_1">
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

                <div style="margin-top:40px;"></div>

                <pagination :meta="faqs.meta" @paginate="(page) => {form.page = page; filter()}" />

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
            form: this.$inertia.form({
                page: 1,
                type: this.$page.props.type,
                word: this.$page.props.word,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/faqs", {
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
