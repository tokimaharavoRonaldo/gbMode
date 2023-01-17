/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './css/responsive.css';
import './css/style.css';
import './styles/app.scss';

import { Tooltip, Toast, Popover } from 'bootstrap';
// import './bootstrap';
require('bootstrap');
require('bootstrap/dist/js/bootstrap.bundle');
import './js/custom';
// start the Stimulus application
// require('bootstrap');
// import './bootstrap';

// import jquery from 'jquery';
// import 'jquery-ui';

//   const $ = require('jquery');
  import $ from 'jquery';
  window.$ =$ ;

// require('bootstrap');
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap/dist/css/bootstrap.min.css';


require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

$(document).ready(function(){

  // initNbrePanier();
 
$('.btn-add-panier').on('click',function(e){
  // alert('hello');
  e.preventDefault();
  var id = $(this)
  .closest('#item')
  .find('input.product_id').val();
// alert(id);
// add_panier();
  $.ajax({
    url : '/ajax/add/panier',
    data : {id : id},
    success: function (result) {
                console.log(result);
                numberCards(result);
    }
});

});


function initNbrePanier(){
  $.ajax({
    url : '/ajax/nbre/panier',
    // data : {id : id},
    success: function (result) {
                console.log(result);
                numberCards(result);
    }
});
}

function numberCards(nbre){
  $('.navbar-area').find('.nbre_cart').text(nbre);
}

paypal.Buttons({
  // Sets up the transaction when a payment button is clicked
  createOrder: (data, actions) => {
    return actions.order.create({
      purchase_units: [{
        amount: {
          value: '77.44' // Can also reference a variable or function
        }
      }]
    });
  },
  // Finalize the transaction after payer approval
  onApprove: (data, actions) => {
    return actions.order.capture().then(function(orderData) {
      // Successful capture! For dev/demo purposes:
      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
      const transaction = orderData.purchase_units[0].payments.captures[0];
      alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
      // When ready to go live, remove the alert and show a success message within this page. For example:
      // const element = document.getElementById('paypal-button-container');
      // element.innerHTML = '<h3>Thank you for your payment!</h3>';
      // Or go to another URL:  actions.redirect('thank_you.html');
    });
  }
}).render('#paypal-button-container');
  
});


