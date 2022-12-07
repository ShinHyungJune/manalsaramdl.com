<template>
    <main class="mypage-wrap container mypage mypage-return">
        <section>
            <div class="sec-top">
                <h3>
                    취소 / 반품 시 주의사항
                </h3>
                <ul>
                    <li>
                        배송 시작 후 단순 변심의 경우 1인용은 20만원, 2인용은 30만원의 고객부담금이 있습니다.
                    </li>
                    <li>
                        제품 개봉 및 설치 7일 후에는 재 판매가 어려우므로 반품이 불가합니다.
                        <span>
                                    단, 배송, 설치 직후 제품의 이상이 발견된 경우에는 새 제품으로 교체
                                </span>
                    </li>
                    <li>
                        A/S 기간 : 보료:2년, 프레임:1년 (정상적으로 사용했을 경우이며 고객 과실은 유상 AS에 해당)
                    </li>
                </ul>
            </div>
            <div class="sec-con mypage-form-wrap">
                <form action="" @submit.prevent="store">
                    <ul class="mypage-form row-group">
                        <li class="col-group">
                            <p class="default">
                                서비스 선택
                                <span>*</span>
                            </p>
                            <div class="user">
                                <select name="" id="" v-model="form.type">
                                    <option value="" disabled>선택</option>
                                    <option :value="type" v-for="type in types" :key="type">{{ type }}</option>
                                </select>

                                <div class="m-input-error">{{form.errors.type}}</div>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                구입 고객명
                                <span>*</span>
                            </p>
                            <div class="user">
                                <input type="text" v-model="form.order_name">

                                <div class="m-input-error">{{form.errors.type}}</div>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                내용
                                <span>*</span>
                            </p>
                            <div class="user">
                                <textarea name="" id="" v-model="form.reason_request"></textarea>

                                <div class="m-input-error">{{form.errors.reason_request}}</div>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                첨부
                            </p>

                            <input-imgs @change="(data) => form.files = data" />

                            <div class="m-input-error">{{form.errors.files}}</div>

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
                                연락처
                                <span>*</span>
                            </p>
                            <div class="user">
                                <input type="number" v-model="form.contact">

                                <div class="m-input-error">{{form.errors.contact}}</div>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                연락가능시간
                                <span>*</span>
                            </p>
                            <div class="user">
                                <select name="" id="" v-model="form.contact_time">
                                    <option value="" disabled>선택</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                </select>

                                <div class="m-input-error">{{form.errors.contact_time}}</div>

                            </div>
                        </li>
                        </li>
                    </ul>
                    <button type="submit" class="submit">
                        신청
                    </button>
                </form>
            </div>
        </section>
    </main>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import InputFile from "../../../Components/Form/InputFile";
import InputImgs from "../../../Components/Form/InputImgs";
import InputAddress from "../../../Components/Form/InputAddress";

export default {
    components: {InputAddress, InputImgs, InputFile, Link, Pagination},
    data(){
        return {
            orderProduct: this.$page.props.orderProduct.data,

            types: this.$page.props.types,

            form: this.$inertia.form({
                page: 1,
                order_product_id: this.$page.props.orderProduct.data.id,

                type: "",
                reason_request: "",
                order_name: "",
                email: "",
                name: "",
                contact: "",
                contact_time: "",
                address: "",
                address_detail: "",
                address_zipcode: "",

                bank: "",
                account: "",
                owner: "",
            })
        }
    },
    methods:{
        store(){
            this.form.post("/shopping/refunds", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {

                }
            });
        },
    }
}
</script>
