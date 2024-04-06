<script setup>

import { onMounted, ref } from "vue";
import { routerKey } from "vue-router";
import { useRouter } from "vue-router";
const router = useRouter();
import axios from 'axios';
let user = ref({})
const userLogout = ref(null)

onMounted(async () => {
    getUser();
})
const csrfToken = ref(document.querySelector('meta[name="csrf-token"]').getAttribute("content"));
const getUser = async () => {
    try {
        let response = await axios.get(`/api/user_data`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken.value
            }
        });
        console.log('dataaa', response.data.user);
         user.value = response.data.user[0];
        // srcImageFile.value = user.value.photo;
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
};

const logout = async () => {
    console.log('value',userLogout.value);
    if (userLogout.value) {
        userLogout.value.submit();
        return router.push('/');
    }
}
// const handleClick = () => {
//     localStorage.removeItem('token');
//     router.push('/')
// }

const adminProfile = () => {
    router.push('/admin/profile/edit/')
}
</script>
<template>
       <nav class="navbar header-navbar pcoded-header">
                        <div class="navbar-wrapper">

                            <div class="navbar-logo">
                                <a class="mobile-menu" id="mobile-collapse" href="#!">
                                    <i class="ti-menu"></i>
                                </a>
                                <a class="mobile-search morphsearch-search" href="#">
                                    <i class="ti-search"></i>
                                </a>
                                <router-link to="/admin/dashboard">
                                    <!-- <img class="img-fluid" src="/assets/images/logo.png" alt="Theme-Logo" /> -->
                                <i class="fa fas-user"></i>Admin Panel
                                </router-link>
                                <a class="mobile-options">
                                    <i class="ti-more"></i>
                                </a>
                            </div>

                            <div class="navbar-container container-fluid">
                                <ul class="nav-left">
                                    <li>
                                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                    </li>

                                    <li>
                                        <a href="#!" onclick="javascript:toggleFullScreen()">
                                            <i class="ti-fullscreen"></i>
                                        </a>
                                    </li>
                                </ul>
                                
                                <ul class="nav-right">
                                    <li class="header-notification">
                                        <a href="#!">
                                            <i class="ti-bell"></i>
                                            <span class="badge bg-c-pink"></span>
                                        </a>
                                        <ul class="show-notification">
                                            <li>
                                                <h6>Notifications</h6>
                                                <label class="label label-danger">New</label>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center img-radius" :src="user.photo" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">Neetu</h5>
                                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                        <span class="notification-time">30 minutes ago</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center img-radius" src="/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">Joseph William</h5>
                                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                        <span class="notification-time">30 minutes ago</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center img-radius" src="/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">Sara Soudein</h5>
                                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                        <span class="notification-time">30 minutes ago</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="user-profile header-notification">
                                        <a href="#!">
                                            <img :src="user.photo" class="img-radius" alt="User-Profile-Image">
                                            <span>Neetu</span>
                                            <i class="ti-angle-down"></i>
                                        </a>
                                        <ul class="show-notification profile-notification">
                                            <li>
                                                <a href="#!">
                                                    <i class="ti-settings"></i> Settings
                                                </a>
                                            </li>
                                            <li @click="adminProfile()">
                                                <a href="#">
                                                    <i class="ti-user"></i> Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-email"></i> My Messages
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-lock"></i> Lock Screen
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="logout()" style="cursor: pointer">
                                                    <i class="ti-layout-sidebar-left"></i> Logout
                                                </a>
                                                  <form ref="userLogout" id="logout-form" action="/logout" method="POST" style="display: none">
                                <input type="hidden" name="_token" :value="csrfToken" />
                            </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
</template>


    <!-- Your template here -->


<!-- <script>

export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            user: null
        };
    },
    mounted() {
        this.$parent.getUsers();
    },
    methods: {
        async showData() {
            const res = await this.callApi("get", `/api/user_data`, null);
            if (res.status == 200) {
                var data = res.data;
                if (data.status == "success") {
                    this.user = data.user;
                }
            }
        },

    }
};
</script> -->

