const uploadSamplesNaviBtn = document.querySelector("#upload-samples-navigation")
const uploadbtnurl = "/sampleSelling-master/admin/process/show_upload_navi_btns.php";
const uploadbtnsDiv = document.querySelector("#upload-btns-div");

uploadSamplesNaviBtn.addEventListener('click',()=>{
    fetch(uploadbtnurl,{method:"POST"})
    .then((res)=>res.text())
    .then((text)=>{
        console.log(text);
        uploadbtnsDiv.innerHTML = text;
        
        uploadbtnsDiv.classList.remove("d-none");
        uploadbtnsDiv.classList.remove("uploadBtnDiv");
        uploadbtnsDiv.classList.add("appearFromTopBtnDiv")
    })
})

