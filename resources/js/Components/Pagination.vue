<template>
    <ul class="page-nav">
        <li><a href=""  @click.prevent="prev"><i class="xi-angle-left"></i></a></li>
        <li v-for="page in pages" :key="page">
            <a href="#" @click.prevent="paginate(page)" :class="pageClass(page)">{{page}}</a>
        </li>
        <li><a href="" @click.prevent="next"><i class="xi-angle-right"></i></a></li>
    </ul>
</template>
<script>
export default {
    props:["meta"],

    data(){
        return {
            pageSections: []
        }
    },

    computed: {
        pages(){
            return this.pageSections.find(pageSection => {
                if(pageSection.includes(this.meta.current_page))
                    return true;
            })
        },
    },

    mounted() {
        this.setPages();
    },

    methods: {
        pageClass(page){
            return this.meta.current_page == page
                ? "now"
                : "";
        },

        paginate(page){
            this.$emit("paginate", page);
        },

        first(){
            this.paginate(1);
        },

        prev(){
            if(this.meta.current_page > 1)
                this.paginate(parseInt(this.meta.current_page) - 1);
        },

        next(){
            if(this.meta.current_page < this.meta.last_page)
                this.paginate(parseInt(this.meta.current_page) + 1);
        },

        last(){
            this.paginate(this.meta.last_page);
        },

        setPages(){
            let unit = 10;

            let items = [];

            this.pageSections = [];

            for(let i=1; i<= this.meta.last_page; i++){
                items.push(i);

                if(items.length >= unit || i == this.meta.last_page) {
                    this.pageSections.push(items);
                    items = [];
                }
            }
        }
    },

    watch: {
        'meta': {
            deep:true,
            handler() {
                this.setPages();
            }
        },

    }


}
</script>
