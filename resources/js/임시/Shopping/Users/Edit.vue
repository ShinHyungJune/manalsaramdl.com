<template>
    <main class="mypage mypage-member">
        <div class="mypage-wrap container col-group">
            <sidebar />

            <div class="right-wrap">
                <state />

                <section>
                    <div class="sec-title">
                        <h2>
                            회원정보 수정
                        </h2>
                    </div>
                    <div class="sec-con">
                        <form action="" @submit.prevent="update">
                            <ul class="mypage-form row-group">
                                <li class="col-group sns">
                                    <p class="default">
                                        소셜 로그인
                                    </p>
                                    <div class="user">
                                        <!-- 네이버 소셜 로그인 시 보이기 -->
                                        <span v-if="form.social_platform === 'naver'"><img src="images/icon_naver.svg" alt=""></span>

                                        <!-- 카카오 소셜 로그인 시 보이기 -->
                                        <span  v-if="form.social_platform === 'kakao'"><img src="images/icon_kakao.svg" alt=""></span>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">
                                        이름
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <input type="text" value="" name="non_edit" class="" v-model="form.name">
                                        <div class="m-input-error">{{form.errors.name}}</div>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">
                                        연락처
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <input type="number" value="01000000000" name="non_edit" class="" v-model="form.contact">
                                        <div class="m-input-error">{{form.errors.contact}}</div>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">
                                        이메일
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <input type="email" value="mudmat@gmail.com" name="non_edit" class="" v-model="form.email">
                                        <div class="m-input-error">{{form.errors.email}}</div>
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
                                <li class="col-group">
                                    <p class="default">
                                        엘리베이터 유무
                                        <span>*</span>
                                    </p>
                                    <div class="user col-group">
                                        <label for="ev_true">
                                            <input type="radio" :value="1" id="ev_true" v-model="form.elevator">
                                            <span class="check-icon"></span>
                                            있음
                                        </label>

                                        <label for="ev_false">
                                            <input type="radio" :value="0" id="ev_false" v-model="form.elevator">
                                            <span class="check-icon"></span>
                                            없음
                                        </label>

                                        <span class="notice">※ 엘리베이터가 없어 이동이 불가한 경우 홈케어 서비스 이용이 불가능할 수 있습니다.</span>
                                    </div>
                                </li>
                                <li class="col-group" style="align-items: center">
                                    <p class="default">
                                        비밀번호
                                        <span>*</span>
                                    </p>
                                    <div class="user" v-if="willChangePassword">
                                        <div class="fragment">
                                            <input type="password" name="" class="" v-model="form.password" placeholder="새 비밀번호">
                                            <div class="m-input-error">{{form.errors.password}}</div>
                                        </div>

                                        <div class="fragment">
                                            <input type="password" name="" class="" v-model="form.password_confirmation" placeholder="새 비밀번호 확인">
                                            <div class="m-input-error">{{form.errors.password_confirmation}}</div>
                                        </div>

                                        <div class="m-input-error">{{form.errors.password}}</div>
                                    </div>
                                    <div class="user" v-else>
                                        <a href="#" @click.prevent="willChangePassword = true" class="btn">
                                            비밀번호 변경
                                        </a>
                                    </div>

                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="sec-footer col-group">
<!--                        <button type="button" class="edit"> &lt;!&ndash; 정보 수정 하기 전 보이기 &ndash;&gt;
                            정보 수정하기
                        </button>-->
                        <button type="button" @click="update"> <!-- 정보 수정하기 버튼을 누른 후 보이기 -->
                            저장하기
                        </button>
                    </div>
                </section>
                <section class="member-leave">
                    <div class="sec-title">
                        <h2>
                            회원 탈퇴
                        </h2>
                    </div>
                    <div class="sec-con">
                            <pre>
                                - 회원탈퇴시 정보 수집기간 : 3년
                                - 안내사항 : 탈퇴 후 회원정보 및 이용기록은 모두 삭제되며 다시 복구하실 수 없습니다. 작성한 구매후기와 결제 내역은 이용약관과 관련법에 의해 보관됩니다.
                            </pre>
                    </div>
                    <div class="sec-footer">
                        <a href="/shopping/users/remove">
                            회원탈퇴
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import State from "../../../Components/State";
import Sidebar from "../../../Components/Sidebar";
import InputAddress from "../../../Components/Form/InputAddress";

export default {
    components: {InputAddress, Sidebar, State, Link, Pagination},
    data(){
        return {
            willChangePassword: false,
            form: this.$inertia.form({
                page: 1,
                name: this.$page.props.user ? this.$page.props.user.data.name : "",
                contact: this.$page.props.user ? this.$page.props.user.data.contact : "",
                email: this.$page.props.user ? this.$page.props.user.data.email : "",
                address: this.$page.props.user ? this.$page.props.user.data.address : "",
                address_detail: this.$page.props.user ? this.$page.props.user.data.address_detail : "",
                address_zipcode: this.$page.props.user ? this.$page.props.user.data.address_zipcode : "",
                elevator: this.$page.props.user ? this.$page.props.user.data.elevator : "",
                password: "",
                password_confirmation: ""
            })
        }
    },
    methods:{
        update(){
            this.form.post("/users/update", {
                onSuccess: () => {
                    this.willChangePassword = false;
                }
            });
        }
    }
}
</script>
