// Add custom JavaScript here

document.addEventListener("DOMContentLoaded", function() {
    // Example: Listen for add to cart button clicks
    const addToCartButtons = document.querySelectorAll("button.add-to-cart");
    addToCartButtons.forEach(button => {
        button.addEventListener("click", function() {
            const productId = this.dataset.productId;
            // Handle add to cart functionality
            alert("Product " + productId + " added to cart");
        });
    });
});