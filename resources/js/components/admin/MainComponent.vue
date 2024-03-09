<script setup>

import { onMounted, ref } from 'vue';
import router from '../../router';
import axios from 'axios';
import Header from './partials/Header.vue';
import Sidebar from './partials/Sidebar.vue';
let user = ref({})

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})
onMounted(async () => {

})
const getUsers = async () => {
    let response = await axios.get(`/api/user_data`)
    // console.log('dataaa', response.data.user);
    user.value = response.data.user
}
const print = () => {
    window.print()
    router.push('/').catch(() => { })
}
const onEdit = (id) => {
    router.push('/invoice/edit/' + id)
}

</script>
<template>
    <div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">

                <Header ref="header"/>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <Sidebar />
                        <div class="pcoded-content">
                            <router-view :key="$router.fullPath"></router-view>
                        </div>
                    </div>
                </div>
                <div class="fixed-button">
                    <a href="https://codedthemes.com/item/guru-able-admin-template/" target="_blank"
                        class="btn btn-md btn-primary">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
                    </a>
                </div>
            </div>
        </div>

    </div>
</template>




