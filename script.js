const abc = document.getElementById("abc");
const myfile = document.getElementById("myfile");
function clickFunction() {
    abc.value = "abc";
    myfile.value = "";
}
const linkPathUrl = "/sampleSelling-master/util/path_config/get_link.php";
let customerurl = "abc" ;
let geturl =async (name, type) =>  {
    let url;
let formData = new FormData();
formData.append("type", type);
formData.append("name", name);

await fetch(linkPathUrl, { method: "POST", body: formData })
    .then((res) => res.text())
    .then((text) => {
        url = text;
        
    });
return url;
};
let setUrls = async ()=>{
    customerurl = await geturl("customer_cart","relative_path");

    console.log(customerurl)
}
setUrls();
console.log(customerurl);
console.log(customerurl);
console.log(customerurl);
console.log(customerurl);
console.log(customerurl);
console.log(customerurl);

const authorization_process_path = "/sampleSelling-master/user/authorization/process/";
console.log(authorization_process_path+"user_view.php");