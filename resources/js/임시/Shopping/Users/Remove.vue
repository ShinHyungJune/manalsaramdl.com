<template>
    <main class="mypage mypage-member mypage-member-leave" style="margin-bottom:60px;">
        <div class="mypage-wrap container col-group">
            <sidebar />

            <div class="right-wrap">
                <state />

                <section>
                    <div class="sec-title">
                        <h2>
                            회원 탈퇴
                        </h2>
                    </div>
                    <div class="sec-con">
                        <div class="notice">
                            <h3>
                                <i class="xi-warning"></i>
                                현재 진행중인 거래가 있거나 환불액이 있는 경우 탈퇴가 불가능합니다.
                            </h3>
                            <p>
                                - 회원탈퇴시 정보 수집기간 : 3년
                                <br>
                                - 안내사항 : 탈퇴 후 회원정보 및 이용기록은 모두 삭제되며 다시 복구하실 수 없습니다. 작성한 구매후기와 결제 내역은 이용약관과 관련법에 의해 보관됩니다.
                            </p>
                        </div>
                        <p>
                            지금까지 흙표흙침대 서비스를 이용해주셔서 감사합니다.
                            <br>
                            회원 탈퇴 시 계정 정보 및 적립금, 쿠폰 등의 내역이 삭제되고 복구 할 수 없습니다.
                        </p>
                        <form action="">
                            <ul class="mypage-form row-group">
                                <li class="col-group">
                                    <p class="default">
                                        비밀번호
                                        <span>
                                                *
                                            </span>
                                    </p>
                                    <div class="user">
                                        <input type="password" v-model="form.password">
                                    </div>
                                </li>
                                <li>
                                    <div class="user">
                                        <label for="leave_agree">
                                            <input type="checkbox" id="leave_agree" v-model="agree">
                                            <span class="check-icon"></span>
                                            위 내용을 동의하고 탈퇴합니다.
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="sec-footer">
                        <a href="#" @click.prevent="remove">
                            탈퇴하기
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

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {
            agree: 0,
            form: this.$inertia.form({
                page: 1,
                password: ""
            })
        }
    },
    methods:{
        remove(){
            if(!this.agree)
                return alert("동의해야만 진행할 수 없습니다.");

            this.form.delete("/users", {
                onSuccess: () => {

                }
            });
        }
    }
}
</script>
