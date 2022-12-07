<template>
    <main class="events manual">
        <div class="sub-top">
            <h2>
                제품 매뉴얼
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
                    <a href="/brand/catalogs">
                        제품 매뉴얼
                    </a>
                </li>
            </ul>
            <div class="section container">
                <div class="sec-top col-group">
                    <ul class="tab-link col-group">
                        <li class="active" data-tab="tab_1">
                            카탈로그
                        </li>
                        <li data-tab="tab_2">
                            사용설명서
                        </li>
                    </ul>
                </div>

                <div class="sec-mid">
                    <div class="tab-content active" id="tab_1">
                        <div class="section container">
                            <div class="sec-mid">
                                <div class="m-empty type01" v-if="catalogs.data.length === 0">데이터가 없습니다.</div>
                                <ul class="board-list col-group">
                                    <li v-for="catalog in catalogs.data" :key="catalog.id">
                                        <div class="img-box">
                                            <img :src="catalog.img ? catalog.img.url : ''" alt="">
                                        </div>
                                        <div class="txt-wrap col-group">
                                            <div class="txt-box row-group">
                                                <p class="title">
                                                    {{ catalog.title }}
                                                </p>
                                                <p class="sub-title">
                                                    {{ catalog.subtitle }}
                                                </p>
                                            </div>
                                            <a :href="catalog.file ? catalog.file.url : ''" download="">
                                                <i class="xi-download"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="pagination col-group" id="pagination">
                                    <pagination :meta="catalogs.meta" @paginate="(page) => {form.page_catalog = page; filter()}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="tab_2">
                        <ul class="board-list col-group">
                            <div class="m-empty type01" v-if="guides.data.length === 0">데이터가 없습니다.</div>

                            <li v-for="guide in guides.data" :key="guide.id">
                                <div class="img-box">
                                    <img :src="guide.img ? guide.img.url : ''" alt="">
                                </div>
                                <div class="txt-wrap col-group">
                                    <div class="txt-box row-group">
                                        <p class="title">
                                            {{ guide.title }}
                                        </p>
                                        <p class="sub-title">
                                            {{ guide.subtitle }}
                                        </p>
                                    </div>
                                    <a :href="guide.file ? guide.file.url : ''" download="">
                                        <i class="xi-download"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="guides.meta" @paginate="(page) => {form.page_guide = page; filter()}" />
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
            guides: this.$page.props.guides,
            catalogs: this.$page.props.catalogs,
            form: this.$inertia.form({
                page_catalog: 1,
                page_guide: 1,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/brand/magazines", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.guides = page.props.guides;
                    this.catalogs = page.props.catalogs;
                }
            });
        },
    },
    mounted() {
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
