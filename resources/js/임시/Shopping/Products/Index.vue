<template>
    <main class="product">
        <div class="subpage-wrap container row-group">
            <div class="sec-top">
                <ul class="prod-list col-group">
                    <li v-for="representProduct in representProducts.data" :key="representProduct.id">
                        <product :product="representProduct" type="type01" />
                    </li>
                </ul>
            </div>

            <div class="sec-con">
                <div class="sec-con-top col-group">
                    <p>
                        총 <span>{{products.meta.total}}</span>개 상품
                    </p>
                    <ul class="align-list col-group">
                        <li :class="isActive('created_at', 'desc') ? 'active' : ''">
                            <a href="" @click.prevent="form.orderBy = 'created_at'; form.align = 'desc'; filter();">
                                신상품
                            </a>
                        </li>
                        <li :class="isActive('title', 'asc') ? 'active' : ''">
                            <a href="" @click.prevent="form.orderBy = 'title'; form.align = 'asc'; filter();">
                                상품명
                            </a>
                        </li>
                        <li :class="isActive('discounted_price', 'asc') ? 'active' : ''">
                            <a href="" @click.prevent="form.orderBy = 'discounted_price'; form.align = 'asc'; filter();">
                                낮은가격
                            </a>
                        </li>
                        <li :class="isActive('discounted_price', 'desc') ? 'active' : ''">
                            <a href="" @click.prevent="form.orderBy = 'discounted_price'; form.align = 'desc'; filter();">
                                높은가격
                            </a>
                        </li>
<!--                        <li>
                            <a href="">
                                사용후기
                            </a>
                        </li>-->
                    </ul>
                </div>

                <ul class="prod-list col-group">
                    <li style="width:100%;">
                        <div class="m-empty type01" v-if="products.data.length === 0">
                            데이터가 없습니다.
                        </div>
                    </li>
                    <li v-for="product in products.data" :key="product.id">
                        <product :product="product" type="type01" />
                    </li>
                </ul>

                <div class="pagination col-group" id="pagination">
                    <pagination :meta="products.meta" @paginate="(page) => {form.page = page; filter()}"/>
                </div>

            </div>
        </div>

    </main>


</template>
<script>
import Sidebar from "../../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import Product from "../../../Components/Product";

export default {
    components: {Product, Sidebar, Link, Pagination},
    data() {
        return {
            products: this.$page.props.products,
            representProducts: this.$page.props.representProducts,
            form: this.$inertia.form({
                page: 1,
                orderBy : this.$page.props.orderBy,
                align: this.$page.props.align,
                category_id: this.$page.props.category_id,
                sub_category_id: this.$page.props.sub_category_id,
                mood_id: this.$page.props.mood_id,
            }),
            likeForm: this.$inertia.form({
                product_id: ""
            }),
            cartForm: this.$inertia.form({
                product_id: ""
            })
        }
    },
    methods: {
        filter() {
            this.form.get("/shopping/products", {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.products = page.props.products;
                    this.representProducts = page.props.representProducts;
                }
            });
        },

        like(event, product){
            event.stopPropagation();
            event.preventDefault();

            this.likeForm.product_id = product.id;

            this.likeForm.post("/likes", {
                preserveScroll: true,
                preserveState: false,
                onSuccess: (page) => {
                    $(event.target).toggleClass("active");
                }
            });
        },

        addToCart(product){

        },

        isActive(orderBy, align){
            return this.form.orderBy === orderBy && this.form.align === align;
        }
    }
}
</script>
