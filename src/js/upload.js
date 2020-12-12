let btn_upload = document.getElementById("submitPdf");
let progress = document.getElementById("progress");
let fileUpload = document.getElementById("filePdf");


let upload = function () {
    let data = new FormData();
    let request = new XMLHttpRequest();

    request.upload.addEventListener('progress', function(e){
        progress.style.width = (e.loaded/e.total) * 100 + '%';
    }, false);

    for(const file of fileUpload.files) {
        data.append('pdf[]', file);
    }
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText;
            let url = encodeURI("?objet=home&action=show&pdf=" + response);
            window.location.href = url;
        }
    };
    request.open('POST', 'src/CatalogueApp/Controller/upload.php');
    request.send(data);
}
btn_upload.addEventListener('click', upload);
