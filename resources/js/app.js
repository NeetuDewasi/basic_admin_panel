import { createApp } from "vue";
import mainComponent from "./components/admin/MainComponent.vue";
import router from "./router";
// import common from "./common";
import Swal from "sweetalert2";

const app = createApp({});
app.component("admin-component", mainComponent);
app.use(router);
// app.use(common);S

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2500,
});
window.Toast = Toast;

const SwalCustomBtn = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success mx-1",
        cancelButton: "btn btn-danger mx-1",
        denyButton: "btn btn-info mx-1",
    },
    buttonsStyling: false,
});

window.SwalCustomBtn = SwalCustomBtn;
app.mount("#app");
