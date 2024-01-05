import MainPage from "../Pages/MainPage.vue";
import AccountPage from "../Pages/AccountPage.vue";
const routes = [
    {
        path: "/",
        component: MainPage,
        name: "home",
    },
    {
        path: "/account",
        component: AccountPage,
        name: "account",
    },
];

export default routes;
