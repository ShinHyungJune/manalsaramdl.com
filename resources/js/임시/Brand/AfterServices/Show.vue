<template>
    <main class="inquiry mypage-inquiry-detail">
        <div class="mypage-wrap container col-group">
            <div class="sub-con">
                <h2 class="sub-title">
                    문의내용
                </h2>
                <ul class="inquiry-form row-group">
                    <li class="col-group">
                        <p class="default">
                            유형선택
                        </p>
                        <div class="user">
                            <p class="nonedit">
                                {{ qna.service_type }}
                            </p>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            내용
                        </p>
                        <div class="user">
                                <pre class="nonedit" v-text="qna.description"></pre>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            첨부
                        </p>
                        <div class="user">
                            <ul class="upload-list col-group" id="upload_list">
                                <li v-for="(file, index) in qna.files" :key="index">
                                    <div class="img-box">
                                        <img :src="file.url" alt="">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            이름
                        </p>
                        <div class="user">
                            <p class="nonedit">
                                {{ qna.name }}
                            </p>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            이메일
                        </p>
                        <div class="user">
                            <p class="nonedit">
                                {{ qna.email }}
                            </p>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            연락처
                        </p>
                        <div class="user">
                            <p class="nonedit">
                                {{ qna.contact }}
                            </p>
                        </div>
                    </li>
                </ul>

                <h2 class="sub-title">
                    답변내용
                </h2>
                <ul class="inquiry-form row-group">
                    <li class="col-group">
                        <p class="default">
                            담당자
                        </p>
                        <div class="user">
                            <p class="nonedit">
                                {{ qna.answer_name }}
                            </p>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            연락처
                        </p>
                        <div class="user">
                            <p class="nonedit">
                                {{ qna.answer_contact }}
                            </p>
                        </div>
                    </li>
                    <li class="col-group">
                        <p class="default">
                            내용
                        </p>
                        <div class="user">
                            <pre class="nonedit" v-model="qna.answer"></pre>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import InputFile from "../../../Components/Form/InputFile";
import InputImgs from "../../../Components/Form/InputImgs";

export default {
    components: {InputImgs, InputFile, Link, Pagination},
    data(){
        return {
            qna: this.$page.props.qna.data
        }
    },
    methods:{

    }
}
</script>
