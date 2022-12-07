<template>
    <main class="mypage mypage-order mypage-order2">
        <div class="mypage-wrap container col-group">

            <sidebar />

            <div class="right-wrap">

                <state />

                <section>
                    <div class="sec-title">
                        <h2>
                            취소/교환/반품
                        </h2>
                    </div>
                    <div class="sec-con">
                        <table class="cart-table">
                            <colgroup>
                                <col width="6%">
                                <col width="18%">
                                <col width="30%">
                                <col width="10%">
                                <col width="10%">
                                <col width="13%">
                                <col width="13%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>
                                    CS구분
                                </th>
                                <th>
                                    주문 정보
                                </th>
                                <th>
                                    상품 정보
                                </th>
                                <th>
                                    요청일자
                                </th>
                                <th>
                                    완료일자
                                </th>
                                <th>
                                    환불금액
                                </th>
                                <th>
                                    진행상태
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="refund in refunds.data" :key="refund.id">
                                <td>
                                    {{refund.type}}
                                </td>
                                <td>
                                    <div class="row-group">
                                        <p>
                                            주문일자
                                            <span>{{refund.orderProduct.order.created_at}}</span>
                                        </p>
                                        <p>
                                            주문번호
                                            <span>{{refund.orderProduct.order.merchant_uid}}</span>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <h3 style="margin-bottom:10px;">
                                        {{ refund.orderProduct.product.title }} (+ {{refund.orderProduct.product.discounted_price}})
                                    </h3>
                                    <p v-for="optionProduct in refund.orderProduct.product.optionProducts" :key="optionProduct.id">
                                        {{optionProduct.title}} x {{optionProduct.count}} (+ {{(optionProduct.price * optionProduct.count).toLocaleString()}})
                                    </p>
                                    <h4 style="margin-top:10px;">
                                        총 {{ productTotalPrice(refund.orderProduct.product).toLocaleString() }}원
                                    </h4>
                                </td>
                                <td>
                                    <p class="col-group" style="justify-content: center;">
                                        <span class="mb">요청일자</span>
                                        <span>{{ refund.created_at }}</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="col-group" style="justify-content: center;">
                                        <span class="mb">완료일자</span>
                                        <span v-if="state(refund) !== '진행중'">{{ refund.updated_at }}</span>
                                    </p>
                                </td>
                                <td>
                                    <div class="row-group">
<!--                                        <p>
                                            반품금액
                                            <span v-if="refund.price">{{ refund.price.toLocaleString() }}</span>
                                        </p>-->
                                        <p v-if="refund.price">
                                            환불금액
                                            <span>{{ refund.price.toLocaleString() }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    {{ state(refund) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div id="pagination" class="pagination col-group">
                            <pagination :meta="refunds.meta" @paginate="(page) => {form.page = page; filter()}" />
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import State from "../../../Components/State";
import Sidebar from "../../../Components/Sidebar";

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
        state(refund){
            if(refund.refunded === "")
                return "진행중";

            if(refund.refunded == 1)
                return "완료";

            if(refund.refunded == 0)
                return "반려";
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
