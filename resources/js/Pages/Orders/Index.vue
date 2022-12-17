<template>
    <main class="subpage mypage mypage_payment">
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
                        <li><a href="#"> 결제내역</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mypage-wrap col-group">
            <sidebar />

            <div class="right-wrap">
                <!-- 파티 환불요청서 모달 -->
                <div class="modal-overley refund open" v-if="targetRefundOrder">
                    <div class="modal-wrap refund">
                        <button type="button" class="close" @click="targetRefundOrder = false">
                            <i class="xi-close"></i>
                        </button>

                        <div v-if="targetRefundOrder.product.type === '파티'">
                            <div class="title-wrap">
                                <i class="xi-lock"></i>
                                <h2 class="title">
                                    파티 환불신청서
                                </h2>
                                <p class="txt">
                                    참가비 환불 절차는 공정거래위원회의 소비자 환불규정에 따라 <br>
                                    아래와 같습니다. 참석 인원 미달되거나 주최측에 의한 <br>
                                    이벤트 취소의 경우, 전액 환불 도와드립니다.
                                </p>
                            </div>
                            <div class="request-wrap party-wrap">
                                <ul class="request-box request-box-2 row-group">
                                    <li class="col-group">
                                        <p class="default">결제금액</p>
                                        <div class="user col-group">
                                            <p class="nonedit">{{ targetRefundOrder.price.toLocaleString() }}</p>원
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불사유</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.reason_request" />
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불계좌은행</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.bank" />
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불계좌번호</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.account" />
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불계좌 예금주</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.owner" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="notice-box">
                                <div class="title-box">
                                    <p class="title">
                                        <i class="xi-warning"></i>
                                        환불 규정
                                    </p>
                                    <p class="txt">
                                        참가비 환불 절차는 공정거래위원회의 소비자 환불규정에 따라 아래와 같습니다. <br>
                                        참석 인원 미달되거나 주최측에 의한 이벤트 취소의 경우, 전액 환불 도와드립니다.
                                    </p>
                                </div>
                                <div class="con-box">
                                    <p class="title">
                                        개인적인 사유로 취소 신청할 경우
                                    </p>
                                    <ul class="row-group">
                                        <li>파티일자 7일 이전: 입장료 전액 환불 (송금수수료 -1,000원 공제)</li>
                                        <li>파티일자 5일 이전: 입장료 70% 환불</li>
                                        <li>파티일자 4일 이전: 입장료 50% 환불</li>
                                        <li>파티일자 3일 이전: 입장료 30% 환불</li>
                                        <li>파티일자 2일 이내 또는 당일 불참: 환불 불가</li>
                                        <li>환불 소요일 : 영업일 기준으로 1~7일</li>
                                    </ul>
                                </div>
                                <div class="btm-box">
                                    <p class="title">카카오채널 추가 & 메시지 꼭 주세요!</p>
                                    <p class="txt">[파티신청날짜/이름/전화번호/동행인여부/동행인이름/결제여부]</p>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <div class="title-wrap">
                                <i class="xi-lock"></i>
                                <h2 class="title">
                                    소개팅 환불신청서
                                </h2>
                                <p class="txt">
                                    인사가 제공하는 소개팅 서비스에 가입하기 위하여 계약 내용을 인지하고<br>
                                    이용금액을 결제함으로써 해당 서비스의 가입 및 계약이 성립됩니다. <br>
                                    회사의 가입기준에 따라서 가입이 제한 또는 거절될 수 있으며<br>
                                    그럴 경우에는 전액 환불 도와드리고 있습니다.
                                </p>
                            </div>
                            <div class="request-wrap">
                                <ul class="request-box request-box-2 row-group">
                                    <li class="col-group">
                                        <p class="default">결제금액</p>
                                        <div class="user col-group">
                                            <p class="nonedit">{{ targetRefundOrder.price.toLocaleString() }}</p>원
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불사유</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.reason_request" />
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불계좌은행</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.bank" />
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불계좌번호</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.account" />
                                        </div>
                                    </li>
                                    <li class="col-group">
                                        <p class="default">환불계좌 예금주</p>
                                        <div class="user col-group">
                                            <input class="edit" name="" v-model="refundForm.owner" />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="notice-box">
                                <div class="title-box">
                                    <p class="title">
                                        <i class="xi-warning"></i>
                                        환불 규정
                                    </p>
                                    <p class="txt">
                                        인사가 제공하는 소개팅 서비스에 가입하기 위하여 계약 내용을 인지하고
                                        이용금액을 결제함으로써 해당 서비스의 가입 및 계약이 성립됩니다.
                                        회사의 가입기준에 따라서 가입이 제한 또는 거절될 수 있으며
                                        그럴 경우에는 전액 환불 도와드리고 있습니다.
                                    </p>
                                </div>
                                <div class="con-box">
                                    <ul class="row-group blind-num">
                                        <li>1.인사 가격표는 VAT가 포함된 가격이며, 정찰제로 운영됩니다.</li>
                                        <li>2.프로그램은 1,3,5회권으로 구성되어 있으며 연령대별로 가격이 상이합니다.</li>
                                        <li>3.서비스 이용료 납부와 동시에 상담, 회원 등록, 매칭 등 소개팅 프로세스가
                                            진행되기 때문에 결제금액에서 이용금액과 위약금 20%를 제하고 환불 가능합니다.</li>
                                        <li>4.첫 프로필 제공은 최소 2주가 소요됩니다.</li>
                                        <li>5.첫 프로필 제공 후에 환불 요청 시에는 1회 차감 후 환불됩니다.</li>
                                        <li>6.환불 가능 기간은 프로그램 기간만큼이며, 환불액 산정은 남은 횟수/가입 횟수에 따라
                                            산정됩니다. (즉, 1+1, 3+3, 5+5의 경우, 가입 횟수만큼 추가 서비스 횟수가 제공되기
                                            때문에 환불 시에 가입 횟수는 1,3,5회가 됩니다. )</li>
                                        <li>7.프로필 수령 후 24시간 내에 소개팅 날짜, 장소를 조율해주세요. 24시간 내에
                                            무응답일 경우, 프로그램 진행 회피로 여겨 횟수 차감이나 불이익이 발생합니다.</li>
                                        <li>8.소개팅 확정 후에 취소나 변경 시에는 횟수 차감뿐만 아니라 프로그램 이용이
                                            거절될 수 있습니다.</li>
                                        <li>9.회원권 이용기간은 프로그램 기간과 동일하며, 개인적인 사유(해외파견, 출장,
                                            입원 등)로 추가 연장을 요구하는 경우는 최대 프로그램 기간만큼 유효하며 서류 증빙
                                            후 가능합니다. (단, 기간 연장의 경우 환불은 불가합니다.)</li>
                                        <li>10.인사를 통해 교제하거나 성혼하게 된 경우, 이용 목적이 달성되는 것으로 프로그램
                                            종료나 횟수가 남아 있으실 경우에는 가입하신 프로그램 기간만큼 연장 가능합니다.</li>
                                        <li>11.회원 교제나 성혼의 이유로 이용이 불가할 때, 지인(신규회원)에게 양도 가능합니다.</li>
                                        <li>12.회원이 제출한 개인정보를 사실로 간주하며 허위로 의심되는 경우 진위 여부를
                                            확인하기 위하여 당사자에게 정보에 관하여 증명을 요구할 수 있으며 허위의 사실을
                                            제출한 경우 서비스의 이용을 제한하거나 거부할 수 있으며 손해배상을 청구할 수
                                            있으며, 회사의 과실과 책임은 없습니다.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="submit-btn" @click="refund">환불 요청</button>
                    </div>
                </div>

                <div class="title-wrap col-group">
                    <h2>결제내역</h2>
                    <a href="/refunds" class="refund-btn">환불내역</a>
                </div>

                <ul class="top-wrap col-group">
                    <li>
                        <p class="title">
                            사용 이용권
                        </p>
                        <div class="txt-box col-group">
                            <img src="" alt="">
                            <p class="txt">
                                {{ user.count_matching_dating }}건
                            </p>
                        </div>
                    </li>
                    <li>
                        <p class="title">
                            남은 이용권
                        </p>
                        <div class="txt-box col-group">
                            <img src="" alt="">
                            <p class="txt">
                                {{ user.count_dating }}건
                            </p>
                        </div>
                    </li>
                    <li>
                        <p class="title">
                            예약된 파티
                        </p>
                        <div class="txt-box col-group">
                            <img src="" alt="">
                            <p class="txt">{{ user.count_party }}건</p>
                        </div>
                    </li>
                    <li>
                        <p class="title">
                            마감된 파티
                        </p>
                        <div class="txt-box col-group">
                            <img src="" alt="">
                            <p class="txt">{{ user.count_close_party }}건</p>
                        </div>
                    </li>
                </ul>
                <div class="con-wrap">
                    <div class="search-wrap col-group">
                        <h3 class="title">결제 내역 조회</h3>
                        <form action="" @submit.prevent="filter">
                            <div class="search-box col-group">
                                <input type="date" v-model="form.started_at">
                                <span>-</span>
                                <input type="date" v-model="form.finished_at">
                                <select name="" id="" v-model="form.type">
                                    <option value="">전체</option>
                                    <option value="파티">파티</option>
                                    <option value="소개팅">소개팅</option>
                                </select>
                                <button type="submit" class="search-btn">조회</button>
                            </div>
                        </form>
                    </div>
                    <ul class="payment-list row-group">
                        <li class="date" v-for="order in orders.data" :key="order.id">
                            <div class="tr col-group">
                                <div class="title-box row-group">
                                    <span class="label">{{ order.product.type }}</span>
                                    <p class="title">{{ order.product.title }}</p>
                                </div>
                                <ul class="payment-box col-group">
                                    <li>
                                        <p class="title">결제수단</p>
                                        <p class="txt">{{order.pay_method_name}}</p>
                                    </li>
                                    <li v-if="order.product.type === '파티'">
                                        <p class="title">파티일자</p>
                                        <p class="txt">{{order.product.opened_at}}</p>
                                    </li>
                                    <li v-if="order.product.type === '소개팅'">
                                        <p class="title">충전횟수</p>
                                        <p class="txt">{{order.product.count_dating}}</p>
                                    </li>
                                    <li>
                                        <p class="title">결제금액</p>
                                        <p class="txt">{{order.price.toLocaleString()}}</p>
                                    </li>
                                    <li>
                                        <p class="title">결제날짜</p>
                                        <p class="txt">{{order.created_at}}</p>
                                    </li>

                                    <li class="btn-wrap" v-if="order.can_refund">
                                        <button class="m-btn type01" @click="targetRefundOrder = order">환불요청</button>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="m-empty type01" v-if="orders.data.length === 0">
                        데이터가 없습니다.
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import Sidebar from "../../Components/Sidebar";
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";
import State from "../../Components/State";

export default {
    components: {State, Sidebar, Link, Pagination},
    data() {
        return {
            user: this.$page.props.user.data,
            orders: this.$page.props.orders,
            form: this.$inertia.form({
                page: 1,
                started_at : this.$page.props.started_at,
                finished_at : this.$page.props.finished_at,
                type : this.$page.props.type,
            }),
            refundForm: this.$inertia.form({
                order_id: "",
                reason_request: "",
                bank:"",
                account: "",
                owner:"",
            }),
            targetRefundOrder: ""
        }
    },
    methods: {
        filter() {
            this.form.get("/orders", {
                preserveScroll:true,
                preserveState: true,
                onSuccess: (page) => {
                    this.orders = page.props.orders;
                }
            });
        },
        refund(){
            this.refundForm.order_id = this.targetRefundOrder.id;

            this.refundForm.post("/refunds", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.targetRefundOrder = "";
                    this.orders = page.props.orders;
                }
            })
        }
    }
}
</script>
