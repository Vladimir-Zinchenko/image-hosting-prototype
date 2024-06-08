import 'bootstrap';
import axios from 'axios';
import Dropzone from "dropzone";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let myDropzone = new Dropzone('#uploadForm', {
    url: '/file/post',
    maxFilesize: 5,
    acceptedFiles: '.jpeg,.jpg,.png',
    addRemoveLinks: true,
    timeout: 120000,
    success: function (file, response) {
        console.log(response);
    },
    error: function (file, response) {
        return false;
    }
});
