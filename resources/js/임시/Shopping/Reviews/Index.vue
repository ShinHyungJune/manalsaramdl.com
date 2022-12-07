<template>
    <main class="mypage mypage-activity mypage-review">
        <div class="mypage-wrap container col-group">
            <sidebar />

            <div class="right-wrap">
                <state />

                <section>
                    <div class="sec-title col-group">
                        <h2>
                            나의 리뷰
                        </h2>
<!--                        <a href="/review_write.html">
                            <i class="xi-pen"></i>
                            리뷰쓰기
                        </a>-->
                    </div>
                    <div class="sec-con">
                        <table class="cart-table">
                            <colgroup>
                                <col width="10%">
                                <col width="80%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>
                                    작성일자
                                </th>
                                <th>
                                    상품 정보
                                </th>
                                <th>
                                    리뷰
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="reviews.data.length === 0">
                                <td colspan="3">
                                    <div class="m-empty type01">데이터가 없습니다.</div>
                                </td>
                            </tr>
                            <tr v-for="review in reviews.data" :key="review.id">
                                <td>
                                    <p class="col-group">
                                                <span class="mb">
                                                    주문일자
                                                </span>
                                        <span>
                                                    {{ review.orderProduct.order.created_at }}
                                                </span>
                                    </p>
                                </td>
                                <td>
                                    <div class="col-group">
                                        <div class="left-box">
                                            <a :href="`/shopping/products/${review.orderProduct.product.id}`" class="img-box">
                                                <img :src="review.orderProduct.product.img ? review.orderProduct.product.img.url : ''" alt="">
                                            </a>
                                        </div>

                                        <div class="right-box">
                                            <h3 style="margin-bottom:10px;">
                                                {{ review.orderProduct.product.title }} (+ {{review.orderProduct.product.discounted_price}})
                                            </h3>
                                            <p v-for="optionProduct in review.orderProduct.product.optionProducts" :key="optionProduct.id">
                                                {{optionProduct.title}} x {{optionProduct.count}} (+ {{(optionProduct.price * optionProduct.count).toLocaleString()}})
                                            </p>
                                            <h4 style="margin-top:10px;">
                                                총 {{ productTotalPrice(review.orderProduct.product).toLocaleString() }}원
                                            </h4>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row-group"> <!-- 리뷰 작성 완료 시 -->
                                        <p>
                                            작성 완료
                                        </p>
<!--                                        <a href="/mudmat_test/review_detail.html" target="_blank">
                                            리뷰보기
                                        </a>-->
                                    </div>
<!--                                    <div class="row-group"> &lt;!&ndash; 리뷰 미작성 시 &ndash;&gt;
                                        <a href="/mudmat_test/review_write.html" target="_blank">
                                            리뷰작성
                                        </a>
                                    </div>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="reviews.meta" @paginate="(page) => {form.page = page; filter()}" />
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
            reviews: this.$page.props.reviews,

            form: this.$inertia.form({
                page: 1,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/reviews", {
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
