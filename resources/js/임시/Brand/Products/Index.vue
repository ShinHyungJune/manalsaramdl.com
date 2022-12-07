<template>
    <div class="prod-subpage subpage">
        <main>
            <div class="subpage-wrap container">
                <div class="sub-con col-group" v-for="(item, index) in items" :key="index">
                    <div class="left-box">
                        <div class="img-box">
                            <img :src="item.mood.data.img ? item.mood.data.img.url : ''" alt="">
                        </div>
                    </div>
                    <div class="right-box row-group">
                        <div class="sub-title">
                            <h2>
                                {{ item.mood.data.title }}
                            </h2>
                            <a :href="`/shopping/products?mood_id=${item.mood.data.id}`" target="_blank">
                                전체보기 <i class="xi-angle-right"></i>
                            </a>
                        </div>
                        <ul class="prod-list col-group">
                            <li v-for="product in item.products.data" :key="product.id">
                                <a :href="`/shopping/products/${product.id}`" target="_blank">
                                    <div class="img-box">
                                        <img :src="product.img ? product.img.url : ''" alt="">
                                    </div>
                                    <div class="txt-box row-group">
                                        <h5>
                                            {{ product.title }}
                                        </h5>
                                        <div>
                                            <span class="non-discount-price" v-if="product.value_discount">
                                                {{ product.price.toLocaleString() }}원
                                            </span>
                                            <p class="discount-price" >
                                                <span class="discount" v-if="product.value_discount">
                                               {{product.type_discount === '비율할인' ? product.value_discount + "%" : "-" + (product.value_discount.toLocaleString())}}
                                                </span>
                                                <span>
                                                    {{ product.discounted_price.toLocaleString() }}원
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!--    <pagination :meta="notices.meta" @paginate="(page) => {form.page = page; filter()}" />-->
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import Product from "../../../Components/Product";

export default {
    components: {Product, Link, Pagination},
    data(){
        return {
            categories: this.$page.props.categories,
            items: this.$page.props.items,
            selectedCategory: this.$page.props.selectedCategory ? this.$page.props.selectedCategory.data : "",
            form: this.$inertia.form({
                page: 1,
                category_id: this.$page.props.category_id
            })
        }
    },

    methods:{
        filter(){
            this.form.get("/brand/products", {
                preserveScroll: true,
                preserveState: false,
                onSuccess: (page) => {

                }
            });
        },

    }
}
</script>
