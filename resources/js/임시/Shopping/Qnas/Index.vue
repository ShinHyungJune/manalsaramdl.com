<template>
    <main class="mypage mypage-activity mypage-inquiry">
        <div class="mypage-wrap container col-group">
            <sidebar />
            <div class="right-wrap">
                <state />
                <section>
                    <div class="sec-title col-group">
                        <h2>
                            A/S신청 및 상담
                        </h2>
                    </div>
                    <div class="sec-con">
                        <div class="thead col-group">
                            <p class="th">
                                CS 구분
                            </p>
                            <p class="th">
                                내용
                            </p>
                            <p class="th">
                                작성 일자
                            </p>
                            <p class="th">
                                처리상태
                            </p>
                        </div>
                        <ul class="tbody">
                            <li v-if="qnas.data.length === 0">
                                <div class="m-empty type01">데이터가 없습니다.</div>
                            </li>
                            <li class="tr" v-for="qna in qnas.data" :key="qna.id">
                                <a :href="`/shopping/qnas/${qna.id}`" class="qs col-group" target="_blank">
                                    <p class="td">
                                        {{ qna.type }}
                                    </p>
                                    <div class="td">
                                        <p>
                                            {{qna.description}}
                                        </p>
                                    </div>
                                    <p class="td">
                                        {{ qna.created_at }}
                                    </p>
                                    <p class="td">
                                            <span class="state-wait" v-if="!qna.answer"> <!-- 답변 대기 상태 시 -->
                                                작성 완료
                                            </span>
                                        <span class="state-done" v-if="qna.answer"> <!-- 답변 완료 상태 시 -->
                                                답변 완료
                                            </span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                        <div class="pagination col-group" id="pagination">
                            <pagination :meta="qnas.meta" @paginate="(page) => {form.page = page; filter()}" />
                        </div>
                    </div>
                </section>
            </div>
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
            qnas: this.$page.props.qnas,

            form: this.$inertia.form({
                page: 1,
                type: this.$page.props.type,
                word: this.$page.props.word,
            })
        }
    },
    methods:{
        filter(){
            this.form.get("/shopping/qnas", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.qnas = page.props.qnas;
                }
            });
        },
    }
}
</script>
