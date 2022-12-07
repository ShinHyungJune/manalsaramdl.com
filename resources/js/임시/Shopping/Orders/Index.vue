<template>
    <main class="mypage mypage-order mypage-order1">
        <div class="mypage-wrap container col-group">
            <sidebar />
            <div class="right-wrap">
                <state />

                <section>
                    <div class="sec-title">
                        <h2>
                            주문/배송조회
                        </h2>
                    </div>
                    <div class="sec-con">
                        <table class="cart-table">
                            <colgroup>
                                <col width="20%">
                                <col width="50%">
                                <col width="20%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>
                                    주문 정보
                                </th>
                                <th>
                                    상품 정보
                                </th>
                                <th>
                                    배송 현황
                                </th>
<!--                                <th>
                                    배송비 정보
                                </th>-->
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="orderProducts.data.length === 0">
                                <td colspan="4">
                                    <div class="m-empty type01">
                                        데이터가 없습니다.
                                    </div>
                                </td>
                            </tr>
                            <tr v-for="orderProduct in orderProducts.data" :key="orderProduct.id">
                                <td>
                                    <div class="row-group">
                                        <p>
                                            주문일자
                                            <span>{{ orderProduct.order.created_at }}</span>
                                        </p>
                                        <p>
                                            주문번호
                                            <span>{{ orderProduct.order.merchant_uid }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-group order-box">
                                        <div class="left-box">
                                            <a :href="`/shopping/products/${orderProduct.product.id}`" class="img-box">
                                                <img :src="orderProduct.product.img ? orderProduct.product.img.url : ''" alt="">
                                            </a>
                                        </div>
                                        <div class="right-box">
                                            <h3>
                                                {{ orderProduct.product.title }} (+ {{orderProduct.product.discounted_price.toLocaleString()}})
                                            </h3>
                                            <ul>
                                                <li>
                                                    색상 : {{ orderProduct.product.color }}
                                                </li>
                                                <li>
                                                    {{ productTotalPrice(orderProduct.product).toLocaleString() }}원
                                                </li>
                                            </ul>
                                            <p v-for="optionProduct in orderProduct.product.optionProducts" :key="optionProduct.id">
                                                {{ optionProduct.title }} x {{optionProduct.count}} 포함 (+{{(optionProduct.count * optionProduct.price).toLocaleString()}})
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row-group">
                                        <div class="top-box">
                                            <h3>
                                                {{ orderProduct.state }}
                                            </h3>
                                            <p v-if="orderProduct.delivery_number">
<!--                                                <span>{{ orderProduct.updated_at }}</span>-->
                                                <span>{{orderProduct.delivery_company}} <span class="blue">{{ orderProduct.delivery_number }}</span></span>
                                            </p>
                                        </div>
                                        <a :href="orderProduct.delivery_url" target="_blank" v-if="orderProduct.delivery_number">
                                            배송조회
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <ul>
<!--                                        <li>
                                            <a href="consultation.html">
                                                1:1 문의
                                            </a>
                                        </li>-->
                                        <li>
                                            <a :href="`/shopping/reviews/create?order_product_id=${orderProduct.id}`" v-if="orderProduct.can_review">
                                                리뷰쓰기
                                            </a>
                                        </li>
                                        <li>
                                            <a :href="`/shopping/refunds/create?order_product_id=${orderProduct.id}`" v-if="orderProduct.can_refund">
                                                반품접수
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="orderProducts.meta" @paginate="(page) => {form.page = page; filter()}" />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>


</template>
<script>
import Sidebar from "../../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import State from "../../../Components/State";

export default {
    components: {State, Sidebar, Link, Pagination},
    data() {
        return {
            orderProducts: this.$page.props.orderProducts,
            form: this.$inertia.form({
                page: 1,
            })
        }
    },
    methods: {
        state(state) {
            if (state === "WAIT")
                return "결제대기";

            if (state === "SUCCESS")
                return "결제완료";

            if (state === "REFUND")
                return "환불";
        },

        filter() {
            this.form.get("/shopping/orders");
        },

        ready() {
            alert('준비중입니다.');
        },

        productLink(orderProduct) {
            return orderProduct.product_diet
                ? "/dietProducts/create?diet_product_id=" + orderProduct.product_diet_product_id
                : "/singleProducts/" + orderProduct.product_id;
        },

        optionProducts(product) {
            let text = "";

            let total = product.optionProducts.length;

            product.optionProducts.map((optionProduct, index) => {
                if (index === total - 1)
                    return text += optionProduct.title;

                return text += optionProduct.title + " / ";
            });

            return text;
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
