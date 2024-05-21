const jsonData = [
  {
    id: 1,
    name: "HomeOrnaments",
    price: 350,
    image: "CSS/Image/bepot.jpg",
  },
  {
    id: 2,
    name: "HandMadeCups",
    price: 220,
    image: "CSS/Image/pottt.jpg",
  },
  {
    id: 3,
    name: "HomeFixtures",
    price: 450,
    image: "CSS/Image/potcap.jpg",
  },
  {
    id: 4,
    name: "HomeFixtures",
    price: 420,
    image: "CSS/Image/Image2.jpeg",
  },
  {
    id: 5,
    name: "Plates",
    price: 270,
    image: "CSS/Image/sehan.jpeg",
  },
  {
    id: 6,
    name: "Plates",
    price: 300,
    image: "CSS/Image/Image1.jpeg",
  },
  {
    id: 7,
    name: "T-Shirt",
    price: 160,
    image: "CSS/Image/potys.jpg",
  },
  {
    id: 8,
    name: "HomeCommodity",
    price: 400,
    image: "CSS/Image/uuu.jpg",
  },
  {
    id: 9,
    name: "Pottery",
    price: 550,
    image: "CSS/Image/pottery.jpg",
  },
  {
    id: 10,
    name: "Carpets",
    price: 1200,
    image: "CSS/Image/dirib.jpg",
  },
  {
    id: 11,
    name: "Carpets",
    price: 1000,
    image: "CSS/Image/carpetg.jpg",
  },
  {
    id: 12,
    name: "Carpets",
    price: 980,
    image: "CSS/Image/Bag.jpg",
    // image: "CSS/Image/MINTAF.webp",
  },
  {
    id: 13,
    name: "Scluptures",
    price: 5000,
    image: "CSS/Image/scluptures.jpg",
  },
  {
    id: 14,
    name: "FoodCookingMaterials",
    price: 1200,
    image: "CSS/Image/erewib.jpg",
  },
  {
    id: 15,
    name: "Scluptures",
    price: 6000,
    image: "CSS/Image/kirsa.jpg",
  },
  {
    id: 16,
    name: "JuteMadeBags",
    price: 700,
    image: "CSS/Image/soy.jpg",
  },
  {
    id: 17,
    name: "LeatheryBags",
    price: 800,
    image: "CSS/Image/Bag.jpg",
  },
  {
    id: 18,
    name: "StitchMadeBags",
    price: 280,
    image: "CSS/Image/Bag.jpg",
    // image: "CSS/Image/Manybag.webp",
  },
  {
    id: 19,
    name: "HandmadeTowel",
    price: 430,
    image: "CSS/Image/Image3.jpg",
  },
  {
    id: 20,
    name: "T-Shirt",
    price: 650,
    image: "CSS/Image/tshirt.jpg",
  },
  {
    id: 21,
    name: "HandmadeGauze",
    price: 900,
    image: "CSS/Image/Hijab.jpg",
  },
  {
    id: 22,
    name: "Jewlery",
    price: 354,
    image: "CSS/Image/jewo.jpg",
  },
  {
    id: 23,
    name: "Jewlery",
    price: 500,
    image: "CSS/Image/yam.jpg",
  },
  {
    id: 24,
    name: "Jewlery",
    price: 300,
    image: "CSS/Image/Jewllery.jpg",
  },
];
// let listCart = [];
// function checkCart() {
//   var cookieValue = localStorage
//     .split("; ")
//     .find((row) => row.startsWith("listCart="));
//   if (cookieValue) {
//     listCart = JSON.parse(cookieValue.split("=")[1]);
//   }
// }
// checkCart();
// addCartToHTML();
// function addCartToHTML() {
//   // clear data default
//   let listCartHTML = document.querySelector(".returnCart .list");
//   listCartHTML.innerHTML = "";

//   let totalQuantityHTML = document.querySelector(".totalQuantity");
//   let totalPriceHTML = document.querySelector(".totalPrice");
//   let totalQuantity = 0;
//   let totalPrice = 0;
//   // if has product in Cart
//   if (listCart) {
//     listCart.forEach((product) => {
//       if (product) {
//         let newCart = document.createElement("div");
//         newCart.classList.add("item");
//         newCart.innerHTML = `<img src="${product.image}">
//                     <div class="info">
//                         <div class="name">${product.name}</div>
//                         <div class="price">$${product.price}/1 product</div>
//                     </div>
//                     <div class="quantity">${product.quantity}</div>
//                     <div class="returnPrice">$${
//                       product.price * product.quantity
//                     }</div>`;
//         listCartHTML.appendChild(newCart);
//         totalQuantity = totalQuantity + product.quantity;
//         totalPrice = totalPrice + product.price * product.quantity;
//       }
//     });
//   }
//   totalQuantityHTML.innerText = totalQuantity;
//   totalPriceHTML.innerText = "$" + totalPrice;
//}

//Function to retrieve cart data from localStorage
function checkCart() {
  const storedCart = localStorage.getItem("listCart");
  if (storedCart) {
    listCart = JSON.parse(storedCart);
  } else {
    listCart = [];
  }
}

// Function to add cart items to HTML
function addCartToHTML() {
  let listCartHTML = document.querySelector(".returnCart .list");
  listCartHTML.innerHTML = "";

  let totalQuantityHTML = document.querySelector(".totalQuantity");
  let totalPriceHTML = document.querySelector(".totalPrice");
  let totalQuantity = 0;
  let totalPrice = 0;

  if (listCart) {
    listCart.forEach((product) => {
      if (product) {
        let newCart = document.createElement("div");
        newCart.classList.add("item");
        newCart.innerHTML = `<img src="${product.image}">
                    <div class="info">
                        <div class="name">${product.name}</div>
                        <div class="price">$${product.price}/1 product</div>
                    </div>
                    <div class="quantity">${product.quantity}</div>
                    <div class="returnPrice">$${
                      product.price * product.quantity
                    }</div>`;
        listCartHTML.appendChild(newCart);

        totalQuantity += product.quantity;
        totalPrice += product.price * product.quantity;
      }
    });
  }

  totalQuantityHTML.innerText = totalQuantity;
  totalPriceHTML.innerText = "$" + totalPrice;
}

// Call functions to initialize checkout page
checkCart();
addCartToHTML();
