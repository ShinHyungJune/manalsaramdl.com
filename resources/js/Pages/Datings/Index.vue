<template>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            datings: this.$page.props.datings,
            latestUnreadDating : this.$page.props.latestUnreadDating ? this.$page.props.latestUnreadDating.data : "",
            form: this.$inertia.form({
                page: 1,
                state: this.$page.props.state,
            }),
        }
    },
    methods: {

    },
    computed: {

    }
}
</script>
