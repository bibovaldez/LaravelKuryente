import "./bootstrap";

const userId = document.head.querySelector('meta[name="user-id"]').content;

// Now you can use `userId` in your channel name:
Echo.private(`private.meter-channel.${userId}`)
    .subscribed(() => {
        console.log("subscribed");
    })
    .listen(".meter-event", (event) => {
        console.log(event);
    });
