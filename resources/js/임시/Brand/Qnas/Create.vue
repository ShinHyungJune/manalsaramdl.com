<template>
    <main class="inquiry consultation">
        <div class="sub-top">
            <h2>
                A/S신청 및 상담
            </h2>
        </div>
        <div class="sub-con">
            <ul class="sub-con-top container col-group">
                <li>
                    <a href="/brand">
                        <i class="xi-home"></i>
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/brand/faqs">
                        고객지원
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="#">
                        A/S신청 및 상담
                    </a>
                </li>
            </ul>
            <div class="section container">
                <div class="sec-top col-group">
                    <ul class="tab-link col-group">
                        <li class="active">
                            <a href="/#">
                                1:1 상담
                            </a>
                        </li>
                        <li>
                            <a href="/brand/afterServices/create">
                                A/S 신청
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sec-mid">
                    <form action="" @submit.prevent="store">
                        <ul class="homecare-form inquiry-form row-group">
                            <li class="col-group">
                                <p class="default">
                                    유형선택
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="" v-model="form.service_type">
                                        <option value="">선택</option>
                                        <option value="제품문의">제품문의</option>
                                        <option value="배송/설치 문의">배송/설치 문의</option>
                                        <option value="주문/결제/취소 문의">주문/결제/취소 문의</option>
                                        <option value="교환/반품 문의">교환/반품 문의</option>
                                        <option value="이벤트/프로모션 문의">이벤트/프로모션 문의</option>
                                        <option value="회원가입/기타 문의">회원가입/기타 문의</option>
                                    </select>
                                    <span class="notice">
                                            ※ A/S 문의는 문의전화(080-315-5233) 또는 A/S 신청 메뉴를 통해 접수 부탁드립니다.
                                        </span>
                                    <div class="m-input-error">{{form.errors.service_type}}</div>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    내용
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" v-model="form.description"></textarea>
                                    <div class="m-input-error">{{form.errors.description}}</div>

                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    첨부
                                </p>
                                <div class="user row-group">
                                    <input-imgs @change="(data) => form.files = data" />

                                    <div class="m-input-error">{{form.errors.files}}</div>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    이름
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" v-model="form.name">

                                    <div class="m-input-error">{{form.errors.name}}</div>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    이메일
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="email" v-model="form.email">

                                    <div class="m-input-error">{{form.errors.email}}</div>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    휴대폰번호
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="number" v-model="form.contact" placeholder="-없이 숫자만">

                                    <div class="m-input-error">{{form.errors.contact}}</div>
                                </div>
                            </li>
                        </ul>
                        <button type="submit" class="submit">
                            등록
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import InputFile from "../../../Components/Form/InputFile";
import InputImgs from "../../../Components/Form/InputImgs";

export default {
    components: {InputImgs, InputFile, Link, Pagination},
    data(){
        return {
            form: this.$inertia.form({
                page: 1,
                site_type: this.$page.props.site_type,
                type: this.$page.props.type,
                service_type: "",
                order_name: "",
                description: "",
                name: "",
                email: "",
                contact: "",
                address: "",
                address_detail: "",
                address_zipcode: "",
                contact_time: "",
                files: ""
            })
        }
    },
    methods:{
        store(){
            this.form.post("/brand/qnas", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                }
            });
        },
    }
}
</script>
