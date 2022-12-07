<template>
    <main class="login login-index nonmember">
        <div class="login-wrap container row-group">
            <div class="sec-title">
                <h2>
                    비회원 주문 조회
                </h2>
            </div>
            <div class="sec-con">
                <form action="" @submit.prevent="submit">
                    <div class="login-form-wrap col-group">
                        <ul class="login-form row-group">
                            <li>
                                <input type="text" placeholder="주문자 명" v-model="form.user_name">
                                <div class="m-input-error">{{form.errors.user_name}}</div>
                            </li>
                            <li class="col-group number">
                                <input type="number" placeholder="주문번호" v-model="form.merchant_uid">
                            </li>
                            <div class="m-input-error">{{form.errors.merchant_uid}}</div>
                            <li>
                                <input type="password" placeholder="비회원 주문 비밀번호" v-model="form.password">
                                <div class="m-input-error">{{form.errors.password}}</div>
                            </li>
                        </ul>
                        <button type="submit" class="login-btn">
                            조회
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</template>
<script>
import Sidebar from "../../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";

export default {
    components: {Sidebar, Link, Pagination},
    data() {
        return {
            form: this.$inertia.form({
                user_name: "",
                merchant_uid: "",
                password: ""
            })
        }
    },
    methods: {
        submit(){
            this.form.get("/shopping/orders/guest");
        }
    }
}
</script>
