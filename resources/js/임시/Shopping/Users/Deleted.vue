<template>
    <main class="mypage mypage-member-leave-done">
        <div class="mypage-wrap container">
            <div class="txt-box row-group">
                <i class="xi-check-circle-o"></i>
                <h2>
                    회원탈퇴가 완료되었습니다.
                </h2>
                <p>
                    흙표흙침대 서비스를 이용해 주셔서 감사합니다.
                    <br>
                    더 좋은 서비스로 다시 찾아 뵙겠습니다.
                </p>
            </div>
            <a href="/shopping" class="home-btn">
                홈으로 가기
            </a>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import State from "../../../Components/State";
import Sidebar from "../../../Components/Sidebar";

export default {
    components: {Sidebar, State, Link, Pagination},
    data(){
        return {

        }
    },
    methods:{

    }
}
</script>
