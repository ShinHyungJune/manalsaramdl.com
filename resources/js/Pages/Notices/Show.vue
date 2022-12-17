<template>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data() {
        return {
            item: this.$page.props.item.data,

        }
    },
    methods: {

    },
    computed: {

    }
}
</script>
