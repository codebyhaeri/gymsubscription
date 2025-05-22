document.addEventListener('DOMContentLoaded', () => {

    // Handle subscription form submission (if exists)
    const subscribeForm = document.getElementById('subscribeForm');
    if (subscribeForm) {
        subscribeForm.addEventListener('submit', e => {
            e.preventDefault();

            const formData = new FormData(subscribeForm);

            fetch('process_subscription.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            })
            .catch(() => alert('Failed to process subscription.'));
        });
    }

    // Handle payment simulation form submission
    const paymentForm = document.getElementById('paymentForm');
    if (paymentForm) {
        paymentForm.addEventListener('submit', e => {
            e.preventDefault();

            const formData = new FormData(paymentForm);

            fetch('complete_payment.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = '../index.php'; // Redirect after payment
                } else {
                    alert(data.message);
                }
            })
            .catch(() => alert('Payment processing failed.'));
        });
    }
});
