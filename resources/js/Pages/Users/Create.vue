<template>
    <main class="mypage join join2">
        <div class="join-wrap container">
            <div class="sec-title-wrap col-group">
                <div class="sec-title">
                    <h2>
                            <span>
                                흙표흙침대
                            </span>
                        회원가입
                    </h2>
                    <p>
                        회원가입을 후 더 많은 혜택을 받아보세요
                    </p>
                </div>
                <ul class="col-group">
<!--                    <li class="active">
                            <span>
                                1
                            </span>
                        <p>
                            본인인증
                        </p>
                    </li>-->
                    <li class="active">
                            <span>
                                1
                            </span>
                        <p>
                            정보 입력
                        </p>
                    </li>
                    <li>
                            <span>
                                2
                            </span>
                        <p>
                            가입 완료
                        </p>
                    </li>
                </ul>
            </div>

            <div class="sec-con">
                <h3>
                    회원정보
                </h3>
                <ul class="mypage-form">
                    <li class="col-group">
                        <p class="default">
                            연락처
                        </p>

                        <div class="user">
                            <div class="col-group">
                                <input-verify-number @verified="(data) => form.contact = data" />
<!--                                <input type="text" v-model="form.contact" disabled>
                                <button type="button">
                                    본인인증
                                </button>-->
                            </div>

                            <p class="m-input-error">{{ form.errors.contact }}</p>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            성함
                        </p>
                        <div class="user">
                            <div class="col-group">
                                <input type="text" v-model="form.name">
                            </div>

                            <p class="m-input-error">{{ form.errors.name }}</p>

                        </div>
                    </li>
                </ul>
                <form action="">
                    <ul class="mypage-form row-group">
                        <li class="col-group">
                            <p class="default">
                                아이디
                                <span>
                                        *
                                    </span>
                            </p>
                            <div class="user">
                                <div class="col-group">
                                    <input type="text" v-model="form.ids">
                                </div>
                                <p class="guide">
                                    4~20자의 영문 + 숫자만 입력해주세요
                                    <br>
                                    아이디는 대소문자 구분합니다.
                                </p>
                                <p class="m-input-error">{{ form.errors.ids }}</p>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                비밀번호
                                <span>
                                        *
                                    </span>
                            </p>
                            <div class="user">
                                <input type="password" name="" id="" v-model="form.password">
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                비밀번호 확인
                                <span>
                                        *
                                    </span>
                            </p>
                            <div class="user">
                                <input type="password" name="" id="" v-model="form.password_confirmation">
                                <p class="guide">
                                    영문, 숫자, 특수문자를 포함 8~ 30자리로 입력해주세요.
                                    <br>
                                    비밀번호는 대소문자를 구분합니다.
                                </p>
                                <p class="m-input-error">{{ form.errors.password }}</p>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                이메일
                                <span>
                                        *
                                    </span>
                            </p>
                            <div class="user">
                                <input type="email" v-model="form.email">

                                <p class="m-input-error">{{ form.errors.email }}</p>
                            </div>
                        </li>
                        <li class="col-group addr">
                            <p class="default">
                                주소
                                <span>*</span>
                            </p>
                            <div class="user row-group">
                                <input-address
                                    :form="form"
                                    :address="'address'"
                                    :address_detail="'address_detail'"
                                    :address_zipcode="'address_zipcode'"
                                    @change="(data) => {form[data.name] = data.value;}"
                                />
                            </div>
                        </li>
                    </ul>
                    <h3>
                        약관동의
                    </h3>
                    <ul class="mypage-form agree-wrap col-group">
                        <li class="col-group">
                            <div class="user col-group">
                                <p>
                                    회원 이용약관
                                </p>
                                <a href="/brand/policy1" target="_blank">
                                    보기
                                </a>
                            </div>
                            <div class="user col-group">
                                <p>
                                    개인정보 수집
                                </p>
                                <a href="/brand/policy2" target="_blank">
                                    보기
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="user">
                                <label for="join_agree">
                                    <input type="checkbox" id="join_agree" v-model="agree">
                                    <span class="check-icon"></span>
                                    전체 동의
                                </label>
                            </div>
                        </li>
                    </ul>
                </form>
                <div class="btn-wrap col-group">
                    <a href="javascript:history.back()">
                        취소
                    </a>
                    <a href="#" @click.prevent="register">
                        가입하기
                    </a>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import InputVerifyNumber from "../../Components/Form/InputVerifyNumber";
import {Link} from "@inertiajs/inertia-vue";
import InputAddress from "../../Components/Form/InputAddress";

export default {
    components: {InputAddress, Link, InputVerifyNumber},
    data(){
        return {
            agree: 0,
            form: this.$inertia.form({
                ids: "",
                contact:"",
                email:"",
                name: "",
                password: "",
                password_confirmation: "",
                address: "",
                address_detail: "",
                address_zipcode: ""
            })
        }
    },

    methods: {
        register() {
            if(!this.agree)
                return alert("약관에 동의해주세요.");

            if(!this.form.contact)
                return alert("인증하기 버튼을 눌러 폰번호 인증을 먼저 진행해주세요.");

            this.form.post("/users");
        },

        clearLetter(){
            this.form.contact = this.form.contact.replace(/-/g, '');
        },

        verified(data){
            this.form.contact = data;
        }
    }
}
</script>
