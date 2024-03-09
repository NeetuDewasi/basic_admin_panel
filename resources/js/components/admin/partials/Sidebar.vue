<script setup>

import { onMounted, ref } from "vue";
import axios from 'axios';
let user = ref({})

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



</script>
<template>
    <div>
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-40 img-radius" :src="user.photo" alt="User-Profile-Image">
                        <div class="user-details">
                            <span>Neetu</span>
                            <span id="more-details">Admin<i class="ti-angle-down"></i></span>
                        </div>
                    </div>

                    <div class="main-menu-content">
                        <ul>
                            <li class="more-details">
                                <a href="#"><i class="ti-user"></i>View Profile</a>
                                <a href="#!"><i class="ti-settings"></i>Settings</a>
                                <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pcoded-search">
                    <span class="searchbar-toggle"> </span>
                    <div class="pcoded-search-box ">
                        <input type="text" placeholder="Search">
                        <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menus</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="active">
                        <router-link to="/admin/dashboard">
                            <span class="pcoded-micon"><i class="ti-home"></i><b></b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                            <span class="pcoded-mcaret"></span>
                        </router-link>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Customers</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <router-link to="/admin/customers/index">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">List of Customers</span>
                                    <span class="pcoded-mcaret"></span>
                                </router-link>
                            </li>


                        </ul>
                    </li>
                </ul>
                <!-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Forms &amp; Tables</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li>
                        <a href="form-elements-component.html">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Form Components</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="bs-basic-table.html">
                            <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.form-components.main">Basic Table</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul> -->

            </div>
        </nav>

    </div>
</template>


