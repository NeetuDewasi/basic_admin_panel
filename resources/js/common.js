// common.js
import axios from "axios";

var headers = {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
};

const axiosInstance = axios.create({
    headers: headers,
});

export default {
    methods: {
        callApi(method, url, data) {
            try {
                return axiosInstance({
                    method: method,
                    url: url,
                    data: data,
                    headers: headers,
                });
            } catch (e) {
                return e.response;
            }
        },
    },
};
