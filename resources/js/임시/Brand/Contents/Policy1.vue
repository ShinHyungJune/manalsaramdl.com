<template>
    <main class="policy">
        <div class="sub-con container">
            <h2>
                기타안내
            </h2>
            <ul class="tab-link col-group">
                <li class="active">
                    <a href="/brand/policy1">
                        이용약관
                    </a>
                </li>
                <li>
                    <a href="/brand/policy2">
                        개인정보보호정책
                    </a>
                </li>
            </ul>
            <div>
                <pre></pre>
            </div>
        </div>
    </main>

</template>

<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import Product from "../../../Components/Product";

export default {
    components: {Product, Link, Pagination},
    data(){
        return {

        }
    },

    methods:{

    },

    mounted() {

    }
}
</script>
