<template>
    <main class="mypage mypage-interest mypage-history">
        <div class="mypage-wrap container col-group">
            <sidebar />
            <div class="right-wrap">
                <state />

                <section class="mypage-history">
                    <div class="sec-title">
                        <h2>
                            최근 본 상품
                        </h2>
                    </div>
                    <div class="sec-con">
                        <ul class="prod-list col-group">
                            <li v-if="latestProducts.data.length === 0">
                                <div class="m-empty type01">데이터가 없습니다.</div>
                            </li>
                            <li v-for="latestProduct in latestProducts.data" :key="latestProduct.id">
                                <product :product="latestProduct.product" type="type01" />
                            </li>
                        </ul>
                    </div>

                    <div class="pagination col-group" id="pagination">
                        <pagination :meta="latestProducts.meta" @paginate="(page) => {form.page = page; filter()}" />
                    </div>
                </section>
            </div>
        </div>

    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import Product from "../../../Components/Product";
import Sidebar from "../../../Components/Sidebar";
import State from "../../../Components/State";

export default {
    components: {State, Sidebar, Product, Link, Pagination},
    data(){
        return {
            latestProducts: this.$page.props.latestProducts,
            form: this.$inertia.form({
                page: 1,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/latestProducts", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.latestProducts = page.props.latestProducts;
                }
            });
        },
    }
}
</script>
