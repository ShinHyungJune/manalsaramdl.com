<template>
    <main class="product-detail">
        <div class="subpage-wrap container row-group">
            <div class="sec-top col-group">
                <div class="slide-wrap">
                    <div class="swiper detail-slide2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="img in selectedColor.imgs">
                                <div class="img-box">
                                    <img :src="img.url" />
                                </div>
                            </div>
                            <!-- https://swiperjs.com/demos/images/nature-10.jpg-->
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper detail-slide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="img in selectedColor.imgs">
                                <div class="img-box">
                                    <img :src="img.url" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="txt-wrap">
                    <h2 class="col-group">
                        <p>
                            {{ product.title }}
                        </p>
                        <ul class="store-type col-group">
                            <li v-if="product.department_store">
                                백화점
                            </li>
                            <li v-if="product.direct_store">
                                온라인
                            </li>
                            <li v-if="product.agency_store">
                                대리점
                            </li>
                        </ul>
                    </h2>
                    <ul class="product-form row-group">
                        <li class="col-group">
                            <p class="default">
                                판매가
                            </p>
                            <div class="user col-group">
                                <span class="non-discount-price" v-if="product.value_discount">{{ product.price.toLocaleString() + "원" }}</span>
                                <p class="discount-price">
                                    <span class="discount" v-if="product.value_discount">{{product.type_discount === '비율할인' ? product.value_discount + "%" : "-" + (product.value_discount.toLocaleString())}}</span>
                                    <span>{{ product.discounted_price.toLocaleString() + "원"}}</span>
                                </p>
                            </div>
                        </li>
                        <li class="col-group">
                            <p class="default">
                                구매혜택
                            </p>
                            <p class="user">
                                예상적립포인트 최대 {{pointExpect}} Point
                            </p>
                        </li>
                        <li class="color">
                            <div class="col-group">
                                <p class="default">
                                    컬러선택
                                </p>
                                <p class="user"></p>
                            </div>
                            <ul class="color-list col-group">
                                <li v-for="color in product.colors" :key="color.id" @click="selectColor(color)">
                                    <label :for="color.id">
                                        <input type="radio" v-model="form.color" :value="color.title" :id="color.id" :data-color="color.color">

                                        <span class="brown" :style="`background-color:${color.color}`"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="option" v-if="product.optionProducts.length > 0">
                            <p class="default">
                                옵션선택
                            </p>
                            <div class="user">
                                <div class="option-list-wrap">
                                    <div class="option-select">
                                        <p id="option_default" @click="showOptions = !showOptions">
                                            선택하세요
                                        </p>
                                        <ul class="option-select-list" :style="`${showOptions ? 'display:block' : ''}`">
                                            <li v-for="optionProduct in product.optionProducts" :key="optionProduct.id" @click="addOptionProduct(optionProduct)">{{ optionProduct.title }} (+<span class="option-price">{{optionProduct.price.toLocaleString()}}</span>원)</li>
                                        </ul>
                                    </div>
                                    <table class="option-list">
                                        <colgroup>
                                            <col width="50%">
                                            <col width="72px">
                                            <col width="30%">
                                            <col width="5%">
                                        </colgroup>
                                        <tbody>
                                        <tr v-for="(optionProduct, index) in form.options" :key="optionProduct.id">
                                            <td>
                                                {{ optionProduct.title }} (+ {{optionProduct.price.toLocaleString()}}원)
                                            </td>
                                            <td>
                                                <div class="col-group">
                                                    <button type="button" @click="decreaseOptionProduct(optionProduct)">
                                                        <i class="xi-minus"></i>
                                                    </button>
                                                    <span id="count_result0">{{optionProduct.count}}</span>
                                                    <button type="button"  @click="addOptionProduct(optionProduct)">
                                                        <i class="xi-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="product-price">{{ (optionProduct.price * optionProduct.count).toLocaleString() }}</span>원
                                            </td>
                                            <td>
                                                <button type="button" class="del" @click.prevent="removeOptionProduct(index)">
                                                    <i class="xi-close"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-group option-total">
                                        <p class="default">
                                            총 합계금액
                                        </p>
                                        <p class="user">
                                                <span class="option-total-price">
                                                    {{ totalPrice.toLocaleString() }}
                                                </span>
                                            원
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="btn-wrap col-group">
                        <a href="" @click.prevent="clip">
                            <i class="xi-share-alt-o"></i>
                        </a>
                        <a href="" @click.prevent="like">
                            <i :class="product.isLike ? 'like xi-heart' : 'like xi-heart-o'"></i>
                        </a>
                        <a href="#" @click.prevent="addToCart">
                            장바구니
                        </a>
                        <a href="#" @click.prevent="order" class="buy-btn">
                            바로 구매하기
                        </a>
                    </div>
                </div>
            </div>

            <div class="sec-con">
                <ul class="tab-link col-group">
                    <li class="active" data-tab="tab_1">
                        제품 <span class="pc">상세</span>정보
                    </li>
                    <li data-tab="tab_2">
                        배송/취소/반품 <span class="pc">안내</span>
                    </li>
                    <li data-tab="tab_3">
                        제품 리뷰
                    </li>
                    <li data-tab="tab_4">
                        제품 QnA
                    </li>
                </ul>

                <div class="tab-content active" id="tab_1">
                    <img :src="detail.url" alt="" v-for="detail in product.details">
                </div>

                <div class="tab-content" id="tab_2">
                    <img :src="basic.delivery_guide_img ? basic.delivery_guide_img.url : ''" alt="" style="width:auto; max-width:100%;">

                    <!-- <pre style="white-space: pre-line;" v-text="basic.delivery_guide" v-if="basic"></pre> -->
                </div>

                <div class="tab-content" id="tab_3">
                    <ul class="review-list">
                        <li class="m-empty type01" v-if="reviews.data.length === 0">작성된 리뷰가 없습니다.</li>
                        <li v-for="review in reviews.data" :key="review.id">
                            <div class="review-top col-group">
                                <p>
                                    <span>{{ review.user.name }}</span>
                                    <span>{{ review.created_at }}</span>
                                </p>
                                <span :class="`review-score s${review.point}`"></span>
                            </div>
                            <div class="review-con">
                                <h4 class="title">
                                    {{ review.title }}
                                </h4>
                                <pre v-html="review.description"></pre>
                                <ul class="img-wrap col-group"> <!-- 포토리뷰일 시 보이기 -->
                                    <li v-for="(img, index) in review.imgs" :key="index">
                                        <div class="img-box">
                                            <img :src="img.url" alt="">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                    <div class="pagination col-group" id="pagination">
                        <pagination :meta="reviews.meta" @paginate="(page) => {reviewForm.page_reviews = page; reviewFilter()}" />
                    </div>
                </div>
                <div class="tab-content" id="tab_4">
                    <form @submit.prevent="storeProductQna">
                        <ul class="qna-form row-group">
                            <li class="col-group">
                                <label for="secret_qna">
                                    <input type="checkbox" id="secret_qna" v-model="isSecret" @click="checkIsSecret">
                                    <span class="check-icon"></span>
                                    비밀번호 설정
                                </label>

                                <input type="password" v-if="isSecret" v-model="productQnaForm.password">
                                <input type="password" disabled v-else>
                            </li>
                            <li>
                                <input type="text" placeholder="작성자명을 입력해주세요." v-model="productQnaForm.nickname">
                            </li>
                            <li>
                                <input type="text" placeholder="제목을 입력해주세요." v-model="productQnaForm.title">
                            </li>
                            <li>
                                <textarea name="" id="" cols="30" rows="10" placeholder="어떤점이 궁금하신가요?" v-model="productQnaForm.description"></textarea>
                            </li>
                            <li>
                                <button type="submit">
                                    작성
                                </button>
                            </li>
                        </ul>
                    </form>
                    <div class="qna-list-wrap">
                        <div class="qna-top col-group">
                            <p>
                                번호
                            </p>
                            <p>
                                작성자
                            </p>
                            <p>
                                내용
                            </p>
                            <p>
                                작성 일자
                            </p>
                            <p>
                                처리상태
                            </p>
                        </div>
                        <div class="m-empty type01" v-if="productQnas.data.length === 0">
                            작성된 QnA가 없습니다.
                        </div>
                        <ul class="qna-list">
                            <li v-for="productQna in productQnas.data" :key="productQna.id">
                                <div class="qs col-group" @click="openProductQnaAnswer(productQna)">
                                    <p>
                                        {{ productQna.id }}
                                    </p>
                                    <p>
                                        {{ productQna.nickname }}
                                    </p>
                                    <p>
                                        {{ productQna.title }}
                                    </p>
                                    <p>
                                        {{ productQna.created_at }}
                                    </p>
                                    <p>
                                        {{ productQna.answer ? "답변완료" : "답변대기" }}
                                    </p>
                                </div>
                                <div class="ans" v-if="canSeeProductQnaAnswer(productQna)">
                                    <div class="row-group">
                                        <pre v-text="productQna.description"></pre>
                                        <div class="col-group">
                                            <pre v-text="productQna.answer"></pre>
                                            <span>{{ productQna.answered_at }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="productQnas.meta" @paginate="(page) => {productQnaForm.page_product_qnas = page; productQnaFilter()}" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            isSecret: false,
            swiper: "",
            swiper2: "",
            product: this.$page.props.product.data,
            reviews: this.$page.props.reviews,
            productQnas: this.$page.props.productQnas,
            form: this.$inertia.form({
                product_id: this.$page.props.product.data.id,
                color: "",
                options: [],
                count: 1,
                direct: 1
            }),
            likeForm: this.$inertia.form({
                product_id: ""
            }),
            reviewForm: this.$inertia.form({
                page_reviews: 1,
                product_id: "",
                description: "",
                point: 5,
                file: ""
            }),
            productQnaForm: this.$inertia.form({
                page_product_qnas: 1,
                product_id: this.$page.props.product.data.id,
                nickname: "",
                title: "",
                description: "",
                password: ""
            }),
            stars: [1,2,3,4,5],
            selectedColor: "",
            basic: this.$page.props.basic ? this.$page.props.basic.data : "",
            showOptions: false,
            /* products => [
             "id" => 1,
             "count" => 1,
             "color" => "블랙", -> #복붙주의 : 컬러는 일반적인 쇼핑몰에는 안들어가겠지. (주석 #복붙주의 참고)
             "options" => [
                 [
                     "id" => 1,
                     "count" => 1,
                 ]
             ]
         ]
         */
        }
    },
    methods:{
        canSeeProductQnaAnswer(productQna){
            return productQna.open;
        },

        openProductQnaAnswer(productQna){
            if(productQna.open)
                return true;

            if(productQna.password == "" || productQna.password == null){
                productQna.open = true;

                return this.productQnas.data = this.productQnas.data.map(productQnaData => {
                    if(productQnaData.id == productQna.id)
                        return productQna;

                    return productQnaData;
                });
            }


            let password = prompt("비밀번호를 입력해주세요.");

            if(password === productQna.password){
                productQna.open = true;

                return this.productQnas.data = this.productQnas.data.map(productQnaData => {
                    if(productQnaData.id == productQna.id)
                        return productQna;

                    return productQnaData;
                });
            } else{
                alert("틀린 비밀번호입니다.");
            }
        },

        checkIsSecret(){
            if(!this.isSecret)
                this.productQnaForm.password = "";
        },

        filter(){

        },

        selectColor(color){
            let self = this;

            this.selectedColor = color;

            setTimeout(function(){
                self.initSwiper();
            }, 100)
        },

        reviewFilter(){
            this.reviewForm.get("/shopping/products/" + this.product.id, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.reviews = page.props.reviews;
                }
            })
        },

        productQnaFilter(){
            this.productQnaForm.get("/shopping/products/" + this.product.id, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.productQnas = page.props.productQnas;
                }
            })
        },

        addOptionProduct(optionProduct){
            this.showOptions = false;

            let findIndex = null;

            this.form.options.find((option, index) => {
                if(option.id == optionProduct.id){
                    findIndex = index;

                    return true;
                }
            });

            if(findIndex !== null)
                return this.form.options[findIndex].count += 1;

            optionProduct.count = 1;

            return this.form.options.push(optionProduct);
        },

        removeOptionProduct(index){
            this.form.options = this.form.options.filter((option, optionIndex) => index !== optionIndex);
        },

        increaseOptionProduct(optionProduct){
            this.form.options = this.form.options.map(option => {
                if(option.id == optionProduct.id){
                    optionProduct.count += 1;

                    return optionProduct;
                }

                return option;
            });
        },

        decreaseOptionProduct(optionProduct){
            this.form.options = this.form.options.map(option => {
                if(option.id == optionProduct.id){
                    if(optionProduct.count > 1)
                        optionProduct.count -= 1;

                    return optionProduct;
                }

                return option;
            });
        },

        addToCart(){
            this.form.color = this.selectedColor.title;

            this.form.post("/carts", {
                preserveState: true,
                preserveScroll: true
            });
        },

        order(){
            // 장바구니에 담은 후 장바구니목록 페이지로 이동
            this.form.options = JSON.stringify(this.form.options);

            this.form.direct = 1;

            this.form.color = this.selectedColor.title;

            this.form.get("/shopping/orders/create", {
                preserveScroll: false
            });

            this.form.options = JSON.parse(this.form.options);
        },

        initSwiper(){
            let self = this;

            if(this.swiper) {
                this.swiper.destroy();
                this.swiper = null;
            }

            if(this.swiper2) {
                this.swiper2.destroy();
                this.swiper2 = null;
            }

            this.swiper  = new Swiper(".detail-slide", {
                spaceBetween: 8,
                slidesPerView: 6,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    768: {
                        spaceBetween: 16,
                    }
                },
            });

            this.swiper2 = new Swiper(".detail-slide2", {
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                on: {
                    "slideChange" : function(){
                        self.swiper.slideTo(this.activeIndex);

                        $(".detail-slide .swiper-slide").removeClass("swiper-slide-thumb-active");
                        $(".detail-slide .swiper-slide").eq(this.activeIndex).addClass("swiper-slide-thumb-active");
                    }
                }
            });

            $(".detail-slide .swiper-slide").click(function(){
                self.swiper2.slideTo($(this).index());
            });

            $(".detail-slide .swiper-slide").eq(0).addClass("swiper-slide-thumb-active");

            if(this.swiper2)
                this.swiper2.moveTo(0);

            if(this.swiper)
                this.swiper.moveTo(0);
        },

        clip(){
            var url = '';
            var textarea = document.createElement("textarea");
            document.body.appendChild(textarea);
            url = window.document.location.href;
            textarea.value = url;
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
            alert("URL이 복사되었습니다.")
        },

        like(event){
            this.likeForm.product_id = this.product.id;

            this.likeForm.post("/likes", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    if($(".like").hasClass("xi-heart")){
                        $(".like").addClass("xi-heart-o");
                        $(".like").removeClass("xi-heart");
                    }else{
                        $(".like").removeClass("xi-heart-o");
                        $(".like").addClass("xi-heart");
                    }
                }
            });
        },

        storeProductQna(){
            this.productQnaForm.post("/productQnas", {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.productQnas = page.props.productQnas;
                }
            });
        }
    },
    computed: {
        totalPrice(){
            let total = 0;
            let optionPrice = 0;

            this.product.discounted_price;

            this.form.options.map(optionProduct => optionPrice += optionProduct.price * optionProduct.count);

            total = (this.product.discounted_price + optionPrice) * 1; // 상품상세에서는 상품개수가 1개임

            return total;
        },

        pointExpect(){
            if(this.basic)
                return Math.floor(this.totalPrice / 100 * this.basic.ratio_point).toLocaleString();

            return 0;
        },
    },
    mounted() {
        if(this.product.colors.length > 0) {
            this.selectedColor = this.product.colors[0];
            this.form.color = this.selectedColor.title
        }
        //탭
        $('.tab-link li').click(function(){
            $(".tab-link li").removeClass("active");
            $(this).addClass("active");
            var tab_id = $(this).attr('data-tab');
            $('.tab-content').removeClass('active');

            $(".tab-content#"+tab_id).addClass('active');
        });

        $(window).scroll(function(){
            var scrollTop = $(document).scrollTop();
            var sec_con_top = $(".sec-top").outerHeight(true);
            if( ($(document).width()) > 768 ) {
                if ( sec_con_top <=  scrollTop ) {
                    $('.tab-link').addClass('active')
                } else {
                    $('.tab-link').removeClass('active')
                }
            } else {
                if ( sec_con_top <=  scrollTop ) {
                    $('.tab-link').addClass('active')
                } else {
                    $('.tab-link').removeClass('active')
                }
            }
        });

        //이미지 썸네일
        // $('.img-list li').click(function(){
        //     var imgSrc = $(this).children('.img-box').children('img').attr('src');
        //     $('.img-thumbnail').children('.img-box').children('img').attr('src', imgSrc)
        // });

        let self = this;

        setTimeout(function(){
            self.initSwiper();


        }, 100)

    }
}
</script>
