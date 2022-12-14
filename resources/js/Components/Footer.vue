<template>
    <div id="footer">
        <div class="footer-wrap">
            <a href="#" class="footer-logo">
                <img src="/images/footer-logo.png" style="width: 134px; height: 42px;" alt="logo">
            </a>
            <div class="col-group">
                <ul class="col-group">
                    <li><a href="privacy01.html">개인정보처리방침</a></li>
                    <li><a href="privacy02.html">이용약관 및 환불규정</a></li>
                    <li><a href="story.html">회사소개</a></li>
                </ul>
            </div>
            <span>대표 : 이태현 &nbsp; 주소 : 서울특별시 강남구 영동대로 602, 6층 &nbsp;<br class="mb" />대표전화 : 1660-1369 &nbsp; 이메일 : cs@insacompany.com  &nbsp; 사업자등록번호 : 481-17-02165</span>
            <span class="copyright">Copyright 인사 All rights reserved.</span>
            <button id="upBtn" class="mb" >
                <i class="xi-long-arrow-up"></i>
            </button>
        </div>
    </div>
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
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 200) {
                    $("#upBtn").fadeIn();
                } else {
                    $("#upBtn").fadeOut();
                }
            });
            $("#upBtn").click(function () {
                $("html, body").animate(
                    {
                        scrollTop: 0,
                    },
                    400
                );
                return false;
            });
        });
    }
}
</script>
