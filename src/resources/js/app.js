import Echo from 'laravel-echo';

window.$ = window.jQuery = require('jquery');

window.Popper = require('popper.js').default;

window.Pusher = require('pusher-js');

window.Echo   = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});