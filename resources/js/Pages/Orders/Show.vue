<template>
    <div class="orders-index subContent">
        <div class="wrap">
            <h3 class="subContent-title">
                마이페이지
            </h3>

            <div class="m-dashboard type01">
                <sidebar />

                <div class="m-dashboard-container">
                    <h3 class="title">주문상세</h3>

                    <div class="orders">
                        <div class="order">
                            <div class="head">
                                <div class="left">
                                    <span :class="`state ${order.state}`">{{state(order.state)}}</span>

                                    <h3 class="title">주문번호 : {{ order.merchant_uid }} <span class="sub">결제금액 : {{order.price_real.toLocaleString()}}원</span></h3>
                                    <div class="bodies" v-if="order.state === 'WAIT'">
                                        <p class="body">가상계좌 은행명 : {{order.vbank_name}}</p>
                                        <p class="body">가상계좌 계좌번호 : {{order.vbank_num}}</p>
                                        <p class="body">가상계좌 입금기한 : {{order.vbank_date}}</p>
                                    </div>
                                </div>
                                <div class="right">
                                    <Link :href="`/orders/cancel?order_id=${order.id}`" class="m-btn type05" v-if="order.can_cancel">주문취소</Link>
                                </div>
                            </div>
                            <div class="contents">
                                <div class="outgoings">
                                    <div class="outgoing" v-for="outgoing in order.outgoings" :key="outgoing.id">
                                        <div class="box-title">
                                            <h3 class="title">
                                                <a :href="`https://www.lotteglogis.com/home/reservation/tracking/linkView?InvNo=${outgoing.delivery_number}`" target="_blank" class="state" v-if="outgoing.state === 'ONGOING'">{{outgoingState(outgoing.state, order)}}</a>
                                                <span class="state" v-else>{{outgoingState(outgoing.state, order)}}</span>
                                                수령예정일 : {{ outgoing.delivery_at }}
                                            </h3>
                                        </div>

                                        <div class="products">
                                            <div class="product" v-for="orderProduct in outgoing.orderProducts" :key="orderProduct.id">
                                                <Link :href="productLink(orderProduct)" class="left">
                                                    <div class="m-ratioBox-wrap">
                                                        <div class="m-ratioBox">
                                                            <img :src="orderProduct.img ? orderProduct.img.url : ''" alt="">
                                                        </div>
                                                    </div>

                                                    <h3 class="title">{{ orderProduct.product_title }} {{orderProduct.count}}개</h3>
                                                </Link>

                                                <div class="right">
<!--
                                                    <p class="title">{{ (product.product_price * product.count).toLocaleString() }}원</p>
-->

                                                    <Link :href="`/reviews/create?product_id=${orderProduct.product_id}`" class="m-btn type05" v-if="canReview(outgoing, orderProduct)">후기</Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
export default {
    components: {Sidebar, Link, Pagination},
    data(){
        return {
            order: this.$page.props.order.data,
        }
    },
    methods:{
        state(state){
            if(state === "WAIT")
                return "결제대기";

            if(state === "SUCCESS")
                return "결제완료";

            if(state === "REFUND")
                return "환불";
        },

        outgoingState(state, order){
            if(order.state === "WAIT")
                return "주문대기";

            if(state === "FAIL")
                return "주문취소";

            if(state === "WAIT")
                return "주문접수";

            if(state === "READY")
                return "상품준비";

            if(state === "ONGOING")
                return "배송조회하기";

            if(state === "DONE")
                return "배송완료";
        },

        filter(){
            this.form.get("/orders");
        },

        canReview(outgoing, orderProduct){
            return outgoing.state === "DONE" && !orderProduct.product_diet;
        },

        productLink(orderProduct){
            return orderProduct.product_diet
                ? "/dietProducts/create?diet_product_id=" + orderProduct.product_diet_product_id
                : "/singleProducts/" + orderProduct.product_id;
        },
    }
}
</script>
