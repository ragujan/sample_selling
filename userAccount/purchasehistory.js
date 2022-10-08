const show = document.querySelector("#show");
let loadPurchaseHistory = () => {
    const url = "../userAccount/purchasedHistoryProcess.php";
    fetch(url, { method: "POST" })
        .then((res) => res.text())
        .then((text) => {
            show.innerHTML = text;

        })
}
loadPurchaseHistory();
let navigation = (value) => {
    const url = "../userAccount/purchasedHistoryProcess.php";
    const form = new FormData();
    form.append("navivalue",value)
    fetch(url, { method: "POST",body:form })
        .then((res) => res.text())
        .then((text) => {
            show.innerHTML = text;

        })
}