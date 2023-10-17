
document.getElementById("payment-form").addEventListener("submit", function (event) {
    event.preventDefault();


    setTimeout(function () {
        alert("Payment successful!");
        window.location.href = "confirmation.php";
    }, 2000);
});
