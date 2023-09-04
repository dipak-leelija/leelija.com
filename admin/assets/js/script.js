const iframeLoaded = (iframeId) => {
    var iFrameID = document.getElementById(iframeId);
    if (iFrameID) {
        // here you can make the height, I delete it first, then I make it again
        iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
    }
}

let statusCheckBox = document.getElementById('statusCheck');
statusCheckBox.addEventListener('click', changeStatus);
function changeStatus() {
    if (statusCheckBox.checked == true) {
        statusCheckBox.labels[0].innerText = 'Active';
        statusCheckBox.classList.remove('bg-danger');
    } else {
        statusCheckBox.labels[0].innerText = 'Deactivated';
        statusCheckBox.classList.add('bg-danger');
    }
}