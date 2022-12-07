<template>
    <div>

        <header/>

        <slot />

        <flash />

        <footer-vue/>
    </div>

</template>
<script>
import Header from "../Components/Header";
import FooterVue from "../Components/Footer";
import Flash from "../Components/Flash";
export default {
    components: {Header, FooterVue, Flash},
    data(){
        return {
            pathname: location.pathname,
        }
    },
}
</script>
