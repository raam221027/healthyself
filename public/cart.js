function calculateTotalPrice(products) {
    let total = 0;
    for (const product of products) {
        total += product.price * product.quantity;
    }
    return total;
}

$(document).ready(function() {
    const selectedProducts = []; 
    

    // Event listener for clicking on cards
    $('.product').on('click', function() {
        // Get the data from the clicked card
        const productId = $(this).data('product-id');
        console.log(productId);
        const productTitle = $(this).find('.card-title').text();
        const productPriceString = $(this).find('.card-text').text();
        const productPrice = parseFloat(productPriceString.replace(/[^0-9.-]+/g, ""));

        // Check if the product already exists in the cart
        const existingProduct = selectedProducts.find(product => product.id === productId);

        if (!existingProduct) {
            addProductToCart(productId, productTitle, productPrice);
        } else {
            // Product already exists, prompt for quantity and update the cart
            // Swal.fire({
            //     icon: 'error',
            //     title: 'Oops...',
            //     text: 'This product already exists in the cart!',
            // });
        }
    });



    // Function to update the cart count
    function updateCartCount() {
        const cartCountElement = $('#cart-count');
        const cartCount = selectedProducts.length; // Count the number of product rows
        cartCountElement.text(cartCount);
    }

    // Function to update the price and subtotal based on the quantity
    function updatePriceAndSubtotal(index) {
        const product = selectedProducts[index];
        const newPrice = product.price * product.quantity;
        const subtotal = newPrice * product.quantity;

        $(`.product-price[data-index="${index}"]`).text(`&#8369; ${newPrice}`);
        $(`.product-subtotal[data-index="${index}"]`).text(`&#8369; ${subtotal}`);
    }

    // Function to add a product to the cart
    function addProductToCart(productId, productTitle, productPrice, quantity = 1) {
        const existingProduct = selectedProducts.find(product => product.id === productId);

        if (!existingProduct) {
            // If the product is not already in the list, add it with the initial quantity
            selectedProducts.push({
                id: productId,
                title: productTitle,
                price: parseFloat(productPrice),
                quantity: quantity,
            });
        } else {
            // If the product already exists, update the quantity
            existingProduct.quantity += quantity;
        }

        updateCartTable(selectedProducts);
    }

    // Function to update the cart table
    function updateCartTable(products) {
        const tableBody = $('#cart-table-body');
        tableBody.empty();

        products.forEach((product, index) => {
            const subtotal = product.price * product.quantity;
            console.log(subtotal)
            tableBody.append(`
            <tr class="product-row" data-index="${index}">
            <th scope="row">${index + 1}</th>
            <td class="product-title">${product.title}</td>
            <td>
                <span class="product-price fs-6" data-index="${index}">
                    &#8369; ${product.price}
                </span>
            </td>
            <td>
            <div class="input-group" style=" background-color:#81B233;">
    <div class="input-group-prepend">
        <button class="btn btn-quantity minus-btn" type="button"  style="color:#fff;" data-min="1">-</button>
    </div>
    <input
    readonly
    type="number"
    class="form-control me-8 form-control-lg quantity-input"
    data-index="${index}"
    value="${product.quantity}"
/>

    <div class="input-group-append">
        <button class="btn btn-quantity plus-btn" type="button" style="color:#fff;">+</button>
    </div>
</div>
            </td>
            <td>
                <span class="product-subtotal" data-index="${index}">
                    &#8369; ${subtotal}
                </span>
            </td>
            <td>
                <button class="btn btn-danger btn-sm delete-product" data-index="${index}">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </td>
        </tr>
        
            `);
        });


// Add an event listener to the plus button
$('.plus-btn').on('click', function() {
    const index = $(this).closest('td').find('.quantity-input').data('index');
    const currentQuantity = selectedProducts[index].quantity;
    selectedProducts[index].quantity = currentQuantity + 1;
    updatePriceAndSubtotal(index);
    updateCartTable(selectedProducts);
    updateQuantityInput(index, currentQuantity + 1);
    console.log('Updated quantity:', selectedProducts[index].quantity);
});

// Add an event listener to the minus button
$('.minus-btn').on('click', function() {
    const index = $(this).closest('td').find('.quantity-input').data('index');
    const input = $(this).closest('td').find('.quantity-input');
    const currentQuantity = parseInt(input.val()) || 0;
    if (currentQuantity > 1) {
        input.val(currentQuantity - 1);
        selectedProducts[index].quantity = currentQuantity - 1;
        updatePriceAndSubtotal(index);
        updateCartTable(selectedProducts);
        console.log('Updated quantity:', selectedProducts[index].quantity); // Log the updated quantity
    }
});

function updateQuantityInput(index, value) {
    $(`.quantity-input[data-index="${index}"]`).val(value);
}



        // Add an event listener to delete products
        $('.delete-product').on('click', function() {
            const index = $(this).data('index');
            selectedProducts.splice(index, 1); // Remove the product at the given index
            updateCartTable(selectedProducts);
        });

        const totalPrice = calculateTotalPrice(products);

        tableBody.append(`
            <tr>
                <th class="fw-bold" colspan="4">Total:</th>
                <td>&#8369; ${totalPrice.toLocaleString()}</td>
                <td></td>
            </tr>
        `);
        // Update the cart count
        updateCartCount();
    }

    
// Handle the "Place Order" button click
$('#saveBtn').on('click', function () {
    // Calculate subtotal for each product
    selectedProducts.forEach(product => {
        product.subtotal = product.price * product.quantity;
    });

    const totalPrice = calculateTotalPrice(selectedProducts);
    const orderType = $('input[name="orderType"]:checked').val();
    const paymentMethod = $('input[name="paymentMethod"]:checked').val();

    if (!orderType || !paymentMethod) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please choose the order type and payment method',
        });
        return; // Prevent further processing if not both options are selected.
    }

    // Create an array to store the product data to send to the server
    const productsToSend = selectedProducts.map(product => ({
        productId: product.id,
        quantity: product.quantity,
        subtotal: product.subtotal
    }));

    const selectedSaladIds = saladIdsInTable;

    console.log('Total Price:', totalPrice);
    console.log('Order Type:', orderType);
    console.log('Payment Method:', paymentMethod);
    console.log('Selected Salad IDs:', selectedSaladIds);
    console.table(selectedSaladIds);

    // Include saladIds in the data to save
    const dataToSave = {
        totalPrice,
        orderType,
        paymentMethod,
        selectedProducts: productsToSend,
        saladIds: selectedSaladIds,
    };

    // Set up the CSRF token for the AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const routeURL = $('#saveBtn').data('route');

    $.ajax({
        url: '/customer/save-order',
        type: 'POST',
        data: JSON.stringify(dataToSave),
        contentType: 'application/json',
        success: function (response) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your order has been successful',
                showConfirmButton: false,
                timer: 1500
            });

            // Redirect to the desired route after a successful order
            window.location.href = routeURL;
        },
        error: function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'There was an error processing your order',
            });
        }
    });

    // Log the data after sending the AJAX request
    console.table(selectedProducts);
});


});


const saladIdsInTable = [];

document.addEventListener('DOMContentLoaded', function () {
    const saladCards = document.querySelectorAll('.salad');
    const saladInfo = document.querySelector('#salad-info');
    const noSaladLabel = document.querySelector('#no-salad-label');
    let rowNum = 0;
   

    saladCards.forEach(card => {
        card.addEventListener('click', function () {
            const saladId = this.getAttribute('data-salad-id');
            const saladName = this.querySelector('.card-title').textContent;
            const saladPrice = this.getAttribute('data-salad-price')
            // Check if the salad already exists in the off-canvas
            const isSaladExist = saladIdsInTable.includes(saladId);

            if (isSaladExist) {
                // Show an alert error if the salad already exists
                // Swal.fire({
                //     icon: 'error',
                //     title: 'Oops...',
                //     text: 'This salad is already added.',
                // });
            } else if (rowNum < 5) {
                rowNum++; // Increment the row number

                // Create a new table row and append it to the existing content
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <th scope="row">${rowNum}</th>
                    <td>${saladName}</td>
                    <td class="text-success data-salad-price">Toppings</td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-sm delete-salad">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </td>
                `;
                saladInfo.appendChild(newRow);

                // Hide the "No salad information" label when adding the first salad
                if (rowNum === 1) {
                    noSaladLabel.style.display = 'none';
                }

                // Add the salad ID to the array
                saladIdsInTable.push(saladId);

                // Add an event listener to delete the salad when the delete button is clicked
                const deleteButton = newRow.querySelector('.delete-salad');
                deleteButton.addEventListener('click', function () {
                    newRow.remove(); // Remove the salad row
                    rowNum--; // Decrement the row number
                    saladIdsInTable.splice(saladIdsInTable.indexOf(saladId), 1); // Remove the salad ID from the array
                    if (rowNum === 0) {
                        // Show the "No salad information" label when all salads are removed
                        noSaladLabel.style.display = 'block';
                    }
                });
            } else {
                // Show an alert error if the maximum limit is reached
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '5 toppings',
                });
            }
        });
    });
});


// Select the radio buttons
const orderTypeRadios = document.querySelectorAll('.order-type');

// Add an event listener to the radio buttons
orderTypeRadios.forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.checked) {
            const selectedOrderType = this.value;
            console.log(`${selectedOrderType}`);
        }
    });
});


// Select the radio buttons
const paymentMethodRadios = document.querySelectorAll('.payment-method');

// Add an event listener to the radio buttons
paymentMethodRadios.forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.checked) {
            const selectedPaymentMethod = this.value;
            console.log(`${selectedPaymentMethod}`);
        }
    });
});












