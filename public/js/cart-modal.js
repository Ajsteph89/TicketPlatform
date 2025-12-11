document.addEventListener('DOMContentLoaded', function () {
    // ===== DOM ELEMENT REFERENCES =====
    const openBtn = document.getElementById('open-cart-modal');
    const closeBtn = document.getElementById('close-cart-modal');
    const modal = document.getElementById('cart-modal');
    const content = document.getElementById('cart-modal-content');

    // ===== MODAL OPEN/CLOSE HELPERS =====
    function openModal() {
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    // ===== LOAD CART CONTENT INTO MODAL (AJAX) =====
    function loadCart() {
        content.innerHTML = 'Loading cart...';

        // Request the cart HTML fragment
        fetch('/cart?modal=1')
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
                // Reattach internal modal event handlers
                attachRemoveHandlers();
                attachClearCartHandler(); 
                attachReviewHandler();
            })
            .catch(() => {
                content.innerHTML = '<p>Error loading cart.</p>';
            });
    }

    // ===== REMOVE ITEM FROM CART (AJAX) =====
    function attachRemoveHandlers() {
        const removeForms = content.querySelectorAll('form.remove-from-cart');

        removeForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(form);

                // Submit removal request via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    loadCart(); // Reload updated cart UI
                });
            });
        });
    }

    // ===== SWITCH TO CHECKOUT REVIEW WITHIN MODAL =====
    function attachReviewHandler() {
        const reviewForm = content.querySelector('form.proceed-to-review');

        if (reviewForm) {
            reviewForm.addEventListener('submit', function (e) {
                e.preventDefault();

                 // Load checkout page *inside modal*
                fetch('/checkout?modal=1')
                    .then(response => response.text())
                    .then(html => {
                        content.innerHTML = html;

                        // When reviewing, attach next-step handlers
                        attachBackToCartHandler();
                        attachCheckoutHandler();
                    });
            });
        }
    }

    // ===== "BACK TO CART" FROM CHECKOUT REVIEW =====
    function attachBackToCartHandler() {
        const backBtn = content.querySelector('.back-to-cart');

        if (backBtn) {
            backBtn.addEventListener('click', function (e) {
                e.preventDefault();
                loadCart(); // Return user back to cart UI
            });
        }
    }

    // INTERCEPT "ADD TO CART" AND OPEN MODAL
    function attachAddToCartHandlers() {
        // Attach this globally because add-to-cart forms exist outside the modal
        const addForms = document.querySelectorAll('form.add-to-cart-form');

        addForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Stop full page reload

                const formData = new FormData(form);

                // Submit via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    // Immediately show updated cart in modal
                    openModal();
                    loadCart();
                });
            });
        });
    }
    // ===== PROCESS FINAL CHECKOUT (AJAX) =====
    function attachCheckoutHandler() {
        const checkoutForm = content.querySelector('#modal-checkout-form');
    
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function (e) {
                e.preventDefault();
    
                const formData = new FormData(checkoutForm);
                
                // Submit order request
                fetch('/checkout/process', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(() => {
                    // Load success page inside the modal
                    fetch('/checkout/success?modal=1')
                        .then(response => response.text())
                        .then(html => {
                            content.innerHTML = html;
                        });
                });
            });
        }
    }

    // ===== CLEAR CART (AJAX) =====
    function attachClearCartHandler() {
        const clearForm = content.querySelector('form.clear-cart-form');
    
        if (clearForm) {
            clearForm.addEventListener('submit', function (e) {
                e.preventDefault();
                
                 // Submit request to clear cart
                fetch(clearForm.action, {
                    method: 'POST'
                }).then(() => {
                    loadCart(); // Reload modal cart without closing
                });
            });
        }
    }    
    
     // ===== NAVBAR CART BUTTON =====
    if (openBtn) {
        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal();
            loadCart();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            closeModal();
        });
    }

    //  Attach Add-To-Cart interception globally
    // This must run after DOM loads, so buttons intercept AJAX instead of reloading the page.

    attachAddToCartHandlers();
});

