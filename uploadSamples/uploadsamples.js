let nlinks = document.querySelectorAll('.navlinks');
let upBTN = document.getElementById('uploadbutton');
let upBTN2 = document.getElementById('uploadbutton2')
let sampleType = document.getElementById('sampleType');
let uploadFilesOnly = document.getElementById('uploadFileOnly');
let uploadAudioOnly = document.getElementById('uploadAudioOnly');
let uploadImageOnly = document.getElementById('uploadImageOnly');
let sampletypeselect = document.getElementById('sampleType');


sampletypeselect.addEventListener('change', () => {
    let subsample = document.getElementById('mtDIV');
    subsample.className = "rag";
    console.log(sampletypeselect.value);

    let x = sampletypeselect.value;
    let loc;
    if (x == 1) {
        loc = "submelody.php";

    } else if (x == 2) {
        loc = "subdrum.php";

    } else {
        loc = ""
        return;
    }

    fetch(loc, { method: "GET" })
        .then(response => response.text())
        .then(text => {
            subsample.innerHTML = text;
        })

})



function uploadProcess() {



}

upBTN.addEventListener('click', function() {
    let samplePrice = document.getElementById('samplePrice');
    let sampleName = document.getElementById('sampleName');
    let sampleType = document.getElementById('sampleType');
    let sampleAudio = document.getElementById('sampleAudio');
    let sampleFile = document.getElementById('sampleFile');
    let sampleImage = document.getElementById('sampleImage');
    let submelodytype = document.getElementById('submelodyType');
    let sampledescription = document.getElementById('sampleDescription');


    let form_1 = new FormData();
    let form_2 = new FormData();
    form_2.append('SamplePrice', samplePrice.value);
    form_2.append('SampleName', sampleName.value);
    form_2.append('SampleType', sampleType.value);
    form_2.append('SampleFile', sampleFile.files[0]);
    form_2.append('SampleAudio', sampleAudio.files[0]);
    form_2.append('SampleImage', sampleImage.files[0]);
    form_2.append('SampleSubMelody', submelodytype.value);
    form_2.append('SampleDescription', sampledescription.value);

  
    let url = "storeSamples.php";
    fetch(url, { body: form_2, method: "POST" })
        .then(response => response.text())
        .then((text) => { alert(text); })



})