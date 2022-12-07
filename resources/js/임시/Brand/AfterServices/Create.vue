<template>
    <main class="inquiry as_application">
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
                        <li>
                            <a href="/brand/qnas/create">
                                1:1 상담
                            </a>
                        </li>
                        <li class="active">
                            <a href="#">
                                A/S 신청
                            </a>
                        </li>
                    </ul>
                    <div class="info-box col-group">
                            <span>
                                서비스 신청 전 확인해주세요
                                <i class="xi-angle-right-min"></i>
                            </span>
                        <button type="button" class="guide-btn">
                            <i class="xi-info"></i>
                            비용 안내
                        </button>
                    </div>
                    <!-- 비용 안내 -->
                    <div class="guide-wrap">
                        <div class="guide-con">
                            <h4>
                                A/S비용 및 이사비용
                            </h4>
                            <div class="top-box col-group">
                                    <span>
                                        ※ 고객님의 요청사항에 따라 견적 비용의 차이가 발생할 수 있습니다.
                                    </span>
                            </div>
                            <ul class="guide-list row-group">
                                <li class="col-group th">
                                    <p>
                                        A/S 항목
                                    </p>
                                    <p>
                                        금액
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        출장비
                                    </p>
                                    <p>
                                        15,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        센서 수리
                                    </p>
                                    <p>
                                        30,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        조절기 수리
                                    </p>
                                    <p>
                                        70,000
                                    </p>
                                </li>
                            </ul>
                            <ul class="guide-list row-group">
                                <li class="col-group th">
                                    <p>
                                        이사 견적
                                    </p>
                                    <p>
                                        금액
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        1인침대 이사
                                    </p>
                                    <p>
                                        같은지역 200,000
                                        <br>
                                        타지역 250,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        2인침대 이사
                                    </p>
                                    <p>
                                        같은지역 250,000
                                        <br>
                                        타지역 300,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        1인침대 위치변경
                                    </p>
                                    <p>
                                        50,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        2인침대 위치변경
                                    </p>
                                    <p>
                                        50,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        1인침대 방이동
                                    </p>
                                    <p>
                                        70,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        2인침대 방이동
                                    </p>
                                    <p>
                                        90,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        1인침대 층이동
                                    </p>
                                    <p>
                                        150,000
                                    </p>
                                </li>
                                <li class="col-group">
                                    <p>
                                        2인침대 층이동
                                    </p>
                                    <p>
                                        170,000
                                    </p>
                                </li>
                            </ul>
                            <button class="close">
                                창닫기
                                <i class="xi-close"></i>
                            </button>
                        </div>
                    </div>
                    <!-- 비용 안내 -->
                </div>

                <!-- 이사 서비스 외 다른 서비스 선택 시 -->
                <div class="sec-mid">
                    <form action="" @submit.prevent="store">
                        <ul class="homecare-form inquiry-form row-group">
                            <li class="col-group">
                                <p class="default">
                                    서비스 선택
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="" v-model="form.service_type">
                                        <option value="" disabled>선택</option>
                                        <option value="침대프레임">침대프레임</option>
                                        <option value="흙보료(매트리스)">흙보료(매트리스)</option>
                                        <option value="흙매트">흙매트</option>
                                        <option value="이사서비스">이사서비스</option>
                                    </select>

                                    <div class="m-input-error">{{form.errors.service_type}}</div>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    구입 고객명
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" v-model="form.order_name">

                                    <div class="m-input-error">{{form.errors.order_name}}</div>

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
                                    휴대폰번호
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="number" v-model="form.contact" placeholder="- 없이 숫자만">
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
                                        <option value="">선택</option>
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
                        </ul>
                        <button type="submit" class="submit">
                            등록
                        </button>
                    </form>
                </div>
                <!-- //이사 서비스 외 다른 서비스 선택 시 -->

                <!-- 이사 서비스 선택 시 -->
                <!-- <div class="sec-mid">
                    <form action="">
                        <ul class="inquiry-form row-group">
                            <li class="col-group">
                                <p class="default">
                                    서비스 선택
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="">
                                        <option value="선택">선택</option>
                                        <option value="침대프레임">침대프레임</option>
                                        <option value="흙보료(매트리스)">흙보료(매트리스)</option>
                                        <option value="흙매트">흙매트</option>
                                        <option value="이사서비스">이사서비스</option>
                                    </select>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    희망 날짜
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="date">
                                </div>
                            </li>
                            <li class="col-group addr">
                                <p class="default">
                                    출발지 주소
                                    <span>*</span>
                                </p>
                                <div class="user row-group">
                                    <div class="col-group">
                                        <input type="text" id="dep_postcode" class="postcode" placeholder="우편번호" readonly>
                                        <button type="button" class="search_addr" onclick="dep_execDaumPostcode()">
                                            우편번호 검색
                                        </button>
                                    </div>
                                    <div class="col-group">
                                        <input type="text" id="dep_roadAddress" placeholder="도로명주소" readonly>
                                        <input type="text" id="dep_jibunAddress" placeholder="지번주소" readonly>
                                    </div>
                                    <div class="col-group">
                                        <input type="text" id="dep_detailAddress" placeholder="상세주소">
                                        <input type="text" id="dep_extraAddress" placeholder="참고항목" readonly>
                                    </div>
                                </div>
                            </li>
                            <li class="col-group addr">
                                <p class="default">
                                    도착지 주소
                                    <span>*</span>
                                </p>
                                <div class="user row-group">
                                    <div class="col-group">
                                        <input type="text" id="arr_postcode" class="postcode" placeholder="우편번호" readonly>
                                        <button type="button" class="search_addr" onclick="arr_execDaumPostcode()">
                                            우편번호 검색
                                        </button>
                                    </div>
                                    <div class="col-group">
                                        <input type="text" id="arr_roadAddress" placeholder="도로명주소" readonly>
                                        <input type="text" id="arr_jibunAddress" placeholder="지번주소" readonly>
                                    </div>
                                    <div class="col-group">
                                        <input type="text" id="arr_detailAddress" placeholder="상세주소">
                                        <input type="text" id="arr_extraAddress" placeholder="참고항목" readonly>
                                    </div>
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    이름
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text">
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    연락처
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="number">
                                </div>
                            </li>
                            <li class="col-group">
                                <p class="default">
                                    연락가능시간
                                    <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="">
                                        <option value="선택">선택</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <button type="submit" class="submit">
                            등록
                        </button>
                    </form>
                </div> -->
                <!-- //이사 서비스 선택 시 -->
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
    components: {InputImgs, InputFile, Link, Pagination, InputAddress},
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
            this.form.post("/brand/afterServices", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                }
            });
        },
    },
    mounted() {
        //guide-wrap
        $(".guide-btn").click(function(){
            $('.guide-wrap').show();
            $('.guide-wrap .close').click(function(){
                $('.guide-wrap').hide();
            });

            $(document).mouseup(function (e){
                var LayerPopup = $(".guide-wrap");
                if(LayerPopup.has(e.target).length === 0){
                    LayerPopup.hide();
                }
            });
        });
    }
}
</script>
