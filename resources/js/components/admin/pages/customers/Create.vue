<script setup>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import { useRouter } from "vue-router";
const router = useRouter();
const imageFilePath = ref(null)
const srcImageFile = ref(null);
const props = defineProps({
    customer_id: {
        type: String,
        default: ''
    }
})
let isEdit = ref(false)
const customer = ref({})
const editItem = ref({
    // first_name: '',
    // last_name: '',
    // mobile: '',
    // email: ''
})

const errorCustomer = ref({
    first_name: '',
    last_name: '',
    mobile: '',
    email: ''
});

const validCustomerForm = ref(false);
const validCustomer = async () => {
    validCustomerForm.value = true;

    // Validate first name
    if (!editItem.value.first_name) {
        errorCustomer.value.first_name = 'First name is required';
        validCustomerForm.value = false;
    } else {
        errorCustomer.value.first_name = '';
    }

    // Validate email
    if (!editItem.value.email) {
        errorCustomer.value.email = 'Email is required';
        validCustomerForm.value = false;
    } else if (!/\S+@\S+\.\S+/.test(editItem.value.email)) {
        errorCustomer.value.email = 'Invalid email format';
        validCustomerForm.value = false;
    } else {
        errorCustomer.value.email = '';
    }

    // Validate mobile number
    if (!editItem.value.mobile) {
        errorCustomer.value.mobile = 'Mobile number is required';
        validCustomerForm.value = false;
    } else if (!/^[5-9][0-9]{9}$/.test(editItem.value.mobile)) {
        errorCustomer.value.mobile = 'Invalid mobile number';
        validCustomerForm.value = false;
    } else {
        errorCustomer.value.mobile = '';
    }

    return validCustomerForm.value;
};

const clearError = (field) => {
    errorCustomer.value[field] = '';
};
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

const saveData = async () => {
    var isValid = await validCustomer();
    if (!isValid) {
        return;
    }
    const form_data = new FormData();
    form_data.append('first_name', editItem.value.first_name);
    form_data.append('last_name', editItem.value.last_name);
    form_data.append('mobile', editItem.value.mobile);
    form_data.append('email', editItem.value.email);
    form_data.append('address', editItem.value.address);
    form_data.append('photo', imageFilePath.value);
    let res;
    if (props.customer_id !== '') {
        res = await axios.post(`/api/customers/update/${props.customer_id}`, form_data);
    } else {
        res = await axios.post('/api/customers/create', form_data);
    }
    console.log('Response message:', res.data.message);
   // Inside saveData function
    if (res.status == 200) {
        var response_data = res.data;
        if (response_data.status == "success") {
            window.Toast.fire({
                icon: response_data.status,
                title: response_data.message,
            });
        } else {
            window.Toast.fire({
                icon: response_data.status,
                title: response_data.message,
            });
        }
    } else if (res.status == 500) { // Handle 500 status code
        window.Toast.fire({
            icon: 'error', // You may want to use 'error' icon for server errors
            title: res.data.message, // Display the error message from the response
        });
    } else {
        window.Toast.fire({
            icon: 'warning',
            title: "Something Went Wrong....",
        });
    }

    isEdit = false;
    props.customer_id = -1
    router.push('/admin/customers/index');
};


const formBtn = computed(() => {
    return props.customer_id !== '' ? "Update" : "Save";
});
onMounted(async () => {
    if (props.customer_id !== '') {
        onEdit(props.customer_id);
    }
})
const onEdit = async (customerId) => {
    try {
        const res = await axios.get(`/api/customers/edit/${customerId}`);
        if (res.data && res.data.customer) {

            isEdit.value = true;

            editItem.value = res.data.customer;
            srcImageFile.value = res.data.customer.photo;
            console.log('edit datttaa>>>>>>>', editItem.value);
        } else {
            console.error('Customer data not found in response');
        }
    } catch (error) {
        console.error('Error fetching customer data:', error);
    }
};
const getImgUrl = computed(() => {
    console.log('image file', srcImageFile.value);
    return srcImageFile.value !== null && srcImageFile.value !== "" && srcImageFile.value !== undefined
        ? srcImageFile.value
        : "/assets/images/file_uplode_img.png";
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
                                    <h4>Create Customer </h4>
                                    <!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <router-link to="/admin/dashboard">
                                            <i class="icofont icofont-home"></i>
                                        </router-link>
                                    </li>
                                    <li class="breadcrumb-item"><router-link to="/admin/customers/index">Customer
                                            List</router-link>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Create</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header ml-3">
                                    <h5>Add New Customer</h5>
                                    <!-- <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
                                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <!-- <h4 class="sub-title">Basic Inputs</h4> -->
                                    <div>
                                        <div class="">
                                            <label class="col-sm-12 col-md-12 col-lg-12 col-form-label">Upload
                                                File</label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 ">
                                            <label class="custum-file-upload" for="file">
                                                <div class="icon">
                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                        <g stroke-linejoin="round" stroke-linecap="round"
                                                            id="SVGRepo_tracerCarrier"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path fill=""
                                                                d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                                        </g>
                                                    </svg> -->
                                                    <img :src="getImgUrl" alt="Profile" height="60px" width="80px">

                                                </div>
                                                <div class="text">
                                                    <span>Click to upload image</span>
                                                </div>
                                                <input type="file" id="file" @change="imageFileSelect">
                                            </label>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-sm-12 col-form-label">First Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        v-model="editItem.first_name"
                                                        :class="errorCustomer.first_name !== '' ? 'error-field' : ''"
                                                        @input="clearError('first_name')"
                                                        placeholder="Type your first name" />

                                                    <span class="error-label text-center text-danger"
                                                        v-if="errorCustomer.first_name !== ''"
                                                        v-text="errorCustomer.first_name"></span>


                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-sm-12 col-form-label">Last Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" v-model="editItem.last_name"
                                                        placeholder="Type your last name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-sm-12 col-form-label">Mobile Number
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" v-model="editItem.mobile"
                                                        placeholder="Type mobile number " maxlength="10"
                                                        :class="errorCustomer.mobile !== '' ? 'error-field' : ''"
                                                        @input="clearError('mobile')" />

                                                    <span class="error-label text-center text-danger"
                                                        v-if="errorCustomer.mobile !== ''"
                                                        v-text="errorCustomer.mobile"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-sm-12 col-form-label">Email</label>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" v-model="editItem.email"
                                                        placeholder="Type your email id"
                                                        :class="errorCustomer.email !== '' ? 'error-field' : ''"
                                                        @input="clearError('email')" />

                                                    <span class="error-label text-center text-danger"
                                                        v-if="errorCustomer.email !== ''"
                                                        v-text="errorCustomer.email"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Select Box</label>
                                            <div class="col-sm-10">
                                                <select name="select" class="form-control">
                                                    <option value="opt1">Select One Value Only</option>
                                                    <option value="opt2">Type 2</option>

                                                </select>
                                            </div>
                                        </div> -->


                                        <!-- <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Upload File</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control">
                                            </div>
                                        </div> -->

                                        <div class="form-group row ml-1 mr-1">
                                            <label class="col-sm-12 col-form-label">Address</label>
                                            <div class="col-sm-12">
                                                <textarea rows="5" cols="5" class="form-control"
                                                    v-model="editItem.address"
                                                    placeholder="Enter full Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="d-flex mr-3 ml-3">
                                            <button type="button" class="btn btn-primary col-sm-12"
                                                id="primary-popover-content" @click="saveData()">{{ formBtn }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
.error-field {
    border-color: red; /* Set border color to red for indicating error */
}

.error-label {
    color: red; /* Set text color to red for error messages */
    font-size: 0.8em; /* Adjust font size for error messages */
    display: block; /* Ensure error messages are displayed as block elements */
    margin-top: 4px; /* Add some margin between the input field and the error message */
}
.custum-file-upload {
    height: 200px;
        width: 300px;
    display: flex;
    flex-direction: column;
    align-items: space-between;
    gap: 20px;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    border: 2px dashed #cacaca;
    background-color: rgba(255, 255, 255, 1);
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0px 48px 35px -48px rgba(0, 0, 0, 0.1);
    margin-left: 30%;margin-right: 20%;
}

.custum-file-upload .icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.custum-file-upload .icon svg {
    height: 80px;
    fill: rgba(75, 85, 99, 1);
}

.custum-file-upload .text {
    display: flex;
    align-items: center;
    justify-content: center;
}

.custum-file-upload .text span {
    font-weight: 400;
    color: rgba(75, 85, 99, 1);
}

.custum-file-upload input {
    display: none;
}
</style>
