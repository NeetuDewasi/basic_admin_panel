<script setup>
import { ref, reactive ,computed} from "vue";
import { routerKey } from "vue-router";
import { useRouter } from "vue-router";
const router = useRouter();
import axios from "axios";
import { onMounted } from "vue";
let all_customers = ref([]);
onMounted(async () => {
    getCustomers();
});
const addCustomer = async () => {
    return router.push("/admin/customers/create");
};
const getCustomers = async () => {
    const res = await axios.get("/api/customers/all");
    all_customers.value = res.data.all_customers;
    console.log("customers>>", all_customers.value);
};
const onEdit = (id) => {
    router.push("/admin/customers/edit/" + id);
};
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
};
const onDelete = async (id, index) => {
    let res = await axios.delete(`/api/customers/delete/${id}`, null);
    console.log("response delete", res);
    if (res.status == 200) {
        if (res.data.message == "Customer deleted successfully") {
            window.Toast.fire({
                icon: "success",
                title: res.data.message,
            });
            all_customers.value.splice(index, 1);
        }
    } else {
        window.Toast.fire({
            icon: "error",
            title: "Something went wrong,unable to delete",
            timer: 2500,
        });
    }
};
const randomColor = () => {
    var red = Math.floor(Math.random() * 256);
    var green = Math.floor(Math.random() * 256);
    var blue = Math.floor(Math.random() * 256);
    return `rgba(${red}, ${green}, ${blue}, 0.6)`;
};
const getImgUrl = computed((customer) => {
    console.log('image file', srcImageFile.value);
    return customer.photo !== null && customer.photo !== "" && customer.photo !== undefined
        ? customer.photo
        : "/assets/images/file_uplode_img.png";
});
</script>
<template>
    <div class="pcoded-inner-content">
        <div class="main-body">t6t
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
                                    <li class="breadcrumb-item">
                                        <a href="#!">Customers List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="ml-3">List of Customers</h5>
                        <!-- <span>For Make row Contextual add Contextual class like <code>.table-success</code> in <code> tr tag</code> and For cell add Contextual class in <code> td or th tag</code> . </span> -->
                        <div class="card-header-right">
                            <button class="bg-primary btn btn-md text-light mr-4" @click="addCustomer()">
                                Add Customer
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row m-3">
                                <div v-for="(customer, i) in all_customers" :key="customer.id" class="col-md-3">
                                    <div class="text-center card pt-3 px-1 shadow-lg pb-2"
                                        style="background-color: #f4ecec;">

                                        <div class="rounded-circle">
                                            <img class="rounded-circle"
                                                :src="customer.photo ? customer.photo : '/assets/images/user_photo.jpg'"
                                                width="120" height="110" />

                                        </div>
                                        <div class="mt-2 align-items-center font-12 text-dark">
                                            <span><i class="ti-hand-point-up mx-2"></i>{{ customer.first_name
                                                }}</span>&nbsp;
                                            <span>{{ customer.last_name
                                                }}</span><br>
                                            <span><i class="ti-mobile mx-2"></i>{{ customer.mobile
                                                }}</span><br />
                                            <span><i class="ti-email mx-2"></i>{{ customer.email }}</span><br />
                                        </div>
                                        <div class="mt-2 px-4">
                                            <div class="flex-grow-1">

                                                <div class="font-10 px-3">
                                                    <button class="button-primary mr-1" @click="onEdit(customer.id)">
                                                        <i class="ti-pencil" style="
                                                                font-size: 20px;
                                                                font-weight: bold;
                                                            "></i>
                                                    </button>
                                                    <button class="button-delete px-4">
                                                        <i class="ti-trash" style="font-size: 20px; font-weight: bold;"
                                                            @click="
                                deleteCustomer(
                                    customer.id,
                                    i
                                )
                                "></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mr-3 text-danger">
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
    </div>
</template>

<style>
.button-primary {
    padding: 5px 20px;
    font-size: 16px;
    background: transparent;
    border: none;
    position: relative;
    color: #f0f0f0;
    z-index: 1;
}

.button-primary::after,
.button-primary::before {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: -99999;
    transition: all .4s;
}

.button-primary::before {
    transform: translate(0%, 0%);
    width: 100%;
    height: 100%;
    background: #5353e6;
    border-radius: 10px;
}

.button-primary:hover::before {
    transform: translate(5%, 20%);
    width: 110%;
    height: 110%;
}

.button-primary:hover::after {
    border-radius: 10px;
    transform: translate(0, 0);
    width: 100%;
    height: 100%;
}

.button-primary:active::after {
    transition: 0s;
    transform: translate(0, 5%);
}

/* for delete button */
.button-delete {
    padding: 5px 20px;
    font-size: 16px;
    background: transparent;
    border: none;
    position: relative;
    color: #f0f0f0;
    z-index: 1;
}

.button-delete::after,
.button-delete::before {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: -99999;
    transition: all .4s;
}

.button-delete::before {
    transform: translate(0%, 0%);
    width: 100%;
    height: 100%;
    background: rgb(221, 70, 70);
    border-radius: 10px;
}

.button-delete:hover::before {
    transform: translate(5%, 20%);
    width: 110%;
    height: 110%;
}

.button-delete:hover::after {
    border-radius: 10px;
    transform: translate(0, 0);
    width: 100%;
    height: 100%;
}

.button-delete:active::after {
    transition: 0s;
    transform: translate(0, 5%);
}
</style>
