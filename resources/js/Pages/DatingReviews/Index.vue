<template>
    <pagination :meta="items.meta" @paginate="(page) => {form.page = page; filter()}" />
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            items: this.$page.props.items,
            form: this.$inertia.form({
                page: 1,
            }),
        }
    },
    methods: {
        filter(){
            this.form.get("/datingsReviews", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.items = page.props.items;
                }
            });
        }
    },
    computed: {

    }
}
</script>
