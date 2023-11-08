<template>
    <main class="subpage result-section">
        <div class="result-container">
            <div class="result-contents">
                <div class="check-icon">
                    <i class="xi-check"></i>
                </div>
                <p class="result-title">
                    <span class="text-style-1">만날사람들</span> 회원가입을 환영합니다
                </p>
                <div class="result-sub">
                    <p>
                        만날사람들과 함께 해주셔서 감사합니다.
                        <br/>만날사람들의 매치스트가 1-3일내로 연락드리도록 하겠습니다.
                        <br/>만날사람들은 진심으로 당신의 인연을 찾기 위해 노력할 것 입니다.
                        <br/>만날사람들과 함께 노력해보아요.
                    </p>
                </div>
                <a href="/" class="btn-result">홈으로 바로가기</a>
            </div>
        </div>
    </main>
</template>
<script>
import InputVerifyNumber from "../../Components/Form/InputVerifyNumber";
import {Link} from "@inertiajs/inertia-vue";
import InputAddress from "../../Components/Form/InputAddress";
import InputRegion from "../../Components/Form/InputRegion";
import InputImgs from "../../Components/Form/InputImgs";

export default {
    components: {InputImgs, InputRegion, InputAddress, Link, InputVerifyNumber},
    data(){
        return {
            form: this.$inertia.form({
            }),
        }
    },

    methods: {

    },

    mounted() {

    }
}
</script>
