<template>
    <main class="story story2">
        <div class="sub-top">
            <h2>
                흙표흙침대의 효과
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
                    <a href="/brand/story1">
                        흙침대 이야기
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/story2">
                        흙표흙침대의 효과
                    </a>
                </li>
            </ul>
            <div class="section container">
                <div class="sec-con col-group">
                    <div class="left-box">
                        <h2>
                            01
                            <br>
                            온열효과
                        </h2>
                        <p>
                            25℃ 부터 50℃ 까지 온도 조절이 가능해
                            <br>
                            한겨울에도 아랫목에서 찜질하는 것처럼
                            <br>
                            따뜻하게 잠들 수 있습니다.
                        </p>
                    </div>
                    <div class="right-box">
                        <div class="img-box">
                            <img src="/images/story2_1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="sec-con col-group">
                    <div class="left-box">
                        <h2>
                            02
                            <br>
                            원적외선
                        </h2>
                        <p>
                            흙판을 통해 방출되는 원적외선의 열작용은
                            <br>
                            각종 질병의 원인이 되는 세균을 없애는데
                            <br>
                            도움을 주고 혈액순환과
                            <br>
                            세포 조직생성에 도움을 줍니다.
                        </p>
                    </div>
                    <div class="right-box">
                        <div class="img-box">
                            <img src="/images/story2_2.jpg" alt="" style="width:100%; top:-30%; height:auto;">
                        </div>
                    </div>
                </div>
                <div class="sec-con col-group">
                    <div class="left-box">
                        <h2>
                            03
                            <br>
                            전자파 차단
                        </h2>
                        <p>
                            전자파는 전기 매트,온열 침대를 사용하시는 분들이
                            <br>
                            걱정하는 요소 중 하나로 흙표흙침대는
                            <br>
                            KC 안전인증을 받은 안전한 침대입니다.
                        </p>
                    </div>
                    <div class="right-box">
                        <div class="img-box">
                            <img src="/images/story2_3.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="sec-con col-group">
                    <div class="left-box">
                        <h2>
                            04
                            <br>
                            천연 피톤치드
                        </h2>
                        <p>
                            36종의 천연식물에서 추출한 피톤치드는
                            <br>
                            마치 숲에 있는 것과 같은 효과를 주어
                            <br>
                            실내 공기 정화와 탈취에 도움이 됩니다.
                        </p>
                    </div>
                    <div class="right-box">
                        <div class="img-box">
                            <img src="/images/story2_4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="sec-con col-group">
                    <div class="left-box">
                        <h2>
                            05
                            <br>
                            산소
                        </h2>
                        <p>
                            미국 NASA 프로젝트에 참여한 노만균 박사가 산소 공급에
                            <br/>대한 연구에서 착안한 산소를 발생하고 탄산가스를 제거하는
                            <br/>고체산소 기술약 4m크기의 나무만큼 산소를 발생
                        </p>
                    </div>
                    <div class="right-box">
                        <div class="img-box">
                            <img src="/images/story2_5.jpg" alt="" style="width:100%; height:auto;">
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
import Product from "../../../Components/Product";

export default {
    components: {Product, Link, Pagination},
    data(){
        return {

        }
    },

    methods:{

    },

    mounted() {

    }
}
</script>
