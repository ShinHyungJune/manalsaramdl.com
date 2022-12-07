<template>
    <main class="mypage mypage-cart">
        <div class="mypage-wrap container col-group">
            <sidebar />

            <div class="right-wrap">

                <state />
                <section>
                    <div class="sec-title">
                        <h2>
                            장바구니
                        </h2>
                    </div>
                    <div class="sec-con">
                        <table class="cart-table">
                            <colgroup>
                                <col width="5%">
                                <col width="65%">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>
                                    <label for="" v-if="selectedProducts.length === products.data.length && selectedProducts.length !== 0" @click="removeAll">
                                        <input type="checkbox" name="cart-check" checked>
                                        <span class="check-icon"></span>
                                    </label>
                                    <label for="" v-else @click="addAll">
                                        <input type="checkbox" name="cart-check">
                                        <span class="check-icon"></span>
                                    </label>
                                </th>
                                <th>
                                    상품 정보
                                </th>
                                <th>
                                    개수
                                </th>
                                <th>
                                    총 결제 액
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="products.data.length === 0">
                                <td colspan="5">
                                    <div class="m-empty type01">데이터가 없습니다.</div>
                                </td>
                            </tr>
                            <tr v-for="product in products.data" :key="product.id">
                                <td>
                                    <label :for="product.id">
                                        <input type="checkbox" :id="product.id" :value="product.id" v-model="form.product_ids">
                                        <span class="check-icon"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="col-group order-box">
                                        <div class="left-box">
                                            <a :href="`/shopping/products/${product.id}`" class="img-box">
                                                <img :src="product.img ? product.img.url : ''" alt="">
                                            </a>
                                        </div>
                                        <div class="right-box">
                                            <h3>
                                                {{ product.title }}
                                            </h3>
                                            <ul>
                                                <li>
                                                    색상 : {{ product.color }}
                                                </li>
                                                <li>
                                                    {{ product.discounted_price }}원
                                                </li>
                                            </ul>
                                            <p v-for="optionProduct in product.optionProducts" :key="optionProduct.id">
                                                {{ optionProduct.title }} x {{optionProduct.count}} (+{{ (optionProduct.price * optionProduct.count).toLocaleString() }})
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{product.count}}
                                </td>
                                <td>
                                    <p class="col-group" style="justify-content: center">
                                        <span class="mb">총 결제액</span>
                                        <span>{{ productTotalPrice(product).toLocaleString() }}</span>
                                    </p>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <button type="button" class="del" @click="removeSelected">
                            선택삭제
                        </button>

                        <pagination :meta="products.meta" @paginate="(page) => {form.page = page; filter()}" />
                    </div>
                    <div class="sec-footer">
                        <table>
                            <colgroup>
                                <col width="calc(100% / 3)">
                                <col width="calc(100% / 3)">
                                <col width="calc(100% / 3)">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>
                                    총 주문금액
                                </th>
                                <th>
                                    총 배송비
                                </th>
                                <th>
                                    총 결제금액
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="col-group">
                                        <span class="mb">총 주문금액</span>
                                        <span>{{ totalPrice.toLocaleString() }}</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="col-group">
                                        <span class="mb">총 배송비</span>
                                        <span>{{deliveryPrice.toLocaleString()}}</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="col-group">
                                        <span class="mb">총 결제금액</span>
                                        <span>{{ realPrice.toLocaleString() }}</span>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="button" @click="order">
                            구매하기
                        </button>
                    </div>
                </section>
            </div>
        </div>

    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import Sidebar from "../../../Components/Sidebar";
import State from "../../../Components/State";

export default {
    components: {State, Sidebar, Link, Pagination},
    data(){
        return {
            products: this.$page.props.products,

            form: this.$inertia.form({
                page: 1,
                product_ids : []
            }),

            orderForm: this.$inertia.form({
                product_ids: [],
                direct: 0,
            }),

            loading: false,

            basic: this.basic ? this.basic.data : "",
        }
    },

    methods: {
        optionProducts(product){
            let text = "";

            let total = product.optionProducts.length;

            product.optionProducts.map((optionProduct, index) => {
                if(index === total - 1)
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

        filter(){
            this.loading = true;

            this.form.get("/carts", {
                preserveScroll: true,
                preserveState: true,
                replace: true,
                onSuccess: (response) => {
                    this.loading = false;

                    return this.products = response.props.products;
                }
            });
        },

        toggleFilter(event){
            event.preventDefault();
            event.stopPropagation();

            this.activated = !this.activated;
        },

        removeAll(){
            this.form.product_ids = [];
        },

        remove(product){
            this.cartProductForm.product_id = product.id;

            this.cartProductForm.delete("/carts/detachOne", {
                preserveState: true,
                preserveScroll:true,
                onSuccess: (page)=>{
                    this.products = page.props.products;
                }
            });
        },

        addAll(){
            this.form.product_ids = this.products.data.map(product => product.id);
        },

        removeSelected(){
            this.products.data = this.products.data.filter(product => !this.form.product_ids.some(product_id => product_id == product.id));

            this.form.delete("/carts/detach");
        },

        order(){
            this.orderForm.product_ids = this.form.product_ids;

            this.orderForm.get("/shopping/orders/create");
        },

        addProduct(product){
            if(product.count <= 99){
                this.cartProductForm.count = product.count + 1;
                this.cartProductForm.product_id = product.id;

                this.cartProductForm.patch("/carts", {
                    preserveState:true,
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.products = page.props.products;
                    }
                });
            }
        },

        decreaseProduct(product){
            if(product.count > 1){
                this.cartProductForm.count = product.count - 1;
                this.cartProductForm.product_id = product.id;

                this.cartProductForm.patch("/carts", {
                    preserveState:true,
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.products = page.props.products;
                    }
                });
            }
        },
    },

    computed:{
        totalPrice(){
            let total = 0;

            this.selectedProducts.map(product => {
                total += this.productTotalPrice(product);
            });

            return total;
        },

        realPrice(){
            return parseInt(this.totalPrice) + parseInt(this.deliveryPrice);
        },

        selectedProducts(){
            return this.products.data.filter(product => this.form.product_ids.includes(product.id));
        },

        deliveryPrice(){
            let needDelivery = this.selectedProducts.some(product => {
                 return product.need_delivery;
            });

            if(!needDelivery)
                return 0;

            if(!this.basic)
                return 0;

            return this.totalPrice < this.basic.price_min_delivery_discount ? this.basic.price_delivery : 0;
        }
    },
}
</script>
