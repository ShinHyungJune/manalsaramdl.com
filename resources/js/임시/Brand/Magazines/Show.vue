<template>
    <div class="board-detail">
        <main class="board-detail">
            <div class="sub-con container">
                <div class="sub-con-top col-group">
                    <p>
                        {{ item.title }}
                    </p>
                    <p>
                        {{ item.created_at }}
                    </p>
                </div>
                <pre v-html="item.description"></pre>
            </div>
            <div class="btn-wrap container col-group">
                <a href="javascript:history.back()">
                    뒤로가기
                </a>
            </div>
        </main>
    </div>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';

export default {
    components: {Link},
    data() {
        return {
            item: this.$page.props.item.data,
        }
    },
    methods: {},

    computed: {},

    mounted() {

    }
}
</script>
