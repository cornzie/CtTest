import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

let saveFile = () => {
    console.log('hello');
}

document.getElementById("saveProduct").addEventListener("click", function(event){
    event.preventDefault()
    let productName = document.getElementById("productName")
    let productQuantity = document.getElementById("productQuantity")
    let productPrice = document.getElementById("productPrice")
    let productsTableBody = document.getElementById("productsTableBody")
    let total = document.getElementById("total")

    let alertToast = document.getElementById("alertToast")
    let alertToastBody = document.getElementById("toastBody")

    if (productName.value.length === 0 || productQuantity.value.length === 0 || productPrice.value.length === 0) {
      alert(
        'All fields are required'
      );
      return;
    }

    let body = {
        productName: productName.value,
        productQuantity: productQuantity.value,
        productPrice: productPrice.value
    }

    axios({
        method: 'post',
        url: '/save-product',
        data: body
    })
    .then(function (response) {
        let productData = response.data

        let newProductTableRow = '<tr class=""><td scope="row">'+productData.name+'</td> <td>'+productData.quantity+'</td><td>'+productData.price+'</td> <td>'+productData.createdAt+'</td> <td>'+productData.totalValue+'</td> </tr>'
        productsTableBody.innerHTML+=newProductTableRow

        total.innerText=parseInt(total.innerText)+productData.totalValue

        productName.value=""
        productQuantity.value=""
        productPrice.value=""

        alert("Product added!")
    })
    .catch(function (error) {
        alert(error.response.data.error)
    });

});