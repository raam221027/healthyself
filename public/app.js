let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCart = document.querySelector('.listCart');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');


let listCarts = [];

openShopping.addEventListener('click', () => {
    body.classList.add('active');
    reloadCart(); // Reload the cart UI if there are items in the cart
});

closeShopping.addEventListener('click', () => {
    body.classList.remove('active');
});

function initApp() {
    products.forEach((value) => {
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="storage/${value.photo}">
            <div class="title">${value.title}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCart(${value.id}, '${value.title}', ${value.price}, '${value.photo}')">Add To Cart</button>`;
        list.appendChild(newDiv);
    });
}


initApp();

function addToCart(id, title, price, photo, quantity = 1) {
    let cartItem = listCarts.find(item => item.id === id);
    
    if (cartItem) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'This product is already in the cart'
          })
    } else {
        cartItem = { id, title, price, photo, quantity };
        listCarts.push(cartItem);
        reloadCart();
        

        // Open the cart after adding a product
        body.classList.add('active');
    }
}

function reloadCart() {
        listCart.innerHTML = '';
        let count = 0;
        let totalPrice = 0;
    
        listCarts.forEach((value, key) => {
            if (value != null) {
                totalPrice += value.price * value.quantity;
                count += value.quantity;
    
                let newDiv = document.createElement('li');
                newDiv.classList.add('cartItem');
                newDiv.innerHTML = `
                <div class="product-title">${value.title}</div>
                    <div class="cart-item">
                        <div class="product-image">
                            <img src="/storage/${value.photo}">
                            <div class="product-price">₱${(value.price)}.00
                        </div>
                        
                        <div class="product-details">
                            <div class="quantity-container">
                                <div class="quantity-label">Quantity:</div>
                                <div class="quantity-buttons">
                                    <button class="btn btn-decrease" onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                                    <div class="quantity-number">${value.quantity}</div>
                                    <button class="btn btn-increase" onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                                </div>
                            </div>
                            <div class="product-price">₱${(value.price * value.quantity).toLocaleString()}.00</div>
                        </div>
                    </div>
                `;
                listCart.appendChild(newDiv);
            }
        });
        const totalAmount = document.getElementById('totalAmount');
        totalAmount.textContent = `Total: ₱ ${totalPrice.toLocaleString()}.00`;

        const listCartsInput = document.getElementById('listCartsInput');
        listCartsInput.value = JSON.stringify(listCarts); // Convert the array to a JSON string
    
        // Scroll to the bottom of the cart list
        listCart.scrollTop = listCart.scrollHeight;
        
    }

    


function changeQuantity(key, quantity) {
    // Store the current scroll position
    const scrollPosition = listCart.scrollTop;

    if (quantity <= 0) {
        listCarts.splice(key, 1); // Remove the item from the array
    } else {
        listCarts[key].quantity = quantity;
    }
    reloadCart();

    // Set the scroll position back to the original value
    listCart.scrollTop = scrollPosition;

    const nav = document.querySelector('nav');
const container = document.querySelector('.container');

nav.addEventListener('click', () => {
  nav.classList.toggle('collapsed');
  container.classList.toggle('expanded');
});


}   



