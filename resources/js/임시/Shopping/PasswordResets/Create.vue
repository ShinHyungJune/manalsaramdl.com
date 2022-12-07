<template>
    <main class="join find-id find-pw">
        <div class="join-wrap container">
            <div class="sec-title-wrap col-group">
                <div class="sec-title">
                    <h2>
                            <span>
                                흙표흙침대
                            </span>
                        비밀번호 찾기
                    </h2>
                    <p>
                        비밀번호를 찾으려는 아이디를 가입했던 휴대폰번호와 함께 입력해주세요.
                    </p>
                </div>
            </div>

            <div class="sec-con">
                <form action="">
                    <input type="text" placeholder="아이디를 입력해주세요." v-model="form.ids">
                    <div class="m-input-error">{{form.errors.ids}}</div>

                    <div style="margin-top:16px;"></div>

                    <input-verify-number @verified="(data) => form.contact = data" />

                    <div class="m-input-error">{{form.errors.contact}}</div>
                    <p class="guide">
                        임시 비밀번호를 가입 시 등록한 휴대폰번호로 보내드립니다.
                    </p>
                </form>
            </div>

            <!-- <button type="submit" class="next-btn">
                다음
            </button> -->

            <a href="#" class="next-btn" @click="store" style="width:200px;">
                비밀번호 초기화
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
                ids: "",
                contact: ""
            })
        }
    },

    methods: {
        store() {
            this.form.post("/shopping/passwordResets");
        },


    }
}
</script>
