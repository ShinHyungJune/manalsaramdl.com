<template>
    <main class="join find-id find-pw">
        <div class="join-wrap container">
            <div class="sec-title-wrap col-group">
                <div class="sec-title">
                    <h2>
                            <span>
                                흙표흙침대
                            </span>
                        비밀번호 변경
                    </h2>
                    <p>
                        새로운 비밀번호를 등록해주세요.
                    </p>
                </div>
            </div>

            <div class="sec-con">
                <form action="">
                    <input type="password" placeholder="새로운 비밀번호를 입력해주세요" class="" v-model="form.password">
                    <input type="password" placeholder="비밀번호 확인" class="" v-model="form.password_confirmation">
<!--                    <p class="guide">
                        영문, 숫자, 특수문자를 포함 8~ 30자리로 입력해주세요.
                        <br>
                        비밀번호는 대소문자를 구분합니다.
                    </p>-->
                    <p class="error" >
                        {{ form.errors.password }}
                    </p>
                </form>
            </div>

            <!-- <button type="submit" class="next-btn">
                다음
            </button> -->

            <a href="#" class="next-btn" @click.prevent="update">
                초기화
            </a>
        </div>
    </main>
</template>
<script>
import InputVerifyNumber from "../../../Components/Form/InputVerifyNumber";
import {Link} from "@inertiajs/inertia-vue";
import InputAddress from "../../../Components/Form/InputAddress";

export default {
    components: {InputAddress, Link, InputVerifyNumber},
    data(){
        return {
            agree: 0,
            form: this.$inertia.form({
                token: this.$page.props.token,
                password: "",
                password_confirmation: ""
            })
        }
    },

    methods: {
        update() {
            this.form.patch("/shopping/passwordResets");
        },


    }
}
</script>
