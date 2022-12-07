<template>
    <main class="library library_2">
        <div class="sub-top">
            <h2>
                라이브러리
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
                    <a href="/brand/history">
                        회사소개
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/brand/videos">
                        라이브러리
                    </a>
                </li>
            </ul>
            <div class="section container">
                <div class="sec-top col-group">
                    <ul class="tab-link col-group">
                        <li>
                            <a href="/brand/videos">
                                동영상
                            </a>
                        </li>
                        <li class="active">
                            <a href="/brand/supports">
                                협찬지원
                            </a>
                        </li>
                        <li>
                            <a href="/brand/magazines">
                                보도자료
                            </a>
                        </li>
                    </ul>
                    <div class="page-selector">
                        <p id="select_default">
                            {{ form.year == null || form.year == '' ? '전체' : form.year  }}


                        </p>
                        <ul class="select-list">
                            <li @click="form.year = ''; filter();">
                                전체
                            </li>
                            <li @click="form.year = 2022; filter();">
                                2022
                            </li>
                            <li @click="form.year = 2021; filter();">
                                2021
                            </li>
                            <li @click="form.year = 2020; filter();">
                                2020
                            </li>
                            <li @click="form.year = 2019; filter();">
                                2019
                            </li>
                            <li @click="form.year = 2018; filter();">
                                2018
                            </li>
                            <li @click="form.year = 2017; filter();">
                                2017
                            </li>
                            <li @click="form.year = 2016; filter();">
                                2016
                            </li>
                            <li @click="form.year = 2015; filter();">
                                2015
                            </li>
                        </ul>
                        <i class="xi-caret-down select-down"></i>
                    </div>
                </div>
                <div class="sec-mid">
                    <div class="m-empty type01" v-if="items.data.length === 0">데이터가 없습니다.</div>
                    <ul class="board-list col-group">
                        <li v-for="item in items.data" :key="item.id">
                            <a :href="`/brand/supports/${item.id}`">
                                <div class="img-box">
                                    <img :src="item.img ? item.img.url : ''" alt="">
                                </div>
                                <div class="txt-box row-group">
                                    <p class="title">
                                        {{ item.title }}
                                    </p>
                                    <p class="date">
                                        게시일자 :
                                        <span>
                                                {{ item.created_at }}
                                            </span>
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="pagination col-group" id="pagination">
                        <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />
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
            items: this.$page.props.items,
            form: this.$inertia.form({
                page: 1,
                year: this.$page.props.year
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/brand/supports", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.items = page.props.items;
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

        //업로드 연도 선택
        $("#select_default, .select-down").click(function(){
            $('#select_default').addClass('active');
            $('.select-down').fadeOut();
            $(this).siblings('.select-list').slideToggle();
            $(".select-list li").click(function(){
                var select_option = $(this).html();
                $(".select-list").hide();
                $('.select-down').fadeIn();
                $("#select_default").html(select_option);
                $("#select_default").removeClass('active');
            });
        });

    }
}
</script>
