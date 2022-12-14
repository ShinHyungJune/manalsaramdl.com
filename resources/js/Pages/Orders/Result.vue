<template>
    <main class="mypage mypage mypage-order mypage-order-create mypage-order-done">
        <div class="mypage-wrap container">
            <div class="sec-top col-group">
                <h2>
                    주문 완료
                </h2>
                <ul class="col-group">
                    <li>
                        장바구니
                    </li>
                    <li>
                        <i class="xi-angle-right"></i>
                    </li>
                    <li>
                        주문서 작성
                    </li>
                    <li>
                        <i class="xi-angle-right"></i>
                    </li>
                    <li>
                        <strong>
                            주문완료
                        </strong>
                    </li>
                </ul>
            </div>
            <section> <!-- 비회원 주문시 노출됩니다 -->
                <div class="sec-con">
                    <div class="txt-box row-group" v-if="order.state === 'SUCCESS'">
                        <h2>
                            주문이 정상적으로 완료되었습니다.
                        </h2>
                    </div>
                    <div class="txt-box row-group" v-else>
                        <h2 style="color:red;">
                            주문에 실패하였습니다.
                        </h2>
                        <p>
                            {{order.reason}}
                        </p>
                    </div>
                    <div class="notice">
                        <h3>
                            배송 안내
                        </h3>
                        <ul>
                            <li>
                                소물류는 2~3일 정도 소요되며,
                                <br>
                                가구의 경우 일반적으로 제품 주문 후 7일 ~ 10일 정도 소요합니다.
                                <br>
                                단, 성수기(9월~12월)에는 주문서 접수 후 5일 이상 더 소요될수 있습니다.
                            </li>
                        </ul>
                        <h3>
                            적립금 안내
                        </h3>
                        <ul>
                            <li>
                                제품 구매시 총 구매금액의 5%만큼의 포인트가 적립되며 차후 제품 구입시 차감을 받을 수 있습니다.
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <div class="sec-wrap col-group">
                <section>
                    <div class="sec-title">
                        <h2>
                            결제/배송 정보
                        </h2>
                    </div>
                    <div class="sec-con">
                        <ul class="row-group">
                            <li class="col-group">
                                <p class="default">
                                    배송지
                                </p>
                                <div class="user row-group">
                                    <p>
                                        {{ order.delivery_name }}
                                    </p>
                                    <p>
                                        {{ order.delivery_contact }}
                                    </p>
                                    <p>
                                        {{order.delivery_address}} {{order.delivery_address_detail}} ({{order.delivery_address_zipcode}})
                                    </p>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    서비스 가능시간
                                </p>
                                <p class="user">
                                    {{ order.service_time }}
                                </p>
                            </li>
                        </ul>
                        <ul class="row-group">
                            <li class="col-group">
                                <p class="default">
                                    주문일자
                                </p>
                                <p class="user">
                                    {{ order.created_at }}
                                </p>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    주문번호
                                </p>
                                <p class="user">
                                    {{ order.merchant_uid }}
                                </p>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    결제수단
                                </p>
                                <p class="user">
                                    {{ order.pay_method_name }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </section>
                <section>
                    <div class="sec-title">
                        <h2>
                            결제 금액 및 혜택
                        </h2>
                    </div>
                    <div class="sec-con">
                        <ul class="row-group">
                            <li class="col-group">
                                <p class="default">
                                    총 결제금액
                                </p>
                                <p class="user">
                                    <span>{{order.price.toLocaleString()}}</span>원
                                </p>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>

            <a href="/shopping" class="home-btn">
                홈으로 가기
            </a>
        </div>
    </main>
</template>
<script>
import Pagination from "../../Components/Pagination";
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link, Pagination},

    data() {
        return {
            order: this.$page.props.order.data,
        }
    },

    methods: {

    },

    computed:{

    }
}
</script>
