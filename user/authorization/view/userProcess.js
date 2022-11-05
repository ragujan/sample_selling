function getCart() {

  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}

function upDateCartBagGui(arrayName){
  let cartRowCount = Object.keys(arrayName).length;
  let cartBag = document.getElementById("cartItems");
  if(cartBag == undefined ){
    return;
  }else{
    cartBag.innerHTML = cartRowCount;
  }
 
}
upDateCartBagGui(getCart());
let sendToCustomerCart = () => {
  let cartArray;
  cartArray = JSON.stringify(getCart());

  const url = "../viewcart/addtoCustomerCart.php";
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {});
};


let forgotPassword = () => {
  let inputFieldsEmail = document.getElementById("inputFieldsEmail");

  let url = "../userProcess/forgotPasswordProcess.php";
  const form = new FormData();
  form.append("I", inputFieldsEmail.value);
  fetch(url, { method: "POST", body: form })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        inputFieldsEmail.value = "";
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.remove("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = "";
        window.location = "../userProcess/verifyForgotPassword.php";
      } else {
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.add("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = text;
      }
    });
};

let verifyCode = () => {
  let inputVerifyCode = document.getElementById("inputVerifyCode");

  let url = "../userProcess/verifyForgotPasswordProcess.php";
  const form = new FormData();
  form.append("I", inputVerifyCode.value);
  fetch(url, { method: "POST", body: form })
    .then((response) => response.text())
    .then((text) => {
      if (text == "Success") {
        inputVerifyCode.value = "";
          
        window.location = "../userProcess/changePassword.php";
      } else {
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.add("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = text;
      }
    });
};

let changePassword = () => {
  let inputNewPasswordR = document.getElementById("inputNewPassword");
  
  
  let inputReEnterNewPasswordR = document.getElementById("inputReEnterNewPassword");
  console.log(inputNewPasswordR.value+" "+inputReEnterNewPasswordR.value);
  let url = "../userProcess/changePasswordProcess.php";
  const form = new FormData();
  form.append("I", inputNewPasswordR.value);
  form.append("IR", inputReEnterNewPasswordR.value);
  fetch(url, { method: "POST", body: form })
    .then((response) => response.text())
    .then((text) => {
      if (text == "Success") {
        inputNewPassword.value = "";
        inputReEnterNewPassword.value = "";
        window.location = "../userProcess/signInsignUpPages.php";
        //window.location ="../userProcess/changePasswordProcess.php";
      } else {
        const errorMessageDiv = document.getElementById("errorMessage");
        errorMessageDiv.classList.add("py-2");
        errorMessageDiv.getElementsByTagName("span")[0].innerHTML = text;
      }
    });
};
let userSignIn = () => {
  let pwd = document.getElementById("signpwd").value;
  let em = document.getElementById("signem").value;
  let url = "../userProcess/signInProcess.php";
  const form = new FormData();

  form.append("PWD", pwd);
  form.append("EM", em);

  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        document.getElementById("signpwd").value = "";
        document.getElementById("signem").value = "";   
        sendToCustomerCart();
        window.location = "../home/home.php";   
      }
    });
};
let userSignUp = () => {
  let fn = document.getElementById("fn").value;
  let ln = document.getElementById("ln").value;
  let pwd = document.getElementById("pwd").value;
  let un = document.getElementById("un").value;
  let em = document.getElementById("em").value;
  let repwd = document.getElementById("repwd").value;
  let url = "../userProcess/signUpProcess.php";
  const form = new FormData();
  form.append("FN", fn);
  form.append("LN", ln);
  form.append("PWD", pwd);
  form.append("EM", em);
  form.append("UN", un);
  form.append("REPWD", repwd);

  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      if (text == "Success") {
        const signInDiv = document.getElementById("signInOnly");
        const signUpDiv = document.getElementById("signUpOnly");
        signInDiv.classList.toggle("d-none");
        signUpDiv.classList.toggle("d-none");
        document.getElementById("fn").value = "";
        document.getElementById("ln").value = "";
        document.getElementById("pwd").value = "";
        document.getElementById("un").value = "";
        document.getElementById("em").value = "";
        document.getElementById("repwd").value = "";
      }
    });
};

function hideSignInDiv() {
  const signInDiv = document.getElementById("signInOnly");
  const signUpDiv = document.getElementById("signUpOnly");
  signInDiv.classList.toggle("d-none");
  signUpDiv.classList.toggle("d-none");
}
function hideSignUPDiv() {
  const signInDiv = document.getElementById("signInOnly");
  const signUpDiv = document.getElementById("signUpOnly");
  signInDiv.classList.toggle("d-none");
  signUpDiv.classList.toggle("d-none");
}
let forgotPasswordClick =()=>{
  window.location = "../userProcess/forgotPassword.php";
}


openCloseEyes("showPasswordIcon","signpwd");
openCloseEyes("showPasswordIconSignUp","pwd");
openCloseEyes("reshowPasswordIconSignUp","repwd");
openCloseEyes("inputNewPasswordIcon","inputNewPassword");
openCloseEyes("inputReEnterNewPasswordIcon","inputReEnterNewPassword");


function openCloseEyes(iconID,inputID){ 
    const reeyeIconSup = document.getElementById(iconID);
    const inputField= document.getElementById(inputID);
    if(inputField == undefined || reeyeIconSup == undefined){
      return;
    }else{
      reeyeIconSup.addEventListener("click",()=>{     
        const inputType = inputField.getAttribute("type")==='password'? 'text':'password';
        inputField.setAttribute('type',inputType);
        let imageName = "showPassEyeIcon";
        let srcOpen = `../resources/icons/showPassEyeIcon.png`;
        let srcClose =`../resources/icons/closePassEyeIcon.png`;
        const imageSrc= reeyeIconSup.getAttribute("src") === srcOpen ? srcClose:srcOpen;
        reeyeIconSup.src= imageSrc;      
      })
    }
}