const mydiv = document.getElementById("mydiv");
function fireClick() {
    let server = new ServerSide();
    server.method = "POST";
    server.form = new FormData();
    server.url = "backend.php";
    server.form.append("HEY", "Welcome message");
    server.container = mydiv;
    function doThis() {
       server.container.innerHTML = server.text;

    }
    server.sendPostRequest(doThis);
}


fireClick();