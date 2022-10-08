const cartQtySelect = document.getElementById("selectQTY");
cartQtySelect.addEventListener("change", () => {
  if (cartQtySelect.value <= 1) {
    cartQtySelect.value = 1;
  }
});

function upDateCartBagGui(arrayName) {

  let cartRowCount = Object.keys(arrayName).length;
  console.log("cartRow Count is "+cartRowCount)
  let cartBag = document.getElementById("cartItems");
  cartBag.innerHTML = cartRowCount;
}

upDateCartBagGui(getCart());
function getCart() {
  let getItemCart = globalThis.localStorage.getItem("cart");
  let check = true;
  if (getItemCart == undefined || getItemCart == null || getItemCart == "[]") {

    globalThis.localStorage.clear();
  }
  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}

function saveCart(cart) {
  
  globalThis.localStorage.setItem("cart", JSON.stringify(cart));
}

function addToCart(id) {
  let cartQTY = document.getElementById("selectQTY").value;

  if (cartQTY == "") {
    document.getElementById("selectQTY").style.background = "red";
  } else {
    let cartQTYString = `${cartQTY}`;
    let productIDString = `${id}`;
    let combined = productIDString + " " + cartQTYString;
    let form = new FormData();
    form.append("ID", combined);
    let url = "../viewsingleproduct/addtoCartLocalStorage.php";
    fetch(url, { body: form, method: "POST" })
      .then((response) => response.text())
      .then((text) => {
        console.log(text);
        let cartQtyinNum = parseInt(cartQTY);
        let cart = getCart();
        if (typeof cart[id] === "number") {
          //cart[id] = cartQtyinNum;
          cart = { id, cartQTYString };
        } else {
          // cart[id] = cartQtyinNum;
          cart = { id, cartQTYString };
        }
        saveCart(cart);
        // let cartRows = getCart();
        // let cartRowCount = Object.keys(cartRows).length;
        // let cartBag = document.getElementById("cartItems");
        // cartBag.innerHTML = cartRowCount;
      });
  }
  upDateCartBagGui(getCart());
}

let newAddtoCart = (id) => {
  let existingCart = getCart();
  let localArray = [];
  let intID;
  let intQTY;
  const cartRowCount = Object.keys(existingCart).length;
  let qty = document.getElementById("selectQTY").value;
 
  const f = new FormData();
  f.append("id", id);
  f.append("qty", qty);
  let url = "../viewsingleproduct/addtoCartLocalStorage.php";
  let api = fetch(url, { body: f, method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      console.log(data)
     
      if (data["ID"] !== "Nope") {
        intQTY = parseInt(data["qty"]);
        intID =  parseInt(data["id"]);

        if (existingCart.length === undefined) {
          let newArray = data;
          let objectArray = [];
          objectArray.push(newArray);
          globalThis.localStorage.setItem("cart", JSON.stringify(objectArray));
        } else {
          let arraySearch = existingCart.find((a, index) => {
            if (a.id == intID) {
              existingCart[index] = data;
            } else {
              localArray.push(existingCart[index]);
            }
            if (localArray.length === existingCart.length) {
              let newItemarray = data;
              localArray.push(newItemarray);
              globalThis.localStorage.setItem(
                "cart",
                JSON.stringify(localArray)
              );
              upDateCartBagGui(localArray);
            } else {
              globalThis.localStorage.setItem(
                "cart",
                JSON.stringify(existingCart)
              );
            }
          });
        }
        let cartBag = document.getElementById("cartItems");
        cartBag.innerHTML = (JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}")).length;
      }
    });

  sendToCustomerCartSingle(id, qty);
  upDateCartBagGui(JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}"));
  //console.log(JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}"));
};

function removeFromCart(id, count) {
  count = count ?? 1;
  let cart = getCart();

  if (typeof cart[id] === "number") {
    cart[id] -= count;
  } else {
    cart[id] = 0;
  }
  if (cart[id] < 0) {
    cart[id] = 0;
  }
  saveCart(cart);
}

function goToviewCart(id) {
  let existingCart = getCart();
  let localArray = [];
  let intID;
  let intQTY;
  const cartRowCount = Object.keys(existingCart).length;

  const f = new FormData();
  f.append("id", id);

  let url = "../viewsingleproduct/goToViewCartLocalStorage.php";
  let api = fetch(url, { body: f, method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      if (data["id"] !== "Nope") {
        intQTY = parseInt(data["qty"]);
        intID = parseInt(data["id"]);

        if (existingCart.length === undefined) {
          let newArray = data;
          let objectArray = [];
          objectArray.push(newArray);
          globalThis.localStorage.setItem("cart", JSON.stringify(objectArray));
        } else {
          let arraySearch = existingCart.find((a, index) => {
            if (a.id == intID) {
              console.log(`id is in the ${index}th index  of array`);
            } else {
              localArray.push(existingCart[index]);
              console.log(`id is not in the ${index}th index of array`);
            }
            if (localArray.length === existingCart.length) {
              let newItemarray = data;
              localArray.push(newItemarray);
              globalThis.localStorage.setItem(
                "cart",
                JSON.stringify(localArray)
              );
            } else {
              globalThis.localStorage.setItem(
                "cart",
                JSON.stringify(existingCart)
              );
            }
          });
        }
        window.location = "../viewcart/viewcart.php?X=" + id;
      } else {
        console.log("Nope Nope");
      }
    });
}
let sendToCustomerCart = () => {
  let cartArray;
  cartArray = JSON.stringify(getCart());

  const url = "../viewcart/addtoCustomerCart.php";
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {});

  upDateCartBagGui(getCart());
};
let sendToCustomerCartSingle = (sId, qty) => {
  let cartArray;

  cartArray = JSON.stringify([{ id: sId, qty: qty }]);

  console.log("here "+cartArray);
  const url = "../viewcart/addtoCustomerCart.php";
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      console.log(text);
    });
};
