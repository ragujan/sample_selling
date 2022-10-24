let nlinks = document.querySelectorAll(".navlinks");
let upBTN = document.getElementById("uploadbutton");
let upBTN2 = document.getElementById("uploadbutton2");
let sampleType = document.getElementById("sampleType");
let uploadFilesOnly = document.getElementById("uploadFileOnly");
let uploadAudioOnly = document.getElementById("uploadAudioOnly");
let uploadImageOnly = document.getElementById("uploadImageOnly");

const midi_display_process_url = "/sampleSelling-master/product_view/midi_files/midi_display_process.php"


let c =(text)=>{console.log(text)};

function sanitizerInput(data) {
  const div = document.createElement("div");
  div.textContent = data;
  return div.innerHTML;
}
document.getElementsByClassName('container-fluid')[0].style.display = "none";
window.addEventListener("load", async () => {
  //  let val = 0
  document.getElementById('loadingScreen').classList.toggle('d-none');
  setTimeout(async ()=>{
    let val = 0;
    let sampleselect=0;
    let form = new FormData();
    form.append("SSTN", sampleselect);
    form.append("PG", val);
     
    let url = midi_display_process_url;
    fetch(url, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
          console.log(text);
        let samplebox = document.getElementById("sampleTypeMidi");
        samplebox.innerHTML = text;
        document.getElementById('loadingScreen').classList.toggle('d-none');
        document.getElementsByClassName('container-fluid')[0].style.display = "block";
      })
      .catch((error)=>{
        console.log("Error",error);
      });
   
  },300)

});


function showsubsamples() {
    let val = 0;
    let sampleselect = document.getElementById("subSampleMelodyID").value;
  
    let form = new FormData();
    // if (sampleselect !== "ALL") {
    //   
    // }
    form.append("SSTN", sampleselect);
    form.append("PG", val);
     
    let url = midi_display_process_url;
    fetch(url, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
          console.log(text);
        let samplebox = document.getElementById("sampleTypeMidi");
        samplebox.innerHTML = text;
      });
  }
  



function nextfunctiondrums(x, y) {
  let sampleContainer = document.getElementById("thesamplecontainer1");
  // sampleContainer.scrollIntoView()
  console.log(x, y);
  let val = x;
  let sampleselect = y;
  let form = new FormData();

  if (y !== null) {
    form.append("SSTN", sampleselect);
  } else {
    alert("hey");
  }

  form.append("PG", val);

  let url = midi_display_process_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("showdrumsamples");
      samplebox.innerHTML = text;
    });
}

function nextfunctionsearch(x, y, name) {
  
  let val = x;
  let sampleselect = y;
  let form = new FormData();

  if (y !== null) {
    form.append("searchText", sampleselect);
  }

  form.append("PG", val);

  let url = "../midiFiles/sampleTypeMidiSearch.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      

      let mainsampleBox = document.getElementById("mainsampleDiv");

      let samplebox = document.getElementById("sampleTypeMidiSearch");
      samplebox.innerHTML = text;
    });
}
function commonNextFunction(x, y, pageName) {
  console.log(x,y,pageName);
  let val = x;
  let sampleselect = y;
  let form = new FormData();

  form.append("SSTN", sampleselect);
  form.append("PG", val);

  let url = `../midiFiles/${pageName}.php`;
  url = midi_display_process_url;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let mainsampleBox = document.getElementById("sampleTypeMidi");
      //console.log(text);
      let samplebox = document.getElementById(`${pageName}`);
      samplebox.innerHTML = text;
    });
}




function viewbuy(x) {
  window.location = "../viewsingleproduct/viewsingleproduct.php?X=" + x;
}
let searchButton = document.getElementById("searchButton");

searchButton.addEventListener("click", () => {
  let sBox = document.getElementById("searchBox");
  let form = new FormData();
  form.append("searchText", sBox.value);
  let url = "../midiFiles/sampleTypeMidiSearch.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let mainsampleBox = document.getElementById("mainsampleDiv");
      mainsampleBox.innerHTML = " ";
      mainsampleBox.classList.add("d-none");
      let samplebox = document.getElementById("sampleTypeMidiSearch");
      samplebox.innerHTML = text;
    });
});

function upDateCartBagGui(arrayName){
  let cartRowCount = Object.keys(arrayName).length;
  let cartBag = document.getElementById("cartItems");
  cartBag.innerHTML = cartRowCount;
}

upDateCartBagGui(getCart());
function getCart() {
  let getItemCart = globalThis.localStorage.getItem("cart");
  let check = true;
  if(getItemCart == undefined || getItemCart == null || getItemCart == "[]"){
    console.log("yo");
    console.log(getItemCart);
    globalThis.localStorage.clear();
  }
  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}