<template>
    <main class="store_search">
        <div class="sub-top">
            <h2>
                매장검색
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
                    <a href="/brand/stores">
                        매장안내
                    </a>
                </li>
                <li>
                    <i class="xi-angle-right-min"></i>
                </li>
                <li>
                    <a href="/brand/stores">
                        매장검색
                    </a>
                </li>
            </ul>
            <div class="section container">
                <form action="" @submit.prevent="filter">
                    <div class="search-wrap col-group">
                        <select name="" id="" v-model="form.address" @change="filter">
                            <option value="">
                                시/도
                            </option>
                            <option value="서울시">서울시</option>
                            <option value="세종시">세종시</option>
                            <option value="인천시">인천시</option>
                            <option value="대전시">대전시</option>
                            <option value="광주시">광주시</option>
                            <option value="대구시">대구시</option>
                            <option value="울산시">울산시</option>
                            <option value="부산시">부산시</option>
                            <option value="경기도">경기도</option>
                            <option value="강원도">강원도</option>
                            <option value="충청북도">충청북도</option>
                            <option value="충청남도">충청남도</option>
                            <option value="전라북도">전라북도</option>
                            <option value="전라남도">전라남도</option>
                            <option value="경상북도">경상북도</option>
                            <option value="경상남도">경상남도</option>
                            <option value="제주도">제주도</option>
                        </select>
                        <!--                        <select name="" id="">
                                                    <option value="시/군/구">
                                                        시/군/구
                                                    </option>
                                                </select>-->
                        <input type="text" placeholder="매장명을 검색하세요." v-model="form.word">
                        <button type="submit">
                            <img src="images/icon_search.svg" alt="">
                        </button>
                    </div>
                </form>
                <ul class="tab-link col-group">
                    <li :class="type == '' ? 'active' : ''" data-tab="tab_1" @click='type = "";'>
                        전체(
                        <span>{{stores.data.length}}</span>
                        )
                    </li>
                    <li :class="type == '백화점' ? 'active' : ''" data-tab="tab_2" @click="type = '백화점'">
                        백화점(
                        <span>{{stores.data.filter(store => store.type === '백화점').length}}</span>
                        )
                    </li>
                    <li :class="type == '대리점' ? 'active' : ''" data-tab="tab_3" @click="type = '대리점';">
                        대리점(
                        <span>
                             {{stores.data.filter(store => store.type === '대리점').length}}
                                </span>
                        )
                    </li>
                </ul>
                <div class="search-result-wrap col-group">
                    <div class="store-list-wrap">
                        <ul class="store-list" v-if="type == ''">
                            <li v-for="(store, index) in stores.data" :key="store.id" @click="move(store)">
                                    <span>
                                        {{ store.type }}
                                    </span>
                                <h4>
                                    {{ store.title }}
                                </h4>
                                <p>
                                        <span id="store_address">
                                            {{ store.address }}
                                        </span>
                                    <span class="store-address-detail">
                                            {{ store.address_detail }}
                                        </span>
                                </p>
                                <p>
                                    {{ store.contact }}
                                </p>
                                <p style="white-space: pre-wrap">{{ store.information }}</p>
                            </li>
                        </ul>

                        <ul class="store-list" v-else>
                            <li v-for="store in stores.data.filter(store => store.type === type)" :key="store.id">
                                    <span>
                                        {{ store.type }}
                                    </span>
                                <h4>
                                    {{ store.title }}
                                </h4>
                                <p>
                                        <span id="store_address">
                                            {{ store.address }}
                                        </span>
                                    <span class="store-address-detail">
                                            {{ store.address_detail }}
                                        </span>
                                </p>
                                <p>
                                    {{ store.contact }}
                                </p>
                                <p style="white-space: pre-wrap">{{ store.information }}</p>
                            </li>
                        </ul>

                    </div>
                    <div class="map-box" id="map">

                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6a3822e6f7ecca7e99615e9e27f74cd7&libraries=services"></script>
<style>
    #map img {width:auto; }
</style>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            stores: this.$page.props.stores,
            type: "",
            form: this.$inertia.form({
                page: 1,
                word: this.$page.props.word,
                address: "",
            }),
            map: "",
            markers: [],
            coords: [],
        }
    },
    methods:{
        filter(){
            this.form.get("/brand/stores", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.stores = page.props.stores;

                    this.initMap();
                }
            });
        },

        initMap() {
            const container = document.getElementById("map");
            const options = {
                center: new kakao.maps.LatLng(33.450701, 126.570667),
                level: 5,
            };

            //지도 객체를 등록합니다.
            //지도 객체는 반응형 관리 대상이 아니므로 initMap에서 선언합니다.
            this.map = new kakao.maps.Map(container, options);

            this.stores.data.map(store => {
                this.searchAddress(store.address, store.title);
            });
        },

        searchAddress(address, title) {
            let first = true;
            let self = this;

            var geocoder = new kakao.maps.services.Geocoder();

            geocoder.addressSearch(address, function(result, status) {

                // 정상적으로 검색이 완료됐으면
                if (status === kakao.maps.services.Status.OK) {

                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 결과값으로 받은 위치를 마커로 표시합니다
                    let marker = new kakao.maps.Marker({
                        map: self.map,
                        position: coords
                    });

                    self.markers.push(marker);

                    // 인포위도우
                    let infoWindow = new kakao.maps.InfoWindow({
                        content: '<div style="width:150px; padding:11px 10px; text-align: center; font-weight:bold; font-size:11px;">' + title +'</div>',
                        removable: true,
                    });

                    // 마커 클릭 이벤트
                    kakao.maps.event.addListener(marker, 'click', function() {
                        // 마커 위에 인포윈도우를 표시합니다
                        infoWindow.open(self.map, marker);
                    });

                    // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                    if(first){
                        self.map.setCenter(coords);

                        first = false;
                    }
                }
            });
        },

        move(store){
            var geocoder = new kakao.maps.services.Geocoder();
            let self = this;

            geocoder.addressSearch(store.address, function(result, status) {

                // 정상적으로 검색이 완료됐으면
                if (status === kakao.maps.services.Status.OK) {
                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    self.map.setCenter(coords);
                }
            });
        }
    },
    mounted() {
        if (window.kakao && window.kakao.maps) {
            this.initMap();
        } else {
            const script = document.createElement("script");
            /* global kakao */
            script.onload = () => kakao.maps.load(this.initMap);
            script.src =
                "//dapi.kakao.com/v2/maps/sdk.js?autoload=false&appkey=5e85237532da8edfc3cc9905f1abdd8c&libraries=services";
            document.head.appendChild(script);
        }
    },


}
</script>
