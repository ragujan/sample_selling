// import { ServerSide } from './server_side.js';

function doSomethig() {
    let serverSide = new ServerSide();
    serverSide.form = new FormData();
    serverSide.method = "GET";
    serverSide.url = "backend.php?HEY=BLAH BLAH";
    serverSide.container = document.getElementById("myContainer");
    serverSide.form.append("HEY", "KEY AND PEELE");
    function doThis(){
        
        serverSide.container.innerHTML = serverSide.text;
    }
   
    serverSide.sendGetRequest(doThis);
}
doSomethig();

function killSwitch(){
    alert("Hey Hey");
}