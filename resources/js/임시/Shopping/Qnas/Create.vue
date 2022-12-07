<template>
    <main class="inquiry-wrap inquiry qna">
        <div class="container">
            <div class="sub-top col-group">
                <ul class="col-group">
                    <li>
                        <a href="/shopping/faqs" class="row-group">
                            <h4>
                                FAQ
                            </h4>
                            <P>
                                자주 묻는 질문
                            </P>
                        </a>
                    </li>
                    <li>
                        <a href="/shopping/notices" class="row-group">
                            <h4>
                                NOTICE
                            </h4>
                            <P>
                                공지사항
                            </P>
                        </a>
                    </li>
                    <li>
                        <a href="/shopping/qnas/create" class="row-group active">
                            <h4>
                                Q&A
                            </h4>
                            <P>
                                1:1 문의하기
                            </P>
                        </a>
                    </li>
                </ul>
                <div class="col-group">
                    <div class="row-group">
                        <p>
                            흙표흙침대 고객센터
                            <strong>080-315-5233</strong>
                        </p>
                    </div>
                    <div class="row-group">
                        <p>
                            월요일-금요일 09:00~16:30
                            <span>토/일요일/공휴일 휴무</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="sub-con">
                <div class="sub-con-top col-group">
                    <div class="sub-title col-group">
                        <h2>
                            Q&A
                        </h2>
                        <p>
                            1:1 문의하기
                        </p>
                    </div>
                </div>
                <!-- <ul class="tab-link col-group">
                    <li class="active">
                        <a href="consultation.html">
                            1:1 상담
                        </a>
                    </li>
                    <li>
                        <a href="as_application.html">
                            A/S 신청
                        </a>
                    </li>
                </ul> -->
                <form action="" @submit.prevent="store">
                    <ul class="homecare-form inquiry-form row-group">
                        <li class="col-group">
                            <p class="default">
                                유형선택
                                <span>*</span>
                            </p>
                            <div class="user">
                                <select name="" id="" v-model="form.service_type">
                                    <option value="" disabled>선택</option>
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
                                <textarea v-model="form.description"></textarea>

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
                                연락처
                                <span>*</span>
                            </p>
                            <div class="user">
                                <input type="text" v-model="form.contact">

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
            this.form.post("/qnas", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                }
            });
        },
    }
}
</script>
