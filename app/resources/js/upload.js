import Dropzone from "dropzone";

export default function () {
    const form = document.getElementById("uploadForm");

    if (!form) {
        return;
    }

    const dropzoneContainer = form.getElementsByClassName('dropzone')[0];
    const csrf = form.querySelector('[name="_token"]');

    const uploadZone = new Dropzone(dropzoneContainer, {
        url: form.getAttribute('action'),
        maxFilesize: 5,
        parallelUploads: 5,
        autoProcessQueue: false,
        acceptedFiles: '.jpeg,.jpg,.png',
        addRemoveLinks: true,
        timeout: 120000,
        uploadMultiple: true,
        success: function (file, response) {
            // console.log(file);
            window.location.href = '/';
        },
        error: function (file, response) {
            return false;
        }
    });

    uploadZone.on('sending', (file, xhr, formData) => {
        formData.append('_token', csrf.value);
    });

    document.getElementById('resetFiles').addEventListener('click', (e) => {
        e.preventDefault();
        uploadZone.removeAllFiles(true);
    });

    document.getElementById('processUpload').addEventListener('click', (e) => {
        e.preventDefault();
        uploadZone.processQueue();
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        uploadZone.processQueue();
    });
}
