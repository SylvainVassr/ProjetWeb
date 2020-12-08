let btn_upload = document.getElementById("submitPdf");
let progress = document.getElementById("progress");
let file = document.getElementById("filePdf");

let upload = function () {
    let data = new FormData();
    data.append('pdf', file[0]);

    let request = new XMLHttpRequest();
    request.open('POST', '?objet=home');

    console.log(file.files[0].name);

    request.upload.addEventListener('progress', function(e){
        progress.style.width = Math.ceil(e.loaded/e.total) * 100 + '%';
    }, false);

    request.addEventListener('load', function(e) {
        // console.log(request.status);
        // console.log(request.response);
    });

    request.send(data);
}
btn_upload.addEventListener('click', upload);
