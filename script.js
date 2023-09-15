
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", makePayment, false);
var email = document.getElementById("email").value;
var votes = document.getElementById("amount");

function makePayment(e) {
  e.preventDefault();
  FlutterwaveCheckout({
    public_key: 'FLWPUBK_TEST-e1c51421ec73e7b131f3a200ab7b7318-X', // Replace with your public key
    tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1),
    amount: document.getElementById("amount").value * 50,
    currency: "NGN",
    country: "NG",
    // payment_options: "card,mobilemoney,ussd",
    redirect_url: "verify.php",
    customer: {
      email: email, // Replace with your customer's email
      phone_number: "08102909304", // Replace with your customer's phone number
      // name: "Customer Name",
    },
    callback: function (data) {
      console.log(data);
    },
    onclose: function() {
      // close modal
    },
    customizations: {
      title: "Harley Innovations",
      description: "Payment for items in cart",
      logo: "https://assets.piedpiper.com/logo.png", // Replace with your company's logo URL
    },
    meta: {
      votes: votes, // Add your extra data here
    }
  });
}