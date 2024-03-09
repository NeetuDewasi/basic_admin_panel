
<script setup>
import axios from 'axios';
import { onMounted, ref, computed } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
const showModel = ref(false)
const hideModel = ref(true)
const imageFilePath = ref(null)
const srcImageFile = ref(null);
const user = ref({
    id: '',
    name: ''
})
const props = defineProps({
    user_id: {
        type: String,
        default: ''
    }
})
const csrfToken = ref(document.querySelector('meta[name="csrf-token"]').getAttribute("content"));
const getUser = async () => {
    try {
        let response = await axios.get(`/api/user_data`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken.value
            }
        });
        console.log('user profile dataaa', response.data.user);
        user.value = response.data.user[0];
        srcImageFile.value = user.value.photo;
        console.log('updated pic', response.data.user[0].photo);
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
};
onMounted(async () => {
    getUser();
    onMounted(() => {
        // srcImageFile.value = "/assets/images/my_pic.jpg";
    });
})
const openModel = () => {
    showModel.value = !showModel.value
}
const closeModel = () => {
    showModel.value = !hideModel.value
}
const imageFileSelect = async (e) => {
    const file = e.target.files[0];
    if (file) {
        srcImageFile.value = URL.createObjectURL(file);
        imageFilePath.value = file;
    } else {
        srcImageFile.value = null;
        imageFilePath.value = null;
    }
};


const updateUser = async () => {
    try {
        var formData = new FormData();
        formData.append('name', user.value.name);
        formData.append('password', user.value.password);
        formData.append('email', user.value.email);
        formData.append('address', user.value.address);
        formData.append('photo', imageFilePath.value);

        const res = await axios.post(`/api/user_update`, formData, {
            headers: {
                'X-CSRF-TOKEN': csrfToken.value
            }
        });

        if (res.status == 200) {
            var response_data = res.data;
            if (response_data.status == "success") {
                window.Toast.fire({
                    icon: response_data.status,
                    title: response_data.message,
                    timer: 2500,
                });
            }
        } else {
            window.Toast.fire({
                icon: 'warning',
                title: "Something Went Wrong....",
                timer: 2500,
            });
        }
    } catch (error) {
        console.error("Error:", error);
        window.Toast.fire({
            icon: 'error',
            title: "An error occurred.",
            timer: 2500,
        });
    }
    showModel.value = false;
}

const getImgUrl = computed(() => {
    console.log('image file', srcImageFile.value);
    return srcImageFile.value !== null && srcImageFile.value !== "" && srcImageFile.value !== undefined
        ? srcImageFile.value
        : "/assets/images/pattern2.jpg";
});

</script>

<template>
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                <div class="d-inline my-2">
                                    <h4> Admin Profile </h4>
                                    <!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>

                                    <li class="breadcrumb-item"><a href="#!">View Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                   <img :src="srcImageFile" alt="Profile" class="rounded-circle">
    <h2>{{ user && user.name ? user.name : '' }}</h2>
                                    <h3>Web Developer</h3>
                                    <div class="social-links mt-2">
                                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Overview</button>
                                        </li>

                                        <li class="nav-item" @click="openModel()">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Edit Profile</button>
                                        </li>


                                    </ul>
                                    <div class="tab-content pt-2">

                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <h5 class="card-title"></h5>
                                            <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam
                                                maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor.
                                                Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi
                                                sed ea saepe at unde.</p>

                                            <h5 class="card-title">Profile Details</h5>


                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <!-- {{ user[0].name }} -->
                                                    {{ user && user.name ? user.name : '' }}
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <!-- {{ user[0].email }} -->
                                                    {{ user && user.email ? user.email : '' }}
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <!-- <input name="password" type="password" class="form-control" id="currentPassword" :value="user.password"> -->
                                                    {{ user && user.password ? user.password : '' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit"
                                            :class="{ show: showModel }">

                                            <!-- Profile Edit Form -->
                                            <form>
                                                <span class="modal__close btn__close--modal" @click="closeModel()">×</span>
                                                <div class="row mb-3">
                                                    <label for="profileImage"
                                                        class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <img :src="getImgUrl" alt="Profile" height="60px" width="80px">

                                                        <div class="pt-2">
                                                            <i class="bi bi-upload">
                                                                <input type="file" accept="image/*"
                                                                    @change="imageFileSelect" />
                                                            </i>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                        Name</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="fullName" type="text" class="form-control"
                                                            id="fullName" v-model="user.name">
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="Email"
                                                        class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="email" type="email" class="form-control" id="Email"
                                                            v-model="user.email">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="currentPassword"
                                                        class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="password" type="password" class="form-control"
                                                            id="currentPassword" v-model="user.password">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                        Password</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="newpassword" type="password" class="form-control"
                                                            id="newPassword" v-model="user.password">
                                                    </div>
                                                </div>
                                                <!-- <div class="row mb-3">
                          <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control" id="Address" v-model="user.address">
                          </div>
                        </div> -->

                                                <!-- <div class="row mb-3">
                          <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
                          </div>
                        </div> -->
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary" @click.prevent="updateUser()">Save Changes</button>
                                                </div>
                                            </form><!-- End Profile Edit Form -->

                                        </div>


                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<style>
.show {
    display: block !important;
    margin-top: 0px !important;
}

.modal {
    display: none;
    position: absolute;
    z-index: 1;
    padding-top: 10%;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    color: #454f5b;
    /* Center the modal horizontally */
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal__close {
    color: #aaaaaa;
    font-size: 28px;
    font-weight: bold;
    top: 5px;
    right: 15px;
    position: absolute;
    cursor: pointer;
    /* Move the close button to the top right corner */
    top: 10px;
    right: 10px;
}

.tab-pane.profile-edit {
    /* Ensure the modal content overlaps the top content */
    position: relative;
    z-index: 1;
    background-color: #fff;
    /* Set background color */
    padding: 20px;
    /* Add padding */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Add box shadow */
}


.profile .profile-card img {
    max-width: 120px !important;
}

.profile .profile-card h2 {
    font-size: 24px !important;
    font-weight: 700 !important;
    color: #2c384e !important;
    margin: 10px 0 0 0 !important;
}

.profile .profile-card h3 {
    font-size: 18px !important;
}

.profile .profile-card .social-links a {
    font-size: 20px !important;
    display: inline-block !important;
    color: rgba(1, 41, 112, 0.5) !important;
    line-height: 0 !important;
    margin-right: 10px !important;
    transition: 0.3s !important;
}

.profile .profile-card .social-links a:hover {
    color: #012970 !important;
}

.profile .profile-overview .row {
    margin-bottom: 20px !important;
    font-size: 15px !important;
}

.profile .profile-overview .card-title {
    color: #012970 !important;
}



label {
    font-weight: 600 !important;
    color: rgba(1, 41, 112, 0.6) !important;
}

.profile .profile-edit img {
    max-width: 120px !important;
}</style>
