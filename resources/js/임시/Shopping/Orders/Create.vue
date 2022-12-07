<template>
    <main class="mypage mypage-order mypage-order-create">
        <div class="mypage-wrap container">
            <div class="sec-top col-group">
                <h2>
                    주문서 작성
                </h2>
                <ul class="col-group">
                    <li>
                        장바구니
                    </li>
                    <li>
                        <i class="xi-angle-right"></i>
                    </li>
                    <li>
                        <strong>
                            주문서 작성
                        </strong>
                    </li>
                    <li>
                        <i class="xi-angle-right"></i>
                    </li>
                    <li>
                        주문완료
                    </li>
                </ul>
            </div>
            <section v-if="!user"> <!-- 비회원 주문시 노출됩니다 -->
                <div class="sec-title">
                    <h2>
                        비회원 주문
                    </h2>
                </div>
                <div class="sec-con">
                    <form action="">
                        <ul class="mypage-form col-group">
                            <li class="col-group half">
                                <p class="default">
                                    주문자 명
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" v-model="form.user_name">
                                    <p class="m-input-error">
                                        {{form.errors.user_name}}
                                    </p>
                                </div>
                            </li>
                            <li class="col-group half">
                                <p class="default">
                                    비회원 주문 비밀번호
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="password" v-model="form.password">
                                    <p class="m-input-error">
                                        {{form.errors.password}}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </form>
                    <div class="notice">
                        <h3>
                            비회원 주문 시 주의사항
                        </h3>
                        <ul>
                            <li>
                                회원 구매 시  총 구매 금액의 5%만큼의 포인트가 적립되며 차후 제품 구입 시 차감을 받을 수 있습니다.
                                <br>
                                <strong>
                                    비회원 구매 시 적립금이 적립되지 않는 점 양해 부탁드립니다.
                                </strong>
                            </li>
                            <li>
                                구매 후 주문 조회를 원하실 경우
                                <strong>
                                    주문자명/비회원 주문 비밀번호/주문번호로 조회
                                </strong>
                                가 가능합니다.
                            </li>
                        </ul>
                    </div>
                </div>
            </section> <!-- 비회원 주문시 노출됩니다 -->

            <div class="sec-wrap col-group">
                <section>
                    <div class="sec-title">
                        <h2>
                            배송정보
                        </h2>
                    </div>
                    <div class="sec-con">
                        <form action="">
                            <ul class="mypage-form row-group">
                                <li class="col-group">
                                    <p class="default">
                                        배송지명
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <input type="text" v-model="form.delivery_title">
                                        <p class="m-input-error">
                                            {{form.errors.delivery_title}}
                                        </p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">
                                        수령인
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <input type="text" v-model="form.delivery_name">
                                        <p class="m-input-error">
                                            {{form.errors.delivery_name}}
                                        </p>
                                    </div>
                                </li>
                                <li class="col-group addr">
                                    <p class="default">
                                        배송지
                                        <span>*</span>
                                    </p>
                                    <div class="user row-group">
                                        <input-address
                                            :form="form"
                                            :address="'delivery_address'"
                                            :address_detail="'delivery_address_detail'"
                                            :address_zipcode="'delivery_address_zipcode'"
                                            @change="(data) => {form[data.name] = data.value;}"
                                        />
                                    </div>
                                </li>
                                <li class="col-group phone">
                                    <p class="default">
                                        연락처1
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <div class="col-group">
                                            <input type="text" v-model="form.delivery_contact">
                                        </div>

                                        <p class="m-input-error">
                                            {{form.errors.delivery_contact}}
                                        </p>
                                    </div>
                                </li>
                                <li class="col-group phone">
                                    <p class="default">
                                        연락처2
                                    </p>
                                    <div class="user">
                                        <div class="col-group">
                                            <input type="text" v-model="form.delivery_contact2">
                                        </div>

                                        <p class="m-input-error">
                                            {{form.errors.delivery_contact2}}
                                        </p>
                                    </div>
                                </li>
                                <li class="col-group">
                                    <p class="default">
                                        서비스 가능시간
                                        <span>*</span>
                                    </p>
                                    <div class="user">
                                        <select name="" id="" v-model="form.service_time">
                                            <option value="" disabled selected>선택</option>
                                            <option value="10:00">10:00</option>
                                            <option value="11:00">11:00</option>
                                            <option value="12:00">12:00</option>
                                            <option value="13:00">13:00</option>
                                            <option value="14:00">14:00</option>
                                            <option value="15:00">15:00</option>
                                            <option value="16:00">16:00</option>
                                            <option value="17:00">17:00</option>
                                        </select>

                                        <div class="m-input-error">
                                            {{form.errors.service_time}}
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="sec-title" v-if="user">
                        <h2>
<!--                            쿠폰 / -->적립금
                        </h2>
                    </div>
                    <div class="sec-con" v-if="user">
                        <form action="">
                            <ul class="mypage-form row-group">
<!--                                <li class="col-group coupon">
                                    <p class="default">
                                        쿠폰 할인
                                    </p>
                                    <div class="user">
                                        <div class="col-group">
                                            <p class="col-group discount-txt">
                                                    <span class="discount-percent">
                                                        5%
                                                    </span>
                                                <span class="discount-price">
                                                        408,500원
                                                    </span>
                                            </p>
                                            <button type="button" onclick="javascript:openCoupon()">
                                                쿠폰 조회/적용
                                            </button>
                                        </div>
                                    </div>
                                </li>-->
                                <li class="col-group reserves" v-if="user">
                                    <p class="default">
                                        적립금 할인
                                    </p>
                                    <div class="user row-group">
                                        <p class="col-group discount-txt">
                                                <span>
                                                    고객님의 보유 적립금은
                                                    <strong>
                                                        {{ user.point.toLocaleString() }}원
                                                    </strong>
                                                    입니다.
                                                </span>
                                        </p>
                                        <div class="col-group">
                                            <input type="number" @keydown="checkPoint" v-model="form.point_use">
                                            <button type="button" @click="form.point_use = user.point">
                                                전액사용
                                            </button>
                                        </div>

                                        <div class="m-input-error">
                                            {{form.errors.point_use}}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="sec-title">
                        <h2>
                            결제방법
                        </h2>
                    </div>
                    <div class="sec-con">
                        <ul class="pay-list col-group">
                            <li v-for="payMethod in payMethods.data" :key="payMethod.id" v-if="payMethod.name != '휴대폰'">
                                <input type="radio" v-model="form.pay_method_id" :id="payMethod.id" :value="payMethod.id">
                                <label :for="payMethod.id">
                                    {{ payMethod.name }}
                                </label>
                            </li>
                        </ul>

                        <div class="m-input-error">
                            {{form.errors.pay_method_id}}
                        </div>
                    </div>
                </section>
                <section>
                    <div class="sec-title">
                        <h2>
                            배송정보
                        </h2>
                    </div>
                    <div class="sec-con">
                        <table class="cart-table">
                            <colgroup>
                                <col width="60%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <tbody>
                            <tr v-for="product in products.data" :key="product.id">
                                <td>
                                    <div class="col-group order-box">
                                        <div class="left-box">
                                            <a :href="`/shopping/products/${product.origin_product_id}`" class="img-box">
                                                <img :src="product.img ? product.img.url : ''" alt="">
                                            </a>
                                        </div>
                                        <div class="right-box">
                                            <h3>
                                                {{ product.title }}
                                            </h3>
                                            <ul>
                                                <li>
                                                    색상 : {{ product.color }}
                                                </li>
                                                <li>
                                                    {{ product.discounted_price.toLocaleString() }}원
                                                </li>
                                            </ul>
                                            <p v-for="optionProduct in product.optionProducts" :key="optionProduct.id">
                                                {{ optionProduct.title }} x {{optionProduct.count}} 포함 (+{{(optionProduct.count * optionProduct.price).toLocaleString()}})
                                            </p>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="col-group">
                                        <span class="mb">개수</span>
                                        <span>{{product.count}}</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="col-group">
                                        <span class="mb">총 결제 액</span>
                                        <span>{{ productTotalPrice(product).toLocaleString() }}</span>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="sec-footer">
                        <ul class="row-group">
                            <li class="col-group">
                                <p class="default">
                                    총 주문금액
                                </p>
                                <p class="user">
                                    <span>{{totalPrice.toLocaleString()}}</span>원
                                </p>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    총 배송비
                                </p>
                                <p class="user">
                                    <span>{{deliveryPrice.toLocaleString()}}</span>원
                                </p>
                            </li>
<!--                            <li class="col-group">
                                <p class="default">
                                    쿠폰 할인
                                </p>
                                <p class="user">
                                        <span>
                                            408,500
                                        </span>
                                    원
                                </p>
                            </li>-->
                            <li class="col-group">
                                <p class="default">
                                    적립금 할인
                                </p>
                                <p class="user">
                                    <span>{{ form.point_use.toLocaleString() }}</span>원
                                </p>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    총 결제금액
                                </p>
                                <p class="user">
                                    <span>{{ realPrice.toLocaleString() }}</span>원
                                </p>
                            </li>
                        </ul>
                        <div class="notice">
                            <h3>
                                적립금 혜택
                                <span>
                                        본사 쇼핑몰에서의 제품 구매시 총 구매금액의 5%만큼의 포인트가 적립됩니다.
                                    </span>
                            </h3>
                            <div class="col-group">
                                <p>
                                    구매적립금
                                </p>
                                <p>
                                    {{ pointExpect.toLocaleString() }} 원
                                </p>
                            </div>
                        </div>
                        <div class="agree-wrap">
                            <label for="agree_check">
                                <input type="checkbox" id="agree_check" v-model="agree">
                                <span class="check-icon"></span>
                                이용약관 및 개인정보 제3자 제공사항에 대해 확인하였으며 결제에 동의합니다.
                            </label>
                            <ul class="row-group">
                                <li class="col-group">
                                    개인정보 수집/이용 동의
                                    <a href="/shopping/privacyPolicy">
                                        보기
                                    </a>
                                </li>
                                <li class="col-group">
                                    개인정보 제3자 제공 동의
                                    <a href="/shopping/supplyPolicy">
                                        보기
                                    </a>
                                </li>
                                <li class="col-group">
                                    결제대행 서비스 이용약관 (주)
                                    <a href="/shopping/servicePolicy">
                                        보기
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button type="button" @click.prevent="order">
                            구매하기
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </main>
</template>
<script>
import Pagination from "../../../Components/Pagination";
import InputVerifyNumber from '../../../Components/Form/InputVerifyNumber';
import InputAddress from "../../../Components/Form/InputAddress";
import InputDate from "../../../Components/Form/InputDate";
import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link, Pagination, InputVerifyNumber, InputAddress, InputDate},

    data() {
        return {
            user: this.$page.props.user ? this.$page.props.user.data : "",
            agree: false,
            basic: this.$page.props.basic ? this.$page.props.basic.data : "",
            products: this.$page.props.products,
            deliveryMinDiscountPrice: this.$page.props.delivery_min_discount_price,
            deliveryPrice: this.$page.props.deliveryPrice,
            payMethods: this.$page.props.payMethods,

            form: this.$inertia.form({
                user_name: "",
                password: "",
                service_time: "",

                direct: this.$page.props.direct,

                product_ids: this.$page.props.products.data.map(product => product.id),

                pay_method_id: "",

                memo: "",
                point_use: 0,

                delivery_title: "",
                delivery_name: this.$page.props.user ? this.$page.props.user.data.name : "",
                delivery_contact: this.$page.props.user ? this.$page.props.user.data.contact : "",
                delivery_contact2: "",
                delivery_address: this.$page.props.user ? this.$page.props.user.data.address : "",
                delivery_address_detail: this.$page.props.user ? this.$page.props.user.data.address_detail : "",
                delivery_address_zipcode: this.$page.props.user ? this.$page.props.user.data.address_zipcode : "",
                // delivery_memo: this.$page.props.delivery ? this.$page.props.delivery.data.memo : "",
            }),
        }
    },

    methods: {
        checkPoint(e){
            let value = e.target.value;

            if(this.user.point < value) {
                e.preventDefault();

                return this.form.point_use = this.user.point;
            }

            if((this.totalPrice + this.deliveryPrice) < value){
                e.preventDefault();

                return this.form.point_use = this.totalPrice + this.deliveryPrice;
            }

            return this.form.point_use = e.target.value;
        },

        order(){
            if(!this.agree)
                return alert("약관에 동의해주세요.");

            this.form.post("/orders");
        },

        optionProducts(product){
            let text = "";

            let total = product.optionProducts.length;

            product.optionProducts.map((optionProduct, index) => {
                if(index === total - 1)
                    return text += optionProduct.title;

                return text += optionProduct.title + " / ";
            });

            return text;
        },

        productTotalPrice(product){
            let total = 0;
            let optionPrice = 0;

            product.discounted_price;

            product.optionProducts.map(optionProduct => optionPrice += optionProduct.price * optionProduct.count);

            total = (product.discounted_price + optionPrice) * product.count;

            return total;
        },

        clearDelivery(){
            this.form.delivery_title  = "";
            this.form.delivery_contact  = "";
            this.form.delivery_contact2  = "";
            this.form.delivery_address  = "";
            this.form.delivery_address_detail  = "";
            this.form.delivery_address_zipcode  = "";
            this.form.delivery_memo  = "";
            this.form.service_time  = "";
        }
    },

    computed:{
        totalPrice(){
            let total = 0;

            this.products.data.map(product => {
                total += this.productTotalPrice(product);
            });

            return total;
        },

        realPrice(){
            return parseInt(this.totalPrice) + parseInt(this.deliveryPrice) - this.form.point_use;
        },

        pointExpect(){
            if(this.basic)
                return Math.floor(this.totalPrice / 100 * this.basic.ratio_point);

            return 0;
        },
    },

    mounted() {
        /*
        $(function () {
            let $dv_bt = $(".dv-bt-wrap").find("button");
            $dv_bt.click(function () {
                $(this).addClass("choice").siblings().removeClass("choice");
            })
        })
         */
        setTimeout(function(){
            $("html, body").scrollTop(0);
        }, 300);

        $(function () {
            let $ms_li = $(".ms-li").find("li");
            $ms_li.click(function () {
                $(this).addClass("choice").siblings().removeClass("choice");
            })
        })

        $(".add-pd").click(function(){
            $(this).find(".add-pd-list").toggle();
        })
    }
}
</script>
