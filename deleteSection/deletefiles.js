function deletesample(x){

    let form = new FormData();
    form.append("ID",x);
    let url = "deletefilesprocess.php";
    fetch(url,{body:form,method:"POST"})
    .then((response)=>response.text())
    .then((text)=>{
        alert(text);
    })
}