<script setup>
import { ref, reactive } from "vue";
import { routerKey } from "vue-router";
import { useRouter } from "vue-router";
const router = useRouter();
import axios from 'axios';
import { onMounted } from "vue";
let all_customers = ref([])
onMounted(async () => {
    getCustomers()
})
const addCustomer = async () => {
    return router.push('/admin/customers/create');
}
const getCustomers = async () => {
    const res = await axios.get('/api/customers/all')
    all_customers.value = res.data.all_customers;
    console.log('customers>>', all_customers.value)
}
const onEdit = (id) => {
    router.push('/admin/customers/edit/' + id)
}
const deleteCustomer = async (id, index) => {
    SwalCustomBtn.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            onDelete(id, index);
        }
    });
}
const onDelete = async (id, index) => {
    let res = await axios.delete(`/api/customers/delete/${id}`, null)
    console.log('response delete', res)
    if (res.status == 200) {
        if (res.data.message == "Customer deleted successfully") {
            window.Toast.fire({
                icon: 'success',
                title: res.data.message
            });
            all_customers.value.splice(index, 1)

        }
    } else {
        window.Toast.fire({
            icon: 'error',
            title: 'Something went wrong,unable to delete',
            timer: 2500
        })
    }
}
</script>
<template>
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-table bg-c-blue"></i>
                                <div class="d-inline mt-3">
                                    <h4>Customers</h4>
                                    <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
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
                                    <li class="breadcrumb-item"><a href="#!">Customers List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>List of Customers</h5>
                        <!-- <span>For Make row Contextual add Contextual class like <code>.table-success</code> in <code> tr tag</code> and For cell add Contextual class in <code> td or th tag</code> . </span> -->
                        <div class="card-header-right">
                            <button class="bg-primary btn btn-md text-light" @click="addCustomer()">
                                Add Customer</button>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-active" v-for="(customer, i) in  all_customers" :key="customer.id">
                                        <th scope="row">{{ i + 1 }}</th>
                                        <td>{{ customer.first_name }}</td>
                                        <td>{{ customer.last_name }}</td>
                                        <td>{{ customer.mobile }}</td>
                                        <td>{{ customer.email }}</td>
                                        <td><button class="btn  btn-sm" @click="onEdit(customer.id)"><i
                                                    class="fas fa-reply"></i>Edit</button></td>
                                        <td><button class="btn  btn-sm" @click="deleteCustomer(customer.id, i)"><i
                                                    class="fa fa-trash"></i>Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
