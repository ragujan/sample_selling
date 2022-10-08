let nlinks = document.querySelectorAll('.navlinks');
let upBTN = document.getElementById('uploadbutton');
let upBTN2 = document.getElementById('uploadbutton2')
let sampleType = document.getElementById('sampleType');
let uploadFilesOnly = document.getElementById('uploadFileOnly');
let uploadAudioOnly = document.getElementById('uploadAudioOnly');
let uploadImageOnly = document.getElementById('uploadImageOnly');

window.addEventListener('load', async () => {
  let val = 0

  let form = new FormData()
  form.append('PG', val)
  let url = 'showcasesamples\SampleSellingPaginationMelodies.php'
  let abc = await fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox2 = document.getElementById('showmelodysamples')
      samplebox2.innerHTML = text
    })

  let url2 = 'showcasesamples\samplesellingpaginationdrums.php'
  let def = await fetch(url2, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox2 = document.getElementById('showdrumsamples')
      samplebox2.innerHTML = text
    })
})

function showsubsamples() {
  let val = 0
  let sampleselect = document.getElementById('subSampleMelodyID').value

  let form = new FormData()
  if (sampleselect !== 'ALL') {
    form.append('SSTN', sampleselect)
  }
  form.append('PG', val)

  let url = 'showcasesamples\SampleSellingPaginationMelodies.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById('showmelodysamples')
      samplebox.innerHTML = text
    })
}

function showsubsamplesdrums() {
  let val = 0
  let sampleselect = document.getElementById('subSampleDrumID').value

  let form = new FormData()
  form.append('PG', val)
  if (sampleselect !== 'ALL') {
    form.append('SSTN', sampleselect)
  }

  let url = 'showcasesamples\samplesellingpaginationdrums.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById('showdrumsamples')
      samplebox.innerHTML = text
    })
}

function nextfunctionmelody(x, y) {
  let sampleContainer = document.getElementById('thesamplecontainer1')
  sampleContainer.scrollIntoView()

  let val = x
  let sampleselect = y
  let form = new FormData()

  if (y !== null) {
    
    form.append('SSTN', sampleselect)
  }

  form.append('PG', val)

  let url = 'showcasesamples\SampleSellingPaginationMelodies.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById('showmelodysamples')
      samplebox.innerHTML = text
    })
}

function nextfunctiondrums(x, y) {
  let sampleContainer = document.getElementById('thesamplecontainer2')
  //sampleContainer.scrollIntoView();

  let val = x
  let sampleselect = y
  let form = new FormData()

  if (y !== null) {
 
    form.append('SSTN', sampleselect)
  }

  form.append('PG', val)

  let url = 'showcasesamples\samplesellingpaginationdrums.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
  
      let samplebox = document.getElementById('showdrumsamples')
      samplebox.innerHTML = text
    })
}

function playmusic(x) {
  let playmusicicon = document.getElementById('playmusic' + x)
  let pausemusicicon = document.getElementById('pausemusic' + x)

  let music = document.getElementById('audio' + x)
  pausemusicicon.classList.toggle('d-none')
  playmusicicon.classList.toggle('d-none')
  music.play()
}

function pausemusic(x) {
  let playmusicicon = document.getElementById('playmusic' + x)
  let pausemusicicon = document.getElementById('pausemusic' + x)
  let music = document.getElementById('audio' + x)
  pausemusicicon.classList.toggle('d-none')
  playmusicicon.classList.toggle('d-none')
  music.pause()
}

function viewbuy(x) {
  window.location = 'viewsingleproduct.php?X=' + x
}
