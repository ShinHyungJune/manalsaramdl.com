<template>
    <main class="about direction">
        <div class="sub-top">
            <h2>
                오시는 길
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
                    <a href="/brand/about">
                        회사소개
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/brand/wayToCome">
                        오시는 길
                    </a>
                </li>
            </ul>
            <div class="section container row-group">
                <ul class="sec-top col-group">
                    <li class="col-group">
                        <p class="default">
                            주소
                        </p>
                        <p class="user">
                            부산 사상구 학감대로192번길 60-30
                        </p>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            주차안내
                        </p>
                        <p class="user">
                            주차가 가능한 지상 주차장이 있습니다.
                        </p>
                    </li>
                </ul>
                <div class="sec-mid map-box">
                    <div id="daumRoughmapContainer1657255954066" class="root_daum_roughmap root_daum_roughmap_landing"></div>
                </div>
                <ul class="sec-btm col-group">
                    <li class="row-group bus">
                        <p class="default">
                            버스로 오시는 경우
                        </p>
                        <ul class="user row-group">
                            <li class="row-group">
                                <p>
                                    학장 (학장교차로 방면) 15153
                                </p>
                                <p class="col-group">
                                        <span>
                                            일반
                                        </span>
                                    <span>
                                            68, 168
                                        </span>
                                </p>
                            </li>
                            <li class="row-group">
                                <p>
                                    동양아파트 (부산구치소 방면) 15154
                                </p>
                                <p class="col-group">
                                        <span>
                                            일반
                                        </span>
                                    <span>
                                            68, 168
                                        </span>
                                </p>
                            </li>
                            <li class="row-group">
                                <p>
                                    사상전화국 (학장입구 방면) 15150
                                </p>
                                <p class="col-group">
                                        <span>
                                            일반
                                        </span>
                                    <span>
                                            8, 15, 161
                                        </span>
                                </p>
                            </li>
                            <li class="row-group">
                                <p>
                                    사상전화국 (부산구치소 방면) 15130
                                </p>
                                <p class="col-group">
                                        <span>
                                            일반
                                        </span>
                                    <span>
                                            59, 77, 108, 138
                                        </span>
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li class="row-group subway">
                        <p class="default">
                            지하철로 오시는 경우
                        </p>
                        <ul class="user row-group">
                            <li class="row-group">
                                <p class="col-group">
                                        <span>
                                            2호선
                                        </span>
                                    <span>
                                            주례역 7번출구 도보 19분
                                        </span>
                                </p>
                                <p class="col-group">
                                        <span>
                                            2호선
                                        </span>
                                    <span>
                                            감전역 1번출구 도보 20분
                                        </span>
                                </p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import Product from "../../../Components/Product";

export default {
    components: {Product, Link, Pagination},
    data(){
        return {

        }
    },

    methods:{

    },

    mounted() {
        new daum.roughmap.Lander({
            "timestamp" : "1657255954066",
            "key" : "2aw4n",
        }).render();
    }
}
</script>
