<script setup>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import { useRouter } from "vue-router";
const router = useRouter();

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
            console.log('edit datttaa>>>>>>>', editItem.value);
        } else {
            console.error('Customer data not found in response');
        }
    } catch (error) {
        console.error('Error fetching customer data:', error);
    }
};

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
                                <div class="card-header">
                                    <h5>Add New Customer</h5>
                                    <!-- <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
                                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <!-- <h4 class="sub-title">Basic Inputs</h4> -->
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="editItem.first_name"
                                                    :class="errorCustomer.first_name !== '' ? 'error-field' : ''"
                                                    @input="clearError('first_name')"
                                                    placeholder="Type your first name" />

                                                <span class="error-label text-center text-danger"
                                                    v-if="errorCustomer.first_name !== ''"
                                                    v-text="errorCustomer.first_name"></span>


                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="editItem.last_name"
                                                    placeholder="Type your last name">
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

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Mobile Number
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="editItem.mobile"
                                                    placeholder="Type mobile number " maxlength="10"
                                                    :class="errorCustomer.mobile !== '' ? 'error-field' : ''"
                                                    @input="clearError('mobile')" />

                                                <span class="error-label text-center text-danger"
                                                    v-if="errorCustomer.mobile !== ''"
                                                    v-text="errorCustomer.mobile"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Upload File</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control">
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" v-model="editItem.email"
                                                    placeholder="Type your email id"
                                                    :class="errorCustomer.email !== '' ? 'error-field' : ''"
                                                    @input="clearError('email')" />

                                                <span class="error-label text-center text-danger"
                                                    v-if="errorCustomer.email !== ''"
                                                    v-text="errorCustomer.email"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" class="form-control"
                                                    v-model="editItem.address"
                                                    placeholder="Enter full Address"></textarea>
                                            </div>
                                        </div>
                                        <div class=" text-center">
                                            <button type="button" class="btn btn-primary" id="primary-popover-content"
                                                @click="saveData()">{{ formBtn }} </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="styleSelector">

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

</style>
