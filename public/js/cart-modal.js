document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('open-cart-modal');
    const closeBtn = document.getElementById('close-cart-modal');
    const modal = document.getElementById('cart-modal');
    const content = document.getElementById('cart-modal-content');

    function openModal() {
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    function loadCart() {
        content.innerHTML = 'Loading cart...';

        fetch('/cart?modal=1')
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
                attachRemoveHandlers();
                attachClearCartHandler(); 
                attachReviewHandler();
            })
            .catch(() => {
                content.innerHTML = '<p>Error loading cart.</p>';
            });
    }

    function attachRemoveHandlers() {
        const removeForms = content.querySelectorAll('form.remove-from-cart');

        removeForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    loadCart();
                });
            });
        });
    }

    function attachReviewHandler() {
        const reviewForm = content.querySelector('form.proceed-to-review');

        if (reviewForm) {
            reviewForm.addEventListener('submit', function (e) {
                e.preventDefault();

                fetch('/checkout?modal=1')
                    .then(response => response.text())
                    .then(html => {
                        content.innerHTML = html;
                        attachBackToCartHandler();
                        attachCheckoutHandler();
                    });
            });
        }
    }

    function attachBackToCartHandler() {
        const backBtn = content.querySelector('.back-to-cart');

        if (backBtn) {
            backBtn.addEventListener('click', function (e) {
                e.preventDefault();
                loadCart();
            });
        }
    }

    // INTERCEPT "ADD TO CART" AND OPEN MODAL
    function attachAddToCartHandlers() {
        const addForms = document.querySelectorAll('form.add-to-cart-form');

        addForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    openModal();
                    loadCart();
                });
            });
        });
    }

    function attachCheckoutHandler() {
        const checkoutForm = content.querySelector('#modal-checkout-form');
    
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function (e) {
                e.preventDefault();
    
                const formData = new FormData(checkoutForm);
    
                fetch('/checkout/process', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(() => {
                    // Load success page INTO the modal
                    fetch('/checkout/success?modal=1')
                        .then(response => response.text())
                        .then(html => {
                            content.innerHTML = html;
                        });
                });
            });
        }
    }

    function attachClearCartHandler() {
        const clearForm = content.querySelector('form.clear-cart-form');
    
        if (clearForm) {
            clearForm.addEventListener('submit', function (e) {
                e.preventDefault();
    
                fetch(clearForm.action, {
                    method: 'POST'
                }).then(() => {
                    loadCart(); // Reload modal cart without closing
                });
            });
        }
    }    
    
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
    attachAddToCartHandlers();
});

