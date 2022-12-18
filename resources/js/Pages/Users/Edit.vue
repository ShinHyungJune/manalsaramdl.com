<template>
    <main class="subpage mypage mypage-edit">

        <!-- banner -->
        <div class="banner-wrap">
            <div class="banner-container">
                <div class="banner-contents">
                    <div class="title">Mypage</div>
                    <ul class="route">
                        <li><a href="#"><i class="xi-home"></i></a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 마이페이지</a></li>
                        <li><i class="xi-angle-right"></i></li>
                        <li><a href="#"> 프로필 수정</a></li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="mypage-wrap col-group">
            <sidebar />

            <div class="right-wrap">

                <div class="m-empty type01">연동대기</div>
<!--                <div class="title-wrap col-group">
                    <h2>프로필 수정</h2>
                </div>
                <div class="con-wrap form-wrap">
                    <form action="">
                        <ul class="form-box row-group">
                            <li class="row-group">
                                <p class="default">
                                    이메일 <span>*</span>
                                </p>
                                <div class="user col-group nonedit">
                                    <p>{{ user.email }}</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    비밀번호 <span>*</span>
                                </p>
                                <div class="user col-group">
                                    <a href="/passwordResets/create" class="form-btn">
                                        비밀번호 변경
                                    </a>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    휴대폰 번호 <span>*</span>
                                </p>
                                <div class="user col-group nonedit">
                                    <p>010-0000-0000</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이름(실명) <span>*</span>
                                </p>
                                <div class="user nonedit">
                                    <p>홍길동</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    생년월일 <span>*</span>
                                </p>
                                <div class="user nonedit">
                                    <p>1999/01/01</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    성별 <span>*</span>
                                </p>
                                <div class="user nonedit">
                                    <p>남자</p>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    직업 <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="">
                                        <option value="방송 관련 직업">방송 관련 직업</option>
                                    </select>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    최종 학력 <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="">
                                        <option value="2년제 대졸">2년제 대졸</option>
                                    </select>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    거주지 <span>*</span>
                                </p>
                                <div class="user col-group">
                                    <select name="" id="">
                                        <option value="시/도를 선택해 주세요">시/도를 선택해 주세요</option>
                                    </select>
                                    <select name="" id="">
                                        <option value="구/군을 선택해 주세요">구/군을 선택해 주세요</option>
                                    </select>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이용 예정 서비스 <span>*</span>
                                </p>
                                <div class="user">
                                    <input type="text" value="소개팅, 파티">
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    가입 경로 <span>*</span>
                                </p>
                                <div class="user">
                                    <select name="" id="">
                                        <option value="인스타그램">인스타그램</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                        <div class="notice-box">
                            <p>
                                <span class="text-style-1">소개팅 서비스</span> 이용을 원하신다면 <br>
                                아래의 <span class="text-style-1">선택입력사항</span>을 모두 입력해 주세요
                            </p>
                        </div>
                        <ul class="form-box row-group">
                            <li class="row-group">
                                <p class="default">
                                    근무지
                                </p>
                                <div class="user col-group">
                                    <select name="" id="">
                                        <option value="시/도를 선택해 주세요">시/도를 선택해 주세요</option>
                                    </select>
                                    <select name="" id="">
                                        <option value="구/군을 선택해 주세요">구/군을 선택해 주세요</option>
                                    </select>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    키/몸무게
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="키와 몸무게를 입력해주세요">
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    인스타그램 아이디
                                </p>
                                <div class="user">
                                    <input type="text" placeholder="인스타그램 아이디를 입력해 주세요">
                                </div>
                            </li>
                            <li class="row-group file">
                                <p class="default">
                                    프로필 사진 (최소 3장)
                                </p>
                                <div class="user">
                                    <label for="thumbnail_file">파일 첨부</label>
                                    <input type="file" id="thumbnail_file" onchange="file_change('thumbnail');" multiple="" accept="image/*">
                                    <div class="file-upload-list">
                                        <ul id="thumbnail_ul"></ul>
                                    </div>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    이상형
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="본인의 이상형에 대해 구체적으로 입력해 주세요."></textarea>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    자기소개글
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="자신을 소개할 수 있는 간단한 자기소개를 입력해 주세요."></textarea>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    매니저에게 한마디
                                </p>
                                <div class="user">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="매니저에게 전하고 싶은 한마디를 입력해 주세요."></textarea>
                                </div>
                            </li>
                            <li class="row-group">
                                <p class="default">
                                    결혼여부
                                </p>
                                <div class="user">
                                    <select name="" id="">
                                        <option value="혼인이력을 선택해 주세요">혼인이력을 선택해 주세요</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </form>
                    <button type="submit" class="submit-btn">정보 수정</button>
                </div>-->
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";
import Sidebar from "../../Components/Sidebar";
import InputAddress from "../../Components/Form/InputAddress";

export default {
    components: {InputAddress, Sidebar, State, Link, Pagination},
    data(){
        return {
            willChangePassword: false,
            user: this.$page.props.user.data,
            form: this.$inertia.form({
                page: 1,
                name: this.$page.props.user ? this.$page.props.user.data.name : "",
                contact: this.$page.props.user ? this.$page.props.user.data.contact : "",
                email: this.$page.props.user ? this.$page.props.user.data.email : "",
                address: this.$page.props.user ? this.$page.props.user.data.address : "",
                address_detail: this.$page.props.user ? this.$page.props.user.data.address_detail : "",
                address_zipcode: this.$page.props.user ? this.$page.props.user.data.address_zipcode : "",
                elevator: this.$page.props.user ? this.$page.props.user.data.elevator : "",
                password: "",
                password_confirmation: ""
            })
        }
    },
    methods:{
        update(){
            this.form.post("/users/update", {
                onSuccess: () => {
                    this.willChangePassword = false;
                }
            });
        }
    }
}
</script>
