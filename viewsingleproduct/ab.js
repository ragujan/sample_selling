window.addEventListener("load", () => {
  let url = "../viewsingleproduct/serversideShit.php";
  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      let a = document.getElementById("productDIV");
      let b = document.getElementById("buttonDIV");
      let cutFinal = data.splice(data.length - 1, data.length - 1);
      console.log(data);
      console.log(cutFinal);
      data.forEach(function (item, index, array) {
        let SSID = data[index][0];
        let sImage = data[index]["source_URL"];
        let sTitle = data[index][1];
        let audiosource = data[index]["sampleAudioSrc"];
        let sPrice = data[index]["SamplePrice"];
        let datadiv = returnDivs(SSID, sTitle, sImage, audiosource);
        let newDIV = document.createElement("div");
        newDIV.classList.add("col-3", "pt-2", "text-center");
        newDIV.innerHTML = datadiv;
        a.appendChild(newDIV);
      });
      console.log(cutFinal[0][3]);
      let datadiv = returnPageButtons(
        cutFinal[0][0],
        cutFinal[0][1],
        cutFinal[0][2],
        cutFinal[0][3]
      );
      console.log(datadiv);

      b.appendChild(datadiv);
    });
});

function pagination(PG, TYPEVAL) {
  let val = PG;
  let sampleselect = TYPEVAL;
  let form = new FormData();
  if (y !== null) {
    form.append("SSTN", sampleselect);
  } else {
    alert("hey");
  }
  form.append("PG", val);
  let url = "../viewsingleproduct/serversideShit.php";
  fetch(url, { body: form, method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      let a = document.getElementById("productDIV");
      let b = document.getElementById("buttonDIV");

      let cutFinal = data.splice(data.length - 1, data.length - 1);
      console.log(data);
      console.log(cutFinal);
      data.forEach(function (item, index, array) {
        let SSID = data[index][0];
        let sImage = data[index]["source_URL"];
        let sTitle = data[index][1];
        let audiosource = data[index]["sampleAudioSrc"];
        let sPrice = data[index]["SamplePrice"];
        let datadiv = returnDivs(SSID, sTitle, sImage, audiosource);
        let newDIV = document.createElement("div");
        newDIV.classList.add("col-3", "pt-2", "text-center");
        newDIV.innerHTML = datadiv;
        a.appendChild(newDIV);
      });
      console.log(cutFinal[0][3]);
      let datadiv = returnPageButtons(
        cutFinal[0][0],
        cutFinal[0][1],
        cutFinal[0][2],
        cutFinal[0][3]
      );
      console.log(datadiv);

      b.appendChild(datadiv);
    });
}
function returnPageButtons(allowedPages, A, valueforBTN, functionName) {
  let b = document.createElement("div");
  b.classList.add("col-6", "offset-3", "mt-5");
  let rowb = document.createElement("div");
  rowb.classList.add("row");
  for (let i = 0; i < allowedPages + 1; i++) {
    const buttons = document.createElement("button");
    buttons.textContent = i + 1;
    buttons.classList.add("nextButton");
    buttons.addEventListener("click", (functionName) => {
      nextfunctionmelody(i, valueforBTN);
    });
    const buttonsDiv = document.createElement("div");
    buttonsDiv.classList.add("col", "text-center", "d-grid");
    buttonsDiv.appendChild(buttons);
    rowb.appendChild(buttonsDiv);
  }
  b.appendChild(rowb);
  return b;
}
function returnDivs(id, title, image, audioSource) {
  let a = `<div style="color:blue;" id="ID">${id}</div>
      <div id="TITLE">${title}</div>
      <img src="../${image}" class="beatPACKIMAGE" alt="">
      `;

  let c = `

        <div class="col-lg-12 py-3 bg-danger  col-md-4 offset-md-0 col-sm-12 offset-sm-12 col-10 offset-1">
                <div class="row">           
                    <div class="col-10 beatpackdiv py-lg-3 py-md-2 py-2 offset-1">
                        <div class="row">
                            <div class="col-12 audiopreviewdiv">
                                <audio id="audio${id}" class="audiopreview">
                                    <source src="../${audioSource}" type="audio/ogg">
                                    <source src="../${audioSource}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <img src="../${image}" class="beatPACKIMAGE" alt="">
                                <img id="playmusic${id}" onclick="playmusic('${id}');" class="playcolrols audiopreview" src="../BrymoImages/play-button.png" alt="">
                                <img id="pausemusic${id}" onclick="pausemusic('${id}');" class="playcolrols audiopreview d-none" src="../BrymoImages/pause.png" alt="">
                            </div>
                            <div class="col-12 pt-2">
                                <div class="row">
                                    <div class="col-6 pt-2 text-center">
                                        <span class="sampleName">${title}</span>
                                    </div>
                                    <div class="col-6 pt-2 text-center">
                                        <span class="sampleName text-danger">${title}</span>
                                    </div>
                                 
                                    <div class="col-12  py-2 d-grid  text-center">
                                        <button class="buyBTN py-lg-2 py-sm-1" onclick="viewbuy(${id})">View</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


</div>`;
  return c;
}
function playmusic(x) {
  let playmusicicon = document.getElementById("playmusic" + x);
  let pausemusicicon = document.getElementById("pausemusic" + x);

  let music = document.getElementById("audio" + x);
  pausemusicicon.classList.toggle("d-none");
  playmusicicon.classList.toggle("d-none");
  music.play();
}

function pausemusic(x) {
  let playmusicicon = document.getElementById("playmusic" + x);
  let pausemusicicon = document.getElementById("pausemusic" + x);
  let music = document.getElementById("audio" + x);
  pausemusicicon.classList.toggle("d-none");
  playmusicicon.classList.toggle("d-none");
  music.pause();
}
function viewbuy(x) {
  window.location = "../viewsingleproduct/viewsingleproduct.php?X=" + x;
}
function nextfunctionmelody(x, y) {
  let sampleContainer = document.getElementById("thesamplecontainer1");

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
  let url1 = "../viewsingleproduct/serversideShit.php";
  fetch(url1, { body: form, method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      pagination(PG, TYPEVAL);
    });
}


const askFunc= (id) => {
  let url = `abc.com?x=${id}`;
  fetch(url)
    .then((res) => res.text())
    .then((text) => {
      console.log(text);
    });
};
askFunc(id);