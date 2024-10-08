




$(document).ready(function() {
    const selectedProducts = [];
    const selectedSalads = [];
    

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

    function calculateTotalPrice(products, saladIds, saladPrice) {
        let productsTotal = 0;
    
        // Check if saladIds is defined and has length
        const hasCustomizedSalads = saladIds && saladIds.length > 0;
    
        for (const product of products) {
            productsTotal += product.price * product.quantity;
        }
    
        // Calculate the total price for both products and salads only if there are customized salads
        const overallTotal = hasCustomizedSalads ? productsTotal + saladPrice : productsTotal;
    
        return overallTotal;
    }
    
    
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
    const saladInfo = $('#salad-info');
    const noSaladLabel = $('#no-salad-label');
    const selectedSaladIds = saladIdsInTable;
    const fixedSaladPrice = 285;

    // Clear the table body and salad info
    tableBody.empty();
    saladInfo.empty();

    // Render product rows
    let productsTotal = 0;
    products.forEach((product, index) => {
        const subtotal = product.price * product.quantity;
        tableBody.append(`
            <tr class="product-row" data-index="${index}">
                <th scope="row">${index + 1}</th>
                <td class="product-title">${product.title}</td>
                <td>
                    <span class="product-price fs-6" data-index="${index}">
                        &#8369; ${product.price.toFixed(2)}
                    </span>
                </td>
                <td>
                <div class="input-group" style="background-color:#81B233;">
                <div class="input-group-prepend">
                    <button class="btn btn-quantity minus-btn" type="button" style="color:#fff; font-size: 16px;">-</button>
                </div>
                <input
                    readonly
                    type="number"
                    class="form-control me-8 form-control-lg quantity-input"
                    data-index="${index}"
                    value="${product.quantity}"
                    style="font-size: 16px; text-align: center; width: 50px;" 
                <div class="input-group-append">
                    <button class="btn btn-quantity plus-btn" type="button" style="color:#fff; font-size: 16px;">+</button>
                </div>
            </div>
                </td>
                <td>
                    <span class="product-subtotal" data-index="${index}">
                        &#8369; ${subtotal.toFixed(2)}
                    </span>
                </td>
                <td class="action-column">
                    <button class="btn btn-danger btn-sm delete-product" data-index="${index}">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </td>
            </tr>
        `);
        productsTotal += subtotal;
    });
    const overallTotal = calculateTotalPrice(products, saladIdsInTable, fixedSaladPrice);

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
    // Add an event listener to delete products
    $('.delete-product').on('click', function () {
        const index = $(this).data('index');
        selectedProducts.splice(index, 1);
        updateCartTable(selectedProducts);
    });

    let rowNum = 0;
    saladIdsInTable.forEach((saladId) => {
        const card = $(`.salad[data-salad-id="${saladId}"]`);
        const saladName = card.find('.card-title').text();
        const saladPrice = 285; // Set the salad price to a fixed value
        // Create a new table row and append it to the existing content
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <th scope="row">${rowNum + 1}</th>
        <td>${saladName}</td>
        <td class="text-success">Toppings</td>
        <td></td>
        <td class="text-success"></td> <!-- Display the salad price -->
        <td>
            <button class="btn btn-danger btn-sm delete-salad">
                <i class="bi bi-trash3-fill"></i>
            </button>
        </td>
        `;
    
        saladInfo.append(newRow);
    
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
    
        rowNum++;
    });
    
    // Hide the "No salad information" label when adding the first salad
    if (rowNum > 0) {
        noSaladLabel.hide();
    } else {
        noSaladLabel.show();
    }

    
    // Append the total row for products
    saladInfo.append(`
    <tr>
        <th class="fw-bold" colspan="4">Total:</th>
        <td>&#8369; ${overallTotal.toLocaleString()}</td>
    </tr>
`);

    // Update the cart count
    updateCartCount();
}


// Handle the "Place Order" button click
$('#saveBtn').on('click', function () {
    // Check if the cart is empty
    if (selectedProducts.length === 0 && saladIdsInTable.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Your cart is empty. Add some products or salads to place an order.',
        });
        return;
    }

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

// Function to update salad information
function updateSaladInfo() {
    const saladInfo = $('#salad-info');
    const noSaladLabel = $('#no-salad-label');
    
    // Clear the salad info
    saladInfo.empty();

    let rowNum = 0;
    saladIdsInTable.forEach((saladId) => {
        const card = $(`.salad[data-salad-id="${saladId}"]`);
        const saladName = card.find('.card-title').text();
        const saladPrice = 285; // Set the salad price to a fixed value

        // Create a new table row and append it to the existing content
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <th scope="row">${rowNum + 1}</th>
            <td>${saladName}</td>
            <td class="text-success">Toppings</td>
            <td></td>
            <td></td>
            <td>
                <button class="btn btn-danger btn-sm delete-salad">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </td>
        `;

        saladInfo.append(newRow);

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
        

        rowNum++;
    });

    // Hide the "No salad information" label when adding the first salad
    if (rowNum > 0) {
        noSaladLabel.hide();
    } else {
        noSaladLabel.show();
    }

}



// Event listener for clicking on salad cards
$('.salad').on('click', function() {
    const saladId = $(this).data('salad-id');
    const isSaladExist = saladIdsInTable.includes(saladId);

    if (!isSaladExist && saladIdsInTable.length < 5) {
        saladIdsInTable.push(saladId);
        updateSaladInfo();
    } else if (!isSaladExist && saladIdsInTable.length >= 5) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Maximum of 5 toppings only',
        });
    }
});

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
    updateSaladInfo(); // Update salad information whenever a product is added
}




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
