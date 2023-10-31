window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "12345",
    cluster:"mt1",
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

// window.Echo.join("user-status")
//     .here((users) => {
//         receiver_id = users[0]._id;
//         console.log({ users });
//         console.log({ receiver_id });
//     })
//     .joining((user) => {
//         // $('#'+user.id+'-status').removeClass('offline-status');
//         // $('#'+user.id+'-status').addClass('online-status');
//         // $('#'+user.id+'-status').text('Online');
//     })
//     .leaving(() => {
//         // $('#'+user.id+'-status').removeClass('online-status');
//         // $('#'+user.id+'-status').addClass('offline-status');
//         // $('#'+user.id+'-status').text('Offline');
//     })
//     .listen("UserStatusEvent", (e) => {
//         console.log({e});
//     }).listenForWhisper('typing',response =>{
//         console.log(response);
//     });