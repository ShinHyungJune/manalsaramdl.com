<template>
    <footer id="footer">
        <div class="footer-wrap container col-group">
            <a href="/" class="footer-logo pc">
                <img src="/images/footerlogo.svg" alt="">
            </a>
            <p class="mb">
                궁금하신 점이 있으신가요?
            </p>
            <div class="row-group">
                <div class="top-wrap col-group">
                    <ul class="top-left col-group">
                        <li>
                            <p>
                                흙표흙침대 고객센터
                            </p>
                            <h4>
                                080-315-5233
                            </h4>
                            <span>
                        월요일-금요일 09:00~16:30
                        <br>
                        (토/일요일/공휴일 휴무)
                    </span>
                        </li>
                        <li>
                            <p>
                                가장 가까운 매장 연결
                            </p>
                            <h4>
                                1577-6674
                            </h4>
                            <span>
                        <strong>FAX</strong> 051-315-5133
                        <br>
                        <strong>MAIL</strong> contact@mudmatmail.com
                    </span>
                        </li>
                    </ul>
                    <ul class="top-right col-group">
                        <li class="row-group">
                            <a href="/brand/catalogs">
                                <img src="/images/footer_icon_1.svg" alt="">
                                <p>
                                    제품 매뉴얼
                                </p>
                            </a>
                        </li>
                        <li class="row-group">
                            <a href="/brand/afterServices/create">
                                <img src="/images/footer_icon_2.svg" alt="">
                                <p>
                                    A/S 신청
                                </p>
                            </a>
                        </li>
                        <!-- # 주석 홈케어 숨김처리 참고
                       <li class="row-group">
                            <a href="/brand/homecare">
                                <img src="/images/footer_icon_3.svg" alt="">
                                <p>
                                    홈케어 서비스
                                </p>
                            </a>
                        </li>-->
                        <li class="row-group">
                            <a href="/brand/faqs">
                                <img src="/images/footer_icon_4.svg" alt="">
                                <p>
                                    FAQ
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="btm-wrap row-group">
                    <a href="#" class="mb" @click.prevent="activeFamilyPop = !activeFamilyPop">
                        FAMILY SITE

                        <div class="pop-family" v-if="activeFamilyPop">
                            <a href="https://barobau.com" target="_blank">메종바로바우</a>
                            <a href="https://soframic.com" target="_blank">소프라믹</a>
                            <a href="http://www.doodosf.co.kr/" target="_blank">두도</a>
                        </div>
                    </a>
                    <div class="btm-row1 col-group">
                        <ul class="left col-group">
                            <li>
                                <a href="/brand/history">
                                    회사소개
                                </a>
                            </li>
                            <li>
                                <a href="/brand/policy1">
                                    이용약관
                                </a>
                            </li>
                            <li>
                                <a href="/brand/policy2">
                                    개인정보처리방침
                                </a>
                            </li>
                            <li>
                                <a href="/brand/qnas/create">
                                    고객센터
                                </a>
                            </li>
                        </ul>
                        <ul class="right col-group">
                            <li>
                                <a href="https://www.instagram.com/mudmat_official" target="_blank" title="인스타그램">
                                    <img src="/images/footer_sns_1.svg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCYehxk_hWKW4Q_IjwC1Mlfw?view_as=subscriber" target="_blank" title="유튜브">
                                    <img src="/images/footer_sns_2.svg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://blog.naver.com/mudmat1" target="_blank" title="네이버 블로그">
                                    <img src="/images/footer_sns_3.svg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/gomudmat" target="_blank" title="페이스북">
                                    <img src="/images/footer_sns_4.svg" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="btm-row2 col-group pc">
                        <p>
                            (주)흙 - 사업자등록번호 : 603-81-21138 <span class="link">사업자등록확인</span> | 대표이사 : 강무웅 / 개인정보관리책임자 : 정순영 | 부산광역시 사상구 학감대로192번길 60-30 (학장동)
                            <br>
                            고객상담 : 080-315-5233 / 판매문의 : 1577-6674 / 팩스 : 051-315-5133
                            <br>
                            copyright MUDMAT All Rights Reserved
                        </p>
                        <a href="#" @click.prevent="activeFamilyPop = !activeFamilyPop">
                            FAMILY SITE

                            <div class="pop-family" v-if="activeFamilyPop">
                                <a href="https://barobau.com" target="_blank">메종바로바우</a>
                                <a href="https://soframic.com" target="_blank">소프라믹</a>
                                <a href="http://www.doodosf.co.kr/" target="_blank">두도</a>
                            </div>
                        </a>
                    </div>
                    <div class="btm-row2 mb">
                        <p>
                            (주)흙 - 사업자등록번호 : 603-81-21138
                            <br>
                            대표이사 : 강무웅 / 개인정보관리책임자 : 정순영
                            <br>
                            부산광역시 사상구 학감대로192번길 60-30 (학장동)
                            <br>
                            고객상담 : 080-315-5233
                            <br>
                            판매문의 : 1577-6674 / 팩스 : 051-315-5133
                            <br>
                            copyright MUDMAT All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="side-btn row-group">
            <a href="https://pf.kakao.com/_DQdpj" target="_blank">
                <img src="/images/side_btn_kakao.svg" alt="">
            </a>
            <button type="button">
                <img src="/images/side_btn_inquiry.png" alt="">
                <a href="tel:080-315-5233">
                    <p>
                        콜센터 <br>
                        080-315-5233
                    </p>
                </a>
            </button>
        </div>
    </footer>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
export default {
    components: {Link},
    data(){
        return {
            activeFamilyPop: false,
        }
    },
    mounted() {
        //사이드 버튼
        $('.side-btn button img').click(function(){
            $(this).parent('button').toggleClass('active')
        });
    }
}
</script>
