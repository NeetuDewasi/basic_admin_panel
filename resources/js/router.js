// router.js
import { createRouter, createWebHistory } from "vue-router";
import AdminDashboard from "./components/admin/pages/dashboard/Dashboard.vue";
import CustomerCreate from "./components/admin/pages/customers/Create.vue";
import CustomerList from "./components/admin/pages/customers/Index.vue";
import CustomerEdit from "./components/admin/pages/customers/Create.vue";
import AdminProfile from "./components/admin/pages/profile/EditViewProfile.vue";
import BlogEvents from "./components/admin/pages/blog_events/Index.vue";
import BlogEventsCreate from "./components/admin/pages/blog_events/Create.vue";

const routes = [
    {
        name: "admin.dashboard",
        path: "/admin/dashboard",
        component: AdminDashboard,
        // props: true,
    },
    {
        name: "admin.customers.create",
        path: "/admin/customers/create",
        component: CustomerCreate,
    },
    {
        name: "admin.customers.index",
        path: "/admin/customers/index",
        component: CustomerList,
    },
    {
        name: "admin.customers.edit",
        path: "/admin/customers/edit/:customer_id",
        component: CustomerEdit,
        props: true,
    },
    {
        name: "admin.profile.edit",
        path: "/admin/profile/edit",
        component: AdminProfile,
    },
    {
        name: "admin.blog_events",
        path: "/admin/blog_events",
        component: BlogEvents,
    },
    {
        name: "admin.blog_events.create",
        path: "/admin/blog_events/create",
        component: BlogEventsCreate,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
