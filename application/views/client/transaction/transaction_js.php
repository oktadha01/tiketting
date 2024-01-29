<script>
document.addEventListener("DOMContentLoaded", function() {
    var payNowButtons = document.querySelectorAll('.payNowButton');

    payNowButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var urlPayment = button.getAttribute('data-url-payment');

            window.location.href = urlPayment;
        });
    });
});
</script>