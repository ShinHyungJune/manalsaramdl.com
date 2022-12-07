<template>
    <main class="mypage mypage-order mypage-order1 nonmember">
        <div class="sec-top container">
            <h2>
                비회원 주문 조회
            </h2>
            <a href="join.html">
                회원가입을 하시면 더 많은 혜택을 받으실 수 있습니다
                <i class="xi-angle-right"></i>
            </a>
        </div>
        <div class="mypage-wrap container col-group">
            <div class="left-wrap">
                <p>
                    흙표흙침대 고객센터
                </p>
                <h4>
                    080-315-5233
                </h4>
                <p>
                    월요일-금요일 09:00~16:30
                    <br>
                    (토/일요일/공휴일 휴무)
                </p>
            </div>
            <div class="right-wrap">
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
                                <col width="30%">
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
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="orderProducts.data.length === 0">
                                <td colspan="3">
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
                            </tr>
                            </tbody>
                        </table>
<!--                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="orderProducts.meta" @paginate="(page) => {form.page = page; filter()}" />
                        </div>-->
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

export default {
    components: {Sidebar, Link, Pagination},
    data() {
        return {
            orderProducts:this.$page.props.orderProducts,

        }
    },
    methods: {


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
