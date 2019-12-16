require("./bootstrap");
window.Vue = require("vue");

import Articles from "./views/articles/Articles";
import Headbar from "./components/Headbar";

import router from "./router";

import CKEditor from "@ckeditor/ckeditor5-vue";

import VueRouter from "vue-router";
Vue.use(VueRouter);
Vue.use(CKEditor);

import axios from "axios";

const app = new Vue({
    el: "#app",
    components: {
        articles: Articles,
        headbar: Headbar
    },
    data: {
        init: true,
        userId: "",
        userName: "",
        chosenArticle: "",
        articles: ""
    },
    router,
    mounted() {
        this.userInit();
        this.chooseArticle();
    },
    methods: {
        userInit() {
            if (localStorage.getItem("token")) {
                this.init = false;
                console.log("Authenticated");
                this.userName = localStorage.getItem("userName");
                this.userId = localStorage.getItem("userId");
            }
        },
        chooseArticle() {
            if (localStorage.getItem("articleId")) {
                this.chosenArticle = localStorage.getItem("articleId");
            }
        }
    },
    watch: {
        chosenArticle: function() {
            localStorage.setItem("articleId", this.chosenArticle);
        }
    }
});
