var window = self;
importScripts('https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.8.1/firebase-analytics.js');


// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
var firebaseConfig = {
    apiKey: "AIzaSyBhg18ZfapQeZif-RcoPMYStGl1VwwAZbQ",
    authDomain: "pacpay-fb965.firebaseapp.com",
    projectId: "pacpay-fb965",
    storageBucket: "pacpay-fb965.appspot.com",
    messagingSenderId: "79197396384",
    appId: "1:79197396384:web:e5ab395bb2c9a6dd1898c5",
    measurementId: "G-SPRCVTWFTY"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png"
    };

    return self.registration.showNotification(
        title,
        options
    );
});