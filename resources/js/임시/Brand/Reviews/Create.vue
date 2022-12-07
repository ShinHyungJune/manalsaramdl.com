<template>
    <main class="review review_write">
        <div class="sub-con container">
            <div class="sec-top"></div>
            <div class="section container">
                <div class="review-score-wrap col-group">
                    <button type="button" role="radio" :class="form.point >= 1 ? 'review-score-btn active' : 'review-score-btn'" data-value="1" @click="form.point = 1"></button>
                    <button type="button" role="radio" :class="form.point >= 2 ? 'review-score-btn active' : 'review-score-btn'" data-value="2" @click="form.point = 2"></button>
                    <button type="button" role="radio" :class="form.point >= 3 ? 'review-score-btn active' : 'review-score-btn'" data-value="3" @click="form.point = 3"></button>
                    <button type="button" role="radio" :class="form.point >= 4 ? 'review-score-btn active' : 'review-score-btn'" data-value="4" @click="form.point = 4"></button>
                    <button type="button" role="radio" :class="form.point >= 5 ? 'review-score-btn active' : 'review-score-btn'" data-value="5" @click="form.point = 5"></button>
                </div>

                <ul class="tab-link col-group">
                    <li :class="form.photo ? 'active' : ''" data-tab="tab_1" @click="form.photo = 1">
                        포토 리뷰
                    </li>
                    <li :class="!form.photo ? 'active' : ''" data-tab="tab_2" @click="form.photo = 0; form.imgs = ''">
                        텍스트 리뷰
                    </li>
                </ul>

                <div class="m-input-error">{{form.errors.photo}}</div>

                <div class="tab-content active" id="tab_1">
                    <form action="" @submit.prevent="store">
                        <ul class="review-form row-group">
                            <li class="row-group" v-if="form.photo">
                                <input-imgs @change="data => form.imgs = data" />

                                <div class="m-input-error">{{form.errors.imgs}}</div>
                            </li>
                            <li class="col-group">
                                <select v-model="form.product_id"" style="width:100%;">
                                    <option value="">상품을 선택해주세요.</option>
                                    <option :value="product.id" v-for="product in products.data" :key="product.id">{{product.title}}</option>
                                </select>
                            </li>
                            <li>
                                <input type="text" placeholder="한줄평을 남겨주세요." v-model="form.title">

                                <div class="m-input-error">{{form.errors.title}}</div>

                            </li>
                            <li>
                                <textarea name="" id="" cols="30" rows="10" placeholder="구매하신 제품이 어떠셨나요?" v-model="form.description"></textarea>

                                <div class="m-input-error">{{form.errors.description}}</div>

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
import InputAddress from "../../../Components/Form/InputAddress";

export default {
    components: {InputAddress, InputImgs, InputFile, Link, Pagination},
    data(){
        return {
            products: this.$page.props.products,

            form: this.$inertia.form({
                page: 1,
                product_id: "",

                title: "",
                description: "",
                point: 5,
                photo: 1,
                imgs: ""
            })
        }
    },
    methods:{
        store(){
            if(this.form.photo && this.form.imgs === "")
                return alert("포토리뷰는 이미지 첨부가 필수입니다.");

            this.form.post("/brand/reviews", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {

                }
            });
        },


    }
}
</script>
