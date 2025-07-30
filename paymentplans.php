<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plans</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f4f4f4;
    background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url(redbg.jpg);
}

.container {
    display: flex;
    justify-content: center;
}

.plan {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
    padding: 20px;
    text-align: center;
    width: 300px;
}

.plan h2 {
    color: #fff;
    padding: 10px 0;
}

.plan.free h2 {
    background-color: #8e44ad;
}

.plan.basic h2 {
    background-color: #9b59b6;
}

.plan.premium h2 {
    background-color: #e74c3c;
}

.price {
    font-size: 24px;
    margin: 20px 0;
}

.price span {
    font-size: 16px;
    color: #777;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

ul li:last-child {
    border-bottom: none;
}

.pay-btn {
    background-color: #9b59b6;
    color: #fff;
    border: none;
    padding: 10px 20px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
}

.pay-btn:hover {
    background-color: #8e44ad;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="plan free">
            <h2>FREE</h2>
            <p class="price">Rs 0<br><span>for 12 months</span></p>
            <ul>
                <li>Profile Views: 15</li>
                <li>Full Profile Requests: 3</li>
                <li>Image Request: 0</li>
                <li>Contact Request: 3</li>
                <li>Chat Request: 3</li>
            </ul>
            <button class="pay-btn" onclick="location.href='profile.html'">Free Plan Use</button>
        </div>
       
        <div class="plan premium">
            <h2>PREMIUM</h2>
            <p class="price">Rs 1999<br><span>for 1 month</span></p>
            <ul>
                <li>Profile Views: 200</li>
                <li>Full Profile Requests: 50</li>
                <li>Image Request: 50</li>
                <li>Contact Request: 50</li>
                <li>Chat Request: 50</li>
            </ul>
            <button class="pay-btn" onclick="location.href='payment.html'">Pay with Card</button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const payButtons = document.querySelectorAll(".pay-btn");

            payButtons.forEach(button => {
                button.addEventListener("click", () => {
                    alert("Payment option selected: " + button.textContent);
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const payWithCardBtn = document.getElementById('pay-with-card');

            payWithCardBtn.addEventListener('click', function() {
                window.location.href = 'payment.html';
            });
        });
        </script>
</body>
</html>
