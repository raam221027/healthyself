// Get a reference to the input element
const inputElement = document.getElementById("amount");

// Listen for input events and restrict input to numeric characters
inputElement.addEventListener("input", function (event) {
    // Get the input value
    let inputValue = inputElement.value;

    // Remove any non-numeric characters using a regular expression
    inputValue = inputValue.replace(/[^0-9]/g, "");

    // Update the input value
    inputElement.value = inputValue;
});

const paymentRows = document.querySelectorAll(".payment-row");

        paymentRows.forEach((row) => {
            const paymentMethodInput = row.querySelector(".payment-method");
            const totalAmountInput = row.querySelector(".total-amount");
            const amountInput = row.querySelector(".amount");
            const changeInput = row.querySelector(".change");
            const errorText = row.querySelector(".amount-error");
            const payNowButton = row.querySelector(".pay-now-button");

            // Add an input event listener to the amount input for payment validation
            amountInput.addEventListener("input", function () {
                if (paymentMethodInput.value === 'Cash') {
                    // Get the entered amount as a number
                    const enteredAmount = parseFloat(amountInput.value) || 0;

                    // Get the total amount as a number
                    const totalAmount = parseFloat(totalAmountInput.value) || 0;

                    // Check if the entered amount is greater than or equal to the total amount
                    if (enteredAmount >= totalAmount) {
                        // Valid input
                        amountInput.setCustomValidity("");
                        errorText.textContent = ""; // Clear the error message

                        // Enable the "Pay Now" button
                        payNowButton.disabled = false;
                    } else {
                        // Invalid input, display a custom validation message
                        amountInput.setCustomValidity("Amount must be greater than or equal to the total amount");
                        errorText.textContent = "Amount must be greater than or equal to the total amount";

                        // Disable the "Pay Now" button
                        payNowButton.disabled = true;
                    }
                } else {
                    // If the payment method is not "Cash," you can provide some appropriate handling here.
                    amountInput.value = "";
                    amountInput.setCustomValidity("");
                    errorText.textContent = "";

                    // Disable the "Pay Now" button
                    payNowButton.disabled = true;
                }

                // Calculate the change
                const enteredAmount = parseFloat(amountInput.value) || 0;
                const totalAmount = parseFloat(totalAmountInput.value) || 0;
                const change = enteredAmount - totalAmount;
                changeInput.value = change.toFixed(2);
            });
        });

        const referenceNumberInput = document.getElementById("referenceNumber");
        const payNowButton = document.getElementById("pay-now-button");

        referenceNumberInput.addEventListener("input", function () {
            if (referenceNumberInput.value.trim() !== "") {
                // Enable the "Pay now" button when the reference number is not empty
                payNowButton.disabled = false;
            } else {
                // Disable the button if the reference number is empty
                payNowButton.disabled = true;
            }
        });




