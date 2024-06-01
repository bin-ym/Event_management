<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mock Payment Gateway</title>
</head>
<body>
  <h1>Mock Payment Gateway</h1>
  <form id="paymentForm">
    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required><br>
    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" name="cardNumber" required><br>
    <label for="expiry">Expiry Date:</label>
    <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required><br>
    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required><br>
    <button type="submit">Pay Now</button>
  </form>
  <div id="paymentResult"></div>

  <script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(document.getElementById('paymentForm'));
      const data = Object.fromEntries(formData.entries());

      fetch('/payment/process', { // Replace with your actual endpoint
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
        .then(response => response.json())
        .then(data => {
          const paymentResult = document.getElementById('paymentResult');
          paymentResult.innerHTML = `<p>${data.status.toUpperCase()}: ${data.message}</p>`;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  </script>
</body>
</html>
