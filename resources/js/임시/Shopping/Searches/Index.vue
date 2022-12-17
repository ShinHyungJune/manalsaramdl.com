<template>
    <div class="subpage">
        <main class="search-result">
            <div class="subpage-wrap container">
                <div class="sub-top">
                    <p v-if="form.word">
                        <span>'{{ form.word }}'</span>에 대한 검색 결과입니다.
                    </p>
                    <p v-else>
                        맞춤검색된 결과입니다.
                    </p>
                    <ul class="tab-link col-group">
                        <li :class="category.id == selectedCategory.id ? 'active' : ''" v-for="(category, index) in categories.data" :key="category.id">
                            <a href="" @click.prevent="form.category_id = category.id; filter()">
                                {{ category.title }}
                                <span>{{counts[index]}}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sub-con" v-for="item in items" :key="item['subCategory'].id">
                    <div class="sub-con-top col-group">
                        <h3>
                            {{ item['subCategory'].title }}
                            <span>
                                {{ item['count'] }}
                            </span>
                        </h3>
                        <a :href="`/shopping/products?sub_category_id=${item['subCategory'].id}`">
                            전체보기
                            <i class="xi-angle-right"></i>
                        </a>
                    </div>
                    <ul class="prod-list col-group">
                        <li v-if="item['products'].data.length === 0" class="m-empty type01" style="width:100%;">
                            데이터가 없습니다.
                        </li>
                        <li v-for="product in item['products'].data">
                            <product :product="product" />
                        </li>
                    </ul>
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
            counts: this.$page.props.counts,
            items: this.$page.props.items,
            selectedCategory: this.$page.props.selectedCategory ? this.$page.props.selectedCategory.data : "",
            form: this.$inertia.form({
                page: 1,
                word: this.$page.props.word,
                mood_id: this.$page.props.mood_id,
                usage_id: this.$page.props.usage_id,
                category_id: this.$page.props.category_id,
            })
        }
    },

    methods:{
        filter(){
            this.form.get("/searches", {
                preserveScroll: true,
                preserveState: false,
                onSuccess: (page) => {

                }
            });
        },

    }
}
</script>
