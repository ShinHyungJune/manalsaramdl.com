<template>
    <main class="review review_write">
        <input-imgs @change="data => form.imgs = data" />

        <div class="m-input-error">{{form.errors.imgs}}</div>
    </main>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue';
import Pagination from "../../../Components/Pagination";
import InputFile from "../../../Components/Form/InputFile";
import InputImgs from "../../../Components/Form/InputImgs";
import InputAddress from "../../../Components/Form/InputAddress";

export default {
    components: {InputAddress, InputImgs, InputFile, Link, Pagination},
    data(){
        return {
            agree: false,
            form: this.$inertia.form({
                page: 1,
                name: "",
                contact: "",
                address: "",
                address_detail: "",
                address_zipcode: "",
                elevator: "",
                contact_time: "",
                type: "",
                product: "",
                size: "",
                more_service: "",
                description: "",
            })
        }
    },
    methods:{
        store(){
            if(!this.agree)
                return alert("약관에 동의해주세요.");

            this.form.post("/brand/homecares", {
                preserveScroll: true,
                preserveState: true,
                onSuccess: (page) => {

                }
            });
        },


    }
}
</script>
