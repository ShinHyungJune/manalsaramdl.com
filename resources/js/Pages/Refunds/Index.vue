<template>
    <div class="mypage-wrap col-group">
        <sidebar />

        <div class="right-wrap">
            <div class="title-wrap col-group">
                <h2>환불내역</h2>
                <a href="/orders" class="refund-btn">결제내역</a>
            </div>

            <div class="con-wrap">
                <ul class="payment-list row-group">
                    <li v-for="refund in refunds.data" :key="refund.id">
                        <div class="tr col-group">
                            <div class="title-box row-group">
                                <span class="label">{{ refund.order.product.type }}</span>
                                <p class="title">{{ refund.order.product.title }}</p>
                            </div>
                            <ul class="payment-box col-group">
                                <li>
                                    <p class="title">환불요청날짜</p>
                                    <p class="txt">{{ refund.created_at }}</p>
                                </li>
                                <li>
                                    <p class="title">환불요청사유</p>
                                    <p class="txt">{{ refund.reason_request }}</p>
                                </li>
                                <li>
                                    <p class="title">결제날짜</p>
                                    <p class="txt">{{ refund.order.created_at }}</p>
                                </li>
                                <li>
                                    <p class="title">결제금액</p>
                                    <p class="txt">{{ refund.order.price.toLocaleString() }}</p>
                                </li>
                                <li>
                                    <p class="title">상태</p>
                                    <p class="txt state">{{ refund.state }}</p>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <div class="m-empty type01" v-if="refunds.data.length === 0">데이터가 없습니다.</div>

            </div>
        </div>
    </div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";
import Sidebar from "../../Components/Sidebar";

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {
            refunds: this.$page.props.refunds,

            form: this.$inertia.form({
                page: 1,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/refund", {
                preserveScroll: false,
                preserveState: false,
            });
        },

        productTotalPrice(product){
            let total = 0;
            let optionPrice = 0;

            product.discounted_price;

            product.optionProducts.map(optionProduct => optionPrice += optionProduct.price * optionProduct.count);

            total = (product.discounted_price + optionPrice) * product.count;

            return total;
        },
    }
}
</script>
