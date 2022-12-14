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
                    <a href="/">
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
                            <option value="서울특별시">서울특별시</option>
                            <option value="인천광역시">인천광역시</option>
                            <option value="대전광역시">대전광역시</option>
                            <option value="광주광역시">광주광역시</option>
                            <option value="대구광역시">대구광역시</option>
                            <option value="울산광역시">울산광역시</option>
                            <option value="부산광역시">부산광역시</option>
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
                    <li class="active" data-tab="tab_1" @click="type = '';">
                        전체(
                        <span>{{stores.data.length}}</span>
                        )
                    </li>
                    <li data-tab="tab_2" @click="type = '백화점'">
                        백화점(
                        <span>{{stores.data.filter(store => store.type === '백화점').length}}</span>
                        )
                    </li>
                    <li data-tab="tab_3" @click="type = '대리점';">
                        대리점(
                        <span>
                             {{stores.data.filter(store => store.type === '대리점').length}}
                                </span>
                        )
                    </li>
                </ul>
                <div class="search-result-wrap col-group">
                    <div class="store-list-wrap">
                        <ul class="store-list">
                            <li v-for="store in stores.data.filter(store => store.type == type)" :key="store.id">
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
                                <p>
                                    {{ store.information }}
                                </p>
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

<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../Components/Pagination";

export default {
    components: {Link, Pagination},
    data(){
        return {
            stores: this.$page.props.stores,
            type: "",
            form: this.$inertia.form({
                page: 1,
                address: "",
            }),
            map: ""
        }
    },
    methods:{
        filter(){
            this.form.get("/brand/stores", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {
                    this.stores = page.props.stores;
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
        },

        changeSize(size) {
            const container = document.getElementById("map");
            container.style.width = `${size}px`;
            container.style.height = `${size}px`;
            this.map.relayout();
        },

        displayMarker(markerPositions) {
            if (this.markers.length > 0) {
                this.markers.forEach((marker) => marker.setMap(null));
            }

            const positions = markerPositions.map(
                (position) => new kakao.maps.LatLng(...position)
            );

            if (positions.length > 0) {
                this.markers = positions.map(
                    (position) =>
                        new kakao.maps.Marker({
                            map: this.map,
                            position,
                        })
                );

                const bounds = positions.reduce(
                    (bounds, latlng) => bounds.extend(latlng),
                    new kakao.maps.LatLngBounds()
                );

                this.map.setBounds(bounds);
            }
        },

        displayInfoWindow() {
            if (this.infowindow && this.infowindow.getMap()) {
                //이미 생성한 인포윈도우가 있기 때문에 지도 중심좌표를 인포윈도우 좌표로 이동시킨다.
                this.map.setCenter(this.infowindow.getPosition());
                return;
            }

            var iwContent = '<div style="padding:5px;">Hello World!</div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
                iwPosition = new kakao.maps.LatLng(33.450701, 126.570667), //인포윈도우 표시 위치입니다
                iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시됩니다

            this.infowindow = new kakao.maps.InfoWindow({
                map: this.map, // 인포윈도우가 표시될 지도
                position: iwPosition,
                content: iwContent,
                removable: iwRemoveable,
            });

            this.map.setCenter(iwPosition);
        },
    },
    mounted() {
        if (window.kakao && window.kakao.maps) {
            this.initMap();
        } else {
            const script = document.createElement("script");
            /* global kakao */
            script.onload = () => kakao.maps.load(this.initMap);
            script.src =
                "//dapi.kakao.com/v2/maps/sdk.js?autoload=false&appkey=6a3822e6f7ecca7e99615e9e27f74cd7&libraries=services";
            document.head.appendChild(script);
        }

        var mapContainer = document.getElementById('map'), // 지도를 표시할 div
            mapOption = {
                center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
                level: 3 // 지도의 확대 레벨
            };

        // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
        var map = new kakao.maps.Map(mapContainer, mapOption);

        // 주소-좌표 변환 객체를 생성합니다
        var geocoder = new kakao.maps.services.Geocoder();

        // 주소로 좌표를 검색합니다
        geocoder.addressSearch('제주특별자치도 제주시 첨단로 242', function(result, status) {

            // 정상적으로 검색이 완료됐으면
            if (status === kakao.maps.services.Status.OK) {

                var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                // 결과값으로 받은 위치를 마커로 표시합니다
                var marker = new kakao.maps.Marker({
                    map: map,
                    position: coords
                });

                // 인포윈도우로 장소에 대한 설명을 표시합니다
                var infowindow = new kakao.maps.InfoWindow({
                    content: '<div style="width:150px;text-align:center;padding:6px 0;">우리회사</div>'
                });
                infowindow.open(map, marker);

                // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                map.setCenter(coords);
            }
        });
    },


}
</script>
