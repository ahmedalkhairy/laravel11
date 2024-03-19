import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
console.log(1)
window.Echo = new Echo({
    broadcaster: 'reverb',
    debug: true, // Enable debug mode

    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});




window.Echo.channel('chat')
    .listen('.my-app-id', (e) => {
        console.log('Received message:', e.message); // Log the received message
        // Update your UI here
    });


