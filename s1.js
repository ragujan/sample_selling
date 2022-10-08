let nlinks = document.querySelectorAll('.navlinks')
let upBTN = document.getElementById('uploadbutton')
let upBTN2 = document.getElementById('uploadbutton2')
let sampleType = document.getElementById('sampleType')
let uploadFilesOnly = document.getElementById('uploadFileOnly')
let uploadAudioOnly = document.getElementById('uploadAudioOnly')
let uploadImageOnly = document.getElementById('uploadImageOnly')

window.addEventListener('load', async () => {
  let val = 0

  let form = new FormData()
  form.append('PG', val)
  let url = 's1pagiClasses.php'
  let abc = await fetch(url, { body: form, method: 'POST' })
    .then((response) => response.json())
    .then((data) => {
      console.log(data)

      let B = data[0]
      

       data.forEach(function (item, index, array) {

        let SID = data[index]['sampleID']
        let sImage = data[index]['source_URL']
        let sTitle = data[index]['Sample_Name']
        let audiosource = data[index]['sampleAudioSrc']
        let sPrice = data[index]['SamplePrice'];
        //
        const samplebox1 = document.getElementById('showmelodysamples')
        const container = document.createDocumentFragment()
  
        const row = document.createElement('div')
        row.classList.add('row')
  
        const col3 = document.createElement('div')
        col3.classList.add('col-lg-3', 'py-3', 'col-6', 'col-md-4')
        console.log(col3.classList)
  
        const row2 = document.createElement('div')
        row2.classList.add('row')
  
        const beatpackdiv = document.createElement('div')
        beatpackdiv.classList.add(
          'col-10',
          'beatpackdiv',
          'py-lg-3',
          'py-md-2',
          'py-1',
          'offset-1',
        )
  
        const row3 = document.createElement('div')
        row3.classList.add('row')
  
        const audiopreviewdiv = document.createElement('div')
        audiopreviewdiv.classList.add('col-12', 'audiopreviewdiv')
  
        const source = document.createElement('source')
        source.src = audiosource
  
        const audio = document.createElement('audio')
        audio.id = 'audio' + SID
        audio.classList.add('audiopreview')
        audio.type='audio/ogg';
  
        audio.append(source);
  
        const beatImage = document.createElement('img')
        beatImage.classList.add('beatPACKIMAGE')
        beatImage.src = sImage
  
        const playImage = document.createElement('img');
        playImage.src = 'BrymoImages/play-button.png';
        playImage.id = 'playmusic' + SID;
        playImage.classList.add('playcolrols', 'audiopreview');
        playImage.addEventListener('click', () => {
          playmusic(SID)
        })
  
        const pauseImage = document.createElement('img');
        pauseImage.src = 'BrymoImages/pause.png';
        pauseImage.id = 'pausemusic' + SID;
        pauseImage.classList.add('playcolrols', 'audiopreview','d-none');
        pauseImage.addEventListener('click', () => {
          pausemusic(SID);
        })
  
        const detailsdiv = document.createElement('div');
        detailsdiv.classList.add('col-12','pt-2');
        const row4 = document.createElement('div');
        row4.classList.add('row');
        const namediv = document.createElement('div');
        namediv.classList.add('col-6','pt-2','text-center');
        const nametag = document.createElement('span');
        nametag.classList.add('sampleName');
        nametag.textContent =sTitle;
        const pricediv  = document.createElement('div');
        pricediv.classList.add('col-6','pt-2','text-center');
        const pricetag = document.createElement('span');
        pricetag.classList.add('sampleName','text-danger');
        pricetag.textContent = sPrice;
        const cartDiv = document.createElement('div');
        cartDiv.classList.add('col-12','pt-2','d-grid','col-md-6','text-center');
        const cartBtn = document.createElement('button');
        cartBtn.classList.add('cartBTN','py-lg-2','py-sm-1');
        cartBtn.textContent = "Cart";
        const buyDiv = document.createElement('div');
        buyDiv.classList.add('col-12','pt-2','d-grid','col-md-6','text-center');
        const buyBtn = document.createElement('button');
        buyBtn.classList.add('buyBTN','py-lg-2','py-sm-1');
        buyBtn.textContent = "Buy";
  
        namediv.append(nametag);
        pricediv.append(pricetag);
        cartDiv.append(cartBtn);
        buyDiv.append(buyBtn);
        row4.append(namediv);
        row4.append(pricediv);
        row4.append(cartDiv);
        row4.append(buyDiv);
        detailsdiv.append(row4);
  
  
  
        audiopreviewdiv.append(audio)
        audiopreviewdiv.append(beatImage)
        audiopreviewdiv.append(playImage)
        audiopreviewdiv.append(pauseImage)
        row3.append(audiopreviewdiv)
        row3.append(detailsdiv);
        beatpackdiv.append(row3)
        row2.append(beatpackdiv)
        col3.append(row2)
        samplebox1.appendChild(col3)


      
      })
      let array = [
        {
          id: '123',
          name: 'bob',
        },
        {
          id: '321',
          name: 'bob2',
        },
      ]

      console.log(array[0]['id'])
    })

  let url2 = 'samplesellingpaginationdrums.php'
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
  form.append('PG', val)
  form.append('SSTN', sampleselect)
  let url = 's1pagimelosub.php'
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
  form.append('SSTN', sampleselect)
  let url = 'sampleSellingPaginationDrumsSubSample.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById('showdrumsamples')
      samplebox.innerHTML = text
    })
}

function nextfunction1(x) {
  let sampleContainer = document.getElementById('thesamplecontainer1')
  sampleContainer.scrollIntoView()

  let val = x

  let form = new FormData()
  form.append('PG', val)
  let url = 's1pagimelo.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById('showmelodysamples')
      samplebox.innerHTML = text
    })
}

function nextfunction2(x) {
  let sampleContainer = document.getElementById('thesamplecontainer2')
  sampleContainer.scrollIntoView()

  let val = x

  let form = new FormData()
  form.append('PG', val)
  let url = 'samplesellingpaginationdrums.php'
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
  form.append('PG', val)
  form.append('SSTN', sampleselect)

  let url = 's1pagimelosub.php'
  fetch(url, { body: form, method: 'POST' })
    .then((response) => response.text())
    .then((text) => {
      let samplebox = document.getElementById('showmelodysamples')
      samplebox.innerHTML = text
    })
}

function nextfunctiondrums(x, y) {
  let sampleContainer = document.getElementById('thesamplecontainer2')
  sampleContainer.scrollIntoView()

  let val = x
  let sampleselect = y

  let form = new FormData()
  form.append('PG', val)
  form.append('SSTN', sampleselect)

  let url = 'sampleSellingPaginationDrumsSubSample.php'
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
