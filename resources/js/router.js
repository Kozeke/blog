import VueRouter from "vue-router";
import Login from "./views/auth/Login";
import Register from "./views/auth/Register";
import Articles from "./views/articles/Articles";
import MyArticle from "./views/articles/MyArticle";
import Article from "./views/articles/Article";

export default new VueRouter({
    mode: "history",
    base: __dirname,
    routes: [
        {
            path: "/",
            name: "Главная",
            component: Articles,
            meta: {
                title: "Добро пожаловать | Блог",
                forVisotrs: true
            }
        },
        {
            path: "/Article",
            name: "Article",
            component: Article,
            meta: {
                title: "Пост | Блог",
                forVisotrs: true
            }
        },
        {
            path: "/login",
            name: "Логин",
            component: Login,
            meta: {
                title: "Вход",
                forVisotrs: true
            }
        },
        {
            path: "/register",
            name: "Зарегистрироваться",
            component: Register,
            meta: {
                title: "Зарегистрироваться",
                forVisotrs: true
            }
        },
        {
            path: "/MyArticle",
            name: "MyArticle",
            component: MyArticle,
            meta: {
                title: "Мои статьи",
                forVisotrs: true
            }
        }
    ]
});
