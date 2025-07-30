<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>payment</title>
  <link rel="stylesheet" href="">
  <style>
    * {
  box-sizing: border-box;
}

html,
body {
  font-family: 'Montserrat', sans-serif;
  display: flex;
  width: 100%;
  height: 100%;
  background: #f4f4f4;
  justify-content: center;
  align-items: center;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url(redbg.jpg);
}

.checkout-panel {
  display: flex;
  flex-direction: column;
  width: 940px;
  height: 766px;
  background-color: rgb(255, 255, 255);
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0,.2);
}

.panel-body {
  padding: 5%;
  flex: 1;
}

.title {
  font-weight: 700;
  margin-top: 0;
  margin-bottom: 40px;
  color: #2e2e2e;
}

.progress-bar {
  display: flex;
  margin-bottom: 50px;
  justify-content: space-between;
}

.step {
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  display: block;
  width: 25px;
  height: 25px;
  margin-bottom: 30px;
  border: 4px solid #fff;
  border-radius: 50%;
  background-color: #efefef;
}

.step:after {
  position: absolute;
  z-index: -1;
  top: 5px;
  left: 22px;
  width: 225px;
  height: 6px;
  content: '';
  background-color: #efefef;
}

.step:before {
  color: #2e2e2e;
  position: absolute;
  top: 40px;
}

.step:last-child:after {
  content: none;
}

.step.active {
  background-color: #f62f5e;
}

.step.active:after {
  background-color: #f62f5e;
}

.step.active:before {
  color: #f62f5e;
}

.step.active +.step {
  background-color: #f62f5e;
}

.step.active +.step:before {
  color: #f62f5e;
}

.step:nth-child(1):before {
  content: 'Delivery';
}

.step:nth-child(2):before {
  right: -40px;
  content: 'Confirmation';
}

.step:nth-child(3):before {
  right: -30px;
  content: 'Payment';
}

.step:nth-child(4):before {
  right: 0;
  content: 'Finish';
}

.payment-method {
  display: flex;
  margin-bottom: 60px;
  justify-content: space-between;
}

.method {
  display: flex;
  flex-direction: column;
  width: 382px;
  height: 122px;
  padding-top: 20px;
  cursor: pointer;
  border: 1px solid transparent;
  border-radius: 2px;
  background-color: rgb(249, 249, 249);
  justify-content: center;
  align-items: center;
}

.card-logos {
  display: flex;
  width: 150px;
  justify-content: space-between;
  align-items: center;
}

.radio-input {
  margin-top: 20px;
}

input[type='radio'] {
  display: inline-block;
}

.input-fields {
  display: flex;
  justify-content: space-between;
}

.input-fields label {
  display: block;
  margin-bottom: 10px;
  color: #b4b4b4;
}

.info {
  font-size: 12px;
  font-weight: 300;
  display: block;
  margin-top: 50px;
  opacity:.5;
  color: #2e2e2e;
}

div[class*='column'] {
  width: 382px;
}

input[type='text'],
input[type='password'] {
  font-size: 16px;
  width: 100%;
  height: 50px;
  padding-right: 40px;
  padding-left: 16px;
  color: rgba(46, 46, 46,.8);
  border: 1px solid rgb(225, 225, 225);
  border-radius: 4px;
  outline: none;
}

input[type='text']:focus,
input[type='password']:focus {
  border-color: rgb(119, 219, 119);
}

#date { 
background: url(img/icons_calendar_black.png) no-repeat 95%;
}

#cardholder { 
background: url(img/icons_person_black.png) no-repeat 95%; 
}

#cardnumber {
 background: url(img/icons_card_black.png) no-repeat 95%; 
}

#verification {
 background: url(img/icons_lock_black.png) no-repeat 95%; 
}

.small-inputs {
  display: flex;
  margin-top: 20px;
  justify-content: space-between;
}

.small-inputs div {
  width: 182px;
}

.panel-footer {
  display: flex;
  width: 100%;
  height: 96px;
  padding: 0 80px;
  background-color: rgb(239, 239, 239);
  justify-content: space-between;
  align-items: center;
}

.btn {
  font-size: 16px;
  width: 163px;
  height: 48px;
  cursor: pointer;
  transition: all.2s ease-in-out;
  letter-spacing: 1px;
  border: none;
  border-radius: 4px;
  color: #fff;
  background-color: #f62f5e;
}

.btn:hover {
  background-color: #e62e4c;
}

.back-btn {
  background-color: #fff;
  color: #2e2e2e;
  border: 1px solid #ddd;
}

.back-btn:hover {
  background-color: #f7f7f7;
}

.next-btn {
  margin-left: 20px;
}

.payment-button {
  margin-top: 40px;
  text-align: center;
}

#pay-button {
  width: 100%;
  height: 50px;
  font-size: 18px;
  font-weight: 700;
  cursor: pointer;
  transition: all.2s ease-in-out;
  letter-spacing: 1px;
  border: none;
  border-radius: 4px;
  color: #fff;
  background-color: #f62f5e;
}

#pay-button:hover {
  background-color: #e62e4c;
}

#payment-success-popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: none;
  justify-content: center;
  align-items: center;
}

.popup-content {
  width: 400px;
  height: 200px;
  background-color: #fff;
  border-radius: 4px;
  padding: 20px;
  text-align: center;
}

.popup-content h2 {
  margin-top: 0;
  font-weight: 700;
  color: #2e2e2e;
}

.popup-content p {
  margin-bottom: 40px;
  color: #2e2e2e;
}

.close-popup {
  width: 100%;
  height: 40px;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  transition: all.2s ease-in-out;
  letter-spacing: 1px;
  border: none;
  border-radius: 4px;
  color: #fff;
  background-color: #f62f5e;
}

.close-popup:hover {
  background-color: #e62e4c;
}

#payment-success-popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  opacity: 0; 
  transition: opacity 0.5s ease, visibility 0.5s ease; 
}

.checkmark {
  font-size: 50px; 
  color: #4CAF50; 
  margin-bottom: 20px; 
}

#payment-success-popup .popup-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.9); 
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  transition: transform 0.5s ease; 
}

#payment-success-popup.active .popup-content {
  transform: translate(-50%, -50%) scale(1); 
}

#payment-success-popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(244, 239, 239, 0.5);
  z-index: 1000;
  opacity: 0; 
  visibility: hidden; 
  transition: opacity 0.5s ease, visibility 0.5s ease; 
}

#payment-success-popup.active {
  display: flex;
  opacity: 1; 
  visibility: visible; 
}

  </style>
</head>
<body>
  <main id="main" class="inner account-checkout">
    <section id="account-cart" class="checkout">
      Cart
      <table id="cart-list"></table>
    </section>
    <section class="order-form">
      <div class="pay-container">
        <form class="checkout-form" name="formCheckout" action="order.php" method="post">
          <div class="checkout-panel">
            <div class="panel-body">
              <h2 class="title">Payment</h2>
              <p>Accepted payment through Cards</p>
              <div class="payment-method">
                <label for="card" class="method card">
                  <div class="card-logos">
                    <img src="https://designmodo.com/demo/checkout-panel/img/visa_logo.png"/>
                    <img src="https://designmodo.com/demo/checkout-panel/img/mastercard_logo.png"/>
                  </div>
                  <div class="radio-input">
                    <input id="card" type="radio" name="payment">
                    Pay £340.00 with credit card
                  </div>
                </label>
                <label for="paypal" class="method paypal">
                  <img src="https://designmodo.com/demo/checkout-panel/img/paypal_logo.png"/>
                  <div class="radio-input">
                    <input id="paypal" type="radio" name="payment">
                    Pay £340.00 with PayPal
                  </div>
                </label>
              </div>
              <div class="input-fields">
                <div class="column-1">
                  <label for="cardholder">Cardholder's Name</label>
                  <input type="text" id="cardholder"/>
                  <div class="small-inputs">
                    <div>
                      <label for="date">Valid thru</label>
                      <input type="text" id="date" placeholder="MM / YY"/>
                    </div>
                    <div>
                      <label for="verification">CVV / CVC *</label>
                      <input type="password" id="verification"/>
                    </div>
                  </div>
                </div>
                <div class="column-2">
                  <label for="cardnumber">Card Number</label>
                  <input type="password" id="cardnumber"/>
                  <span class="info">* CVV or CVC is the card security code, unique three digits number on the back of your card separate from its number.</span>
                </div>
              </div>
              <div class="payment-button">
                <button id="pay-button">Make Payment</button>
              </div>
            </div>
            <div class="panel-footer">
              <button type="button" class="btn back-btn">Back</button>
              <button type="button" class="btn next-btn">Next Step</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
  
  <div id="payment-success-popup">
    <div class="popup-content">
      <div class="checkmark">&#10004;</div>
      <h2>Payment Succeeded!</h2>
      <p>Your confirmation code is: XXXX-XXXX-XXXX-XXXX</p>
      <button class="close-popup">Close</button>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#pay-button').on('click', function(event) {
        event.preventDefault(); 
        setTimeout(function() {
          $('#payment-success-popup').addClass('active');
        }, 2000);
      });

      $('#payment-success-popup .close-popup').on('click', function() {
        $('#payment-success-popup').removeClass('active');
      });

      document.querySelector('.back-btn').addEventListener('click', function() {
        window.location.href = 'paymentplans.html';
      });

      document.querySelector('.next-btn').addEventListener('click', function() {
        window.location.href = 'profile.html';
      });

      console.log('JavaScript is working');
    });
  </script>
</body>
</html>
