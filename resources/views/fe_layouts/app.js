// import './bootstrap';

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDQFkPHTuvxOgZwGneKRCtIo-f8dKIxYP0",
  authDomain: "notif-ptn.firebaseapp.com",
  projectId: "notif-ptn",
  storageBucket: "notif-ptn.appspot.com",
  messagingSenderId: "548677176397",
  appId: "1:548677176397:web:0ed4a619276eb093b4a004",
  measurementId: "G-VKMGBZ0B7Y"
};

onMessage(messaging, (payload) => {
    // console.log('Message received. ', payload);
    alert('notifikasi diterima');
});

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = getMessaging(app);
getToken(messaging, { vapidKey: 'BNN9e3JwYwoNfAoBcOrWsGJvdytliNCPsbp7oYQPhfwAc3JAK33tJcNTFO8IpzMGZoJUacZg1c1YcxzhPhKVXYU' }).then((currentToken) => {
  if (currentToken) {
    // Send the token to your server and update the UI if necessary
    // ...
    console.log(currentToken);
  } else {
    // Show permission request UI
    requestPermission();
    console.log('No registration token available. Request permission to generate one.');
    // ...
  }
}).catch((err) => {
  console.log('An error occurred while retrieving token. ', err);
  // ...
});


function requestPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
          console.log('Notification permission granted.');
          // TODO(developer): Retrieve a registration token for use with FCM.
          // ...
        } else {
            alert('izinkan notifikasi pada browser');
        }
      });
}
