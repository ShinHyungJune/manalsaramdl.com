<template>
<!--    <pagination :meta="shoppingEvents.meta" @paginate="(page) => {form.page = page; filter()}" />-->
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            orders: this.$page.props.orders,
            latestProducts: this.$page.props.latestProducts,
            form: this.$inertia.form({
                page: 1,
            })
        }
    },
    methods:{

    }
}
</script>
