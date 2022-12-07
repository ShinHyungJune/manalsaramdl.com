<template>
    <main id="main" class="login login-index">
        <div class="login-wrap container row-group">
            <div class="sec-title">
                <h2>
                        <span>
                            흙표흙침대
                        </span>
                    통합 회원 로그인
                </h2>
            </div>
            <div class="notice col-group">
                <i class="xi-info"></i>
                <p class="animate__animated animate__slideInUp">
                    <strong>기존 흙표흙침대 회원</strong>께서는 비밀번호 찾기를 통해 <strong>비밀번호를 초기화</strong> 후 로그인 부탁드립니다.
                </p>
            </div>
            <div class="sec-con">
                <form action="" @submit.prevent="login">
                    <div class="login-form-wrap col-group">
                        <ul class="login-form row-group">
                            <li>
                                <input type="text" placeholder="아이디를 입력해 주세요." v-model="form.ids">
                                <div class="m-input-error">{{form.errors.ids}}</div>
                            </li>
                            <li>
                                <input type="password" placeholder="비밀번호를 입력해 주세요." v-model="form.password">

                                <div class="m-input-error">{{form.errors.password}}</div>
                            </li>
                        </ul>
                        <button type="submit" class="login-btn">
                            로그인
                        </button>
                    </div>
                </form>
                <ul class="find-list col-group">
                    <li>
                        <a href="/shopping/findIds/create">
                            아이디 찾기
                        </a>
                    </li>
                    <li>
                        <a href="/shopping/passwordResets/create">
                            비밀번호 찾기
                        </a>
                    </li>
                </ul>
                <a href="/shopping/register" class="member-benefit-btn col-group">
                    <p>
                        아직 회원이 아니신가요?
                        <span>
                                공식몰에서 제공하는 혜택을 확인하세요
                            </span>
                    </p>
                    <i class="xi-arrow-right"></i>
                </a>
            </div>
            <div class="sec-footer col-group">
                <div class="sns-login-wrap col-group">
                    <p>
                        SNS 계정 로그인
                    </p>
                    <ul class="sns-login-list col-group">
<!--                        <li>
                            <a href="/shopping/openLoginPop/naver">
                                <img src="/images/icon_naver.svg" alt="">
                            </a>
                        </li>-->
                        <li>
                            <a href="/shopping/openLoginPop/kakao">
                                <img src="/images/icon_kakao.svg" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="/shopping/orders/search">
                    비회원 주문조회하기
                </a>
            </div>
        </div>
    </main>
</template>
<script>

import {Link} from "@inertiajs/inertia-vue";

export default {
    components: { Link},
    data(){
        return {
            form: this.$inertia.form({
                ids:"",
                password: ""
            })
        }
    },

    methods: {
        login() {
            this.form.post("/shopping/login", {
                preserveState: true
            })
        },

        clearLetter(){
            this.form.contact = this.form.contact.replace(/-/g, '');
        },

        ready(){
            return alert("준비중입니다.");
        }
    }
}
</script>
