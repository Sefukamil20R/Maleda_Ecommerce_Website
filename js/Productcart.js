// Step 1: Parse the JSON data
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
    image: "CSS/Image/MINTAF.webp",
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
    image: "CSS/Image/Manybag.webp",
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

let iconCart = document.querySelector(".iconCart");
let cart = document.querySelector(".cart");
let container = document.querySelector(".container");
let close = document.querySelector(".close");

// Retrieve the data from local storage

let storedProducts = JSON.parse(localStorage.getItem("products"));
if (!storedProducts) {
  storedProducts = jsonData;
  localStorage.setItem("products", JSON.stringify(storedProducts));
}

// Now you can use the storedProducts array in your application
console.log(storedProducts);

iconCart.addEventListener("click", () => {
  if (cart.style.right == "-100%") {
    cart.style.right = "0";
    container.style.transform = "translateX(-400px)";
  } else {
    cart.style.right = "-100%";
    container.style.transform = "translateX(0)";
  }
});
close.addEventListener("click", function () {
  cart.style.right = "-100%";
  container.style.transform = "translateX(0)";
});

let products = storedProducts; // Use storedProducts directly

// Show product data in list
function addDataToHTML() {
  let listProductHTML = document.querySelector(".listProduct");
  if (!listProductHTML) {
    console.error("Element with class 'listProduct' not found.");
    return;
  }
  listProductHTML.innerHTML = "";

  if (products != null) {
    products.forEach((product) => {
      let newProduct = document.createElement("div");
      newProduct.classList.add("item");
      newProduct.innerHTML = `<img src="${product.image}" alt="">
            <h2>${product.name}</h2>
            <div class="price">$${product.price}</div>
            <button onclick="addCart(${product.id})">Add To Cart</button>`;

      listProductHTML.appendChild(newProduct);
    });
  }
}

// Check if cart data exists in local storage and initialize listCart array
let listCart = [];
function checkCart() {
  const storedCart = localStorage.getItem("listCart");
  if (storedCart) {
    listCart = JSON.parse(storedCart);
  } else {
    listCart = [];
  }
}
checkCart();

// Add item to cart and store in local storage
function addCart($idProduct) {
  let productsCopy = JSON.parse(JSON.stringify(products));
  if (!listCart[$idProduct]) {
    listCart[$idProduct] = productsCopy.find(
      (product) => product.id === $idProduct
    );
    listCart[$idProduct].quantity = 1;
  } else {
    listCart[$idProduct].quantity++;
  }

  localStorage.setItem("listCart", JSON.stringify(listCart));
  addCartToHTML();
}

// Update cart display based on local storage data
addCartToHTML();
function addCartToHTML() {
  let listCartHTML = document.querySelector(".listCart");
  if (!listCartHTML) {
    console.error("Element with class 'listCart' not found.");
    return;
  }
  listCartHTML.innerHTML = "";

  let totalHTML = document.querySelector(".totalQuantity");
  if (!totalHTML) {
    console.error("Element with class 'totalQuantity' not found.");
    return;
  }
  let totalQuantity = 0;

  if (listCart) {
    Object.values(listCart).forEach((product) => {
      if (product) {
        let newCart = document.createElement("div");
        newCart.classList.add("item");
        newCart.innerHTML = `<img src="${product.image}">
                    <div class="content">
                        <div class="name">${product.name}</div>
                        <div class="price">$${product.price} / 1 product</div>
                    </div>
                    <div class="quantity">
                        <button onclick="changeQuantity(${product.id}, '-')">-</button>
                        <span class="value">${product.quantity}</span>
                        <button onclick="changeQuantity(${product.id}, '+')">+</button>
                    </div>`;
        listCartHTML.appendChild(newCart);
        totalQuantity += product.quantity;
      }
    });
  }
  totalHTML.innerText = totalQuantity;
}

// Update quantity of item in cart and store in local storage
function changeQuantity($idProduct, $type) {
  switch ($type) {
    case "+":
      listCart[$idProduct].quantity++;
      break;
    case "-":
      listCart[$idProduct].quantity--;
      if (listCart[$idProduct].quantity <= 0) {
        delete listCart[$idProduct];
      }
      break;
    default:
      break;
  }
  localStorage.setItem("listCart", JSON.stringify(listCart));
  addCartToHTML();
}

// Call addDataToHTML to initially render product data
addDataToHTML();
