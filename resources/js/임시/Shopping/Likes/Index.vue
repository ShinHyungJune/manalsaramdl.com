<template>
    <main class="mypage mypage-interest mypage-favorite">
        <div class="mypage-wrap container col-group">
            <sidebar />
            <div class="right-wrap">
                <state />

                <section class="mypage-history">
                    <div class="sec-title">
                        <h2>
                            관심상품
                        </h2>
                    </div>
                    <div class="sec-con">
                        <ul class="prod-list col-group">
                            <li v-if="likes.data.length === 0">
                                <div class="m-empty type01">데이터가 없습니다.</div>
                            </li>
                            <li v-for="like in likes.data" :key="like.id">
                                <product :product="like.product" type="type01" />
                            </li>
                        </ul>
                    </div>

                    <div class="pagination col-group" id="pagination">
                        <pagination :meta="likes.meta" @paginate="(page) => {form.page = page; filter()}" />
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
    components: {State, Sidebar, Product, Link, Pagination, Product},
    data(){
        return {
            likes: this.$page.props.likes,
            form: this.$inertia.form({
                page: 1,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/likes", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.likes = page.props.likes;
                }
            });
        },
    }
}
</script>
