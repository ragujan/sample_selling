let cartQtySelect = document.getElementById("selectQTY");

let linkPathUrl4 = "/sampleSelling-master/util/path_config/get_relative_paths.php";
let getUrls = async (name, type) => {
  let url;
  let formData = new FormData();
  formData.append("type", type);
  formData.append("name", name);

  await fetch(linkPathUrl4, { method: "POST", body: formData })
    .then((res) => res.text())
    .then((text) => {
      url = text;

    });
  return url;
};

cartQtySelect.addEventListener("change", () => {
  if (cartQtySelect.value <= 1) {
    cartQtySelect.value = 1;
  }
});

function upDateCartBagGui(arrayName) {
  let cartBag = document.getElementById("cartItems");
  cartBag.innerHTML = Object.keys(arrayName).length;
}

upDateCartBagGui(getCart());
function getCart() {
  let getItemCart = globalThis.localStorage.getItem("cart");
  if (getItemCart == undefined || getItemCart == null || getItemCart == "[]") {

    globalThis.localStorage.clear();
  }
  return JSON.parse(globalThis.localStorage.getItem("cart") ?? "{}");
}

function saveCart(cart) {

  globalThis.localStorage.setItem("cart", JSON.stringify(cart));
}



let newAddtoCart = async (id) => {
  let existingCart = getCart();
  let localArray = [];
  let intID;
  let intQTY;
  const cartRowCount = Object.keys(existingCart).length;
  let qty = document.getElementById("selectQTY").value;

  const f = new FormData();
  f.append("id", id);
  f.append("qty", qty);
  let url = await getUrls("add_to_cart_local_storage");
  let api = fetch(url, { body: f, method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      console.log(data)

      if (data["ID"] !== "Nope") {
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

let goToviewCart = async (id) => {
  let existingCart = getCart();
  let localArray = [];
  let intID;
  let intQTY;
  const cartRowCount = Object.keys(existingCart).length;

  const f = new FormData();
  f.append("id", id);

  // let url = goToViewCartLocalStorageUrl;
  let url = await getUrls("go_to_view_cart_local_storage");
  let api = fetch(url, { body: f, method: "POST" })
    .then((response) => response.json())
    .then((data) => {
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
        window.location = "/sampleSelling-master/viewcart/viewcart.php?X=" + id;
      } 
    });
}
let sendToCustomerCart = async () => {
  let cartArray;
  cartArray = JSON.stringify(getCart());

  let url = await getUrls("add_to_customer_cart_process");
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => { });

  upDateCartBagGui(getCart());
};
let sendToCustomerCartSingle = async (sId, qty) => {
  let cartArray;

  cartArray = JSON.stringify([{ id: sId, qty: qty }]);

  console.log("here " + cartArray);
  let url = await getUrls("add_to_customer_cart_process");
  const formData = new FormData();
  formData.append("array", cartArray);
  fetch(url, { method: "POST", body: formData })
    .then((response) => response.text())
    .then((text) => {
      
    });
};
