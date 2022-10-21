let nlinks = document.querySelectorAll(".navlinks");
let upBTN = document.getElementById("uploadbutton");
let upBTN2 = document.getElementById("uploadbutton2");
let sampleType = document.getElementById("sampleType");
let uploadFilesOnly = document.getElementById("uploadFileOnly");
let uploadAudioOnly = document.getElementById("uploadAudioOnly");
let uploadImageOnly = document.getElementById("uploadImageOnly");

let c =(text)=>{console.log(text)};

function sanitizerInput(data) {
  const div = document.createElement("div");
  div.textContent = data;
  return div.innerHTML;
}
document.getElementsByClassName('container-fluid')[0].style.display = "none";
window.addEventListener("load", async () => {
  //  let val = 0
  let samplebox1 = document.getElementById("sampleTypeMelody");
  let samplebox2 = document.getElementById("sampleTypeDrums");

 
  document.getElementById('loadingScreen').classList.toggle('d-none');
  let form = new FormData();
  // form.append('PG', val)
  setTimeout(async ()=>{
    let url = "sampletypeMelody.php";
    let abc = await fetch(url, { body: form, method: "POST" })
      .then((response) =>response.text()  )
      .then((text) => {
        
        let sanitizeData = sanitizerInput(text);
       let whtsup= ()=>{console.log("so hwts up")};
       whtsup();
        samplebox1.innerHTML = text;
      });
  
    let url2 = "sampletypeDrums.php";
    let def = await fetch(url2, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
       
        samplebox2.innerHTML = text;
        document.getElementById('loadingScreen').classList.toggle('d-none');
        document.getElementsByClassName('container-fluid')[0].style.display = "block";
      });

  },500)

});
async function loadwin() {
  let val = 1;

  let form = new FormData();
  form.append("PG", val);
  let url = "SampleSellingPaginationMelodies.php";
  let abc = await fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox2 = document.getElementById("showmelodysamples");
      samplebox2.innerHTML = text;
    });

  let url2 = "samplesellingpaginationdrums.php";
  let def = await fetch(url2, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox2 = document.getElementById("showdrumsamples");
      samplebox2.innerHTML = text;
    });
}
function showsubsamples() {
  let val = 0;
  let sampleselect = document.getElementById("subSampleMelodyID").value;

  let form = new FormData();
  if (sampleselect !== "ALL") {
    form.append("SSTN", sampleselect);
  }
  form.append("PG", val);

  let url = "sampletypeMelody.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("sampleTypeMelody");
      samplebox.innerHTML = text;
    });
}

function showsubsamplesdrums() {
  let val = 0;
  let sampleselect = document.getElementById("subSampleDrumID").value;

  let form = new FormData();
  form.append("PG", val);
  if (sampleselect !== "ALL") {
    form.append("SSTN", sampleselect);
  }

  let url = "sampletypeDrums.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("sampleTypeDrums");
      samplebox.innerHTML = text;
    });
}

function nextfunctionmelody(x, y) {
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

  let url = "sampletypeMelody.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("showmelodysamples");
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

  let url = "sampletypeDrums.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById("showdrumsamples");
      samplebox.innerHTML = text;
    });
}

function nextfunctionsearch(x, y, name) {
  console.log("hey", x, "hey", y, "hey", name);
  let val = x;
  let sampleselect = y;
  let form = new FormData();

  if (y !== null) {
    form.append("searchText", sampleselect);
  }

  form.append("PG", val);

  let url = "bySearch.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
      // let mainsampleBox = document.getElementById('mainsampleDiv')

      // let samplebox = document.getElementById('bySearch')
      // samplebox.innerHTML = text

      // let mainsampleBox = document.getElementById('mainsampleDiv')
      // mainsampleBox.innerHTML =" ";
      // mainsampleBox.classList.add('d-none')
      let mainsampleBox = document.getElementById("mainsampleDiv");

      let samplebox = document.getElementById("bySearch");
      samplebox.innerHTML = text;
    });
}
function commonNextFunction(x, y, pageName) {
  console.log(pageName);
  console.log(x + "  " + y);
  let val = x;
  let sampleselect = y;
  let form = new FormData();

  if (y !== 0) {
    form.append("SSTN", sampleselect);
  } else {
    alert("hey");
  }

  form.append("PG", val);

  let url = `${pageName}.php`;
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let mainsampleBox = document.getElementById("mainsampleDiv");

      let samplebox = document.getElementById(`${pageName}`);
      samplebox.innerHTML = text;
    });
}

function playmusic(x) {
  let playmusicicon = document.getElementById("playmusic" + x);
  let pausemusicicon = document.getElementById("pausemusic" + x);
  const album = document.getElementById("beatPackDiv" + x);
 // album.style.transform = "scale(1.05)";
  let playAlbumClassDiv = document.querySelectorAll(".audiopreviewImage");

  playAlbumClassDiv.forEach((el) => {
    if (el.id === "audio" + x) {
      console.log(x);
      document.getElementById(el.id).play();
    } else {
      document.getElementById(el.id).pause();
      let otherID = parseInt(el.id.split("audio")[1]);
      console.log(otherID);
      document.getElementById("playmusic" + otherID).classList.remove("d-none");
      document.getElementById("pausemusic" + otherID).classList.add("d-none");
      const album = document.getElementById("beatPackDiv" + otherID);

      album.style.transform = "scale(1.00)";
      album.style.transform = "scale(1.00)";

      album.style.backgroundColor = "rgb(0, 0, 0)";
      album.style.transition =
        "background-color 0.7s ease-in-out,transform 0.5s ease-in-out";
    }
  });

 // album.style.backgroundColor = "rgb(30, 26, 26)";
 // album.style.transition =
    //"background-color 0.5s ease-in-out,transform 0.5s ease-in-out";
    let music = document.getElementById("audio" + x);
    pausemusicicon.classList.toggle("d-none");
    playmusicicon.classList.toggle("d-none");
    music.play();
}

function pausemusic(x) {
  let playmusicicon = document.getElementById("playmusic" + x);
  let pausemusicicon = document.getElementById("pausemusic" + x);
  const album = document.getElementById("beatPackDiv" + x);

  //album.style.transform = "scale(1.00)";

//  album.style.backgroundColor = "rgb(0, 0, 0)";
//  album.style.transition =
 //   "background-color 0.7s ease-in-out,transform 0.5s ease-in-out";

  let music = document.getElementById("audio" + x);
  pausemusicicon.classList.toggle("d-none");
  playmusicicon.classList.toggle("d-none");
  music.pause();
}

function viewbuy(x) {
  window.location = "../viewsingleproduct/viewsingleproduct.php?X=" + x;
}
let searchButton = document.getElementById("searchButton");

searchButton.addEventListener("click", () => {
  let sBox = document.getElementById("searchBox");
  let form = new FormData();
  form.append("searchText", sBox.value);
  let url = "bySearch.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.text())
    .then((text) => {
      let mainsampleBox = document.getElementById("mainsampleDiv");
      mainsampleBox.innerHTML = " ";
      mainsampleBox.classList.add("d-none");
      let samplebox = document.getElementById("bySearch");
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
