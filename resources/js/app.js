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

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = getMessaging(app);

$(document).ready(function () {
  var wrapper = $('.wrapper_notif');
  $.ajax({
      type: 'GET',
      url: '/get-my-notif',
      success: function(response) {
        $('#total_notif').html(response.total);
        $.each(response.data, function(index, value) {
          $('#notif'+index).remove();
          if (value.status == 'unread') {
            wrapper.append(
              '<li id="notif'+index+'">'
                  +'<div class="cartmini__thumb">'
                  +'<i class="fa fa-bell" style="widows: 100px"></i>'
                  +'</div>'
                  +'<div class="cartmini__content">'
                  +'<h5><a href="'+value.link+'">'+value.pesan+ ' ('+response.tanggal[index]+')'+'</a></h5>'
                  +'<div class="product__sm-price-wrapper">'
                  // +'<span href="#" class="product__sm-price btn" style="font-size: 10px">'+value.created_at+'</span>'
                  +'</div>'
                  +'</div>'
                  +'<a href="#" class="cartmini__del"><i class="fal fa-times"></i></a>'
                  +'</li>'
            );
          }else{
            wrapper.append(
              '<li id="notif'+index+'" style="background-color: rgb(218, 218, 218)">'
                  +'<div class="cartmini__thumb">'
                  +'<i class="fa fa-bell" style="widows: 100px"></i>'
                  +'</div>'
                  +'<div class="cartmini__content">'
                  +'<h5><a href="'+value.link+'">'+value.pesan+ ' ('+response.tanggal[index]+')'+'</a></h5>'
                  +'<div class="product__sm-price-wrapper">'
                  // +'<span href="#" class="product__sm-price btn" style="font-size: 10px">'+value.created_at+'</span>'
                  +'</div>'
                  +'</div>'
                  +'<a href="#" class="cartmini__del"><i class="fal fa-times"></i></a>'
                  +'</li>'
            );
          }
        })
      }
  });
})



onMessage(messaging, (payload) => {
  // console.log('Message received. ', payload);
  // alert('notifikasi diterima');
  notif();
  toastr.success('Ada pesan baru, segera cek notifikasi kamu');
});

$('#read_all_notif').on('click', function () {
  $.ajax({
      type: 'GET',
      url: '/read-all-notif',
      success: function(response) {
        $('#total_notif').html('0');
        location.reload();
      }
  });
})

getToken(messaging, { vapidKey: 'BNN9e3JwYwoNfAoBcOrWsGJvdytliNCPsbp7oYQPhfwAc3JAK33tJcNTFO8IpzMGZoJUacZg1c1YcxzhPhKVXYU' }).then((currentToken) => {
  if (currentToken) {
    // Send the token to your server and update the UI if necessary
    // ...
    // console.log(currentToken);
    sentTokenToServer(currentToken);
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


function sentTokenToServer(token){
  
  var csrf = document.querySelector('meta[name="csrf-token"]')
  .getAttribute("content");

  let formData = new FormData();

  formData.append("token",token);
  
  fetch("/tokenweb",{
      headers: {
          "X-CSRF-Token": csrf,
          _method:"_POST",
      },
      method: "post",
      credentials: "same-origin",
      body: formData,
  }).then((response)=>{
      console.log('initialitation token');
      // success web token updated
  })
}

function notif(){
  var wrapper = $('.wrapper_notif');
  $.ajax({
      type: 'GET',
      url: '/get-my-notif',
      success: function(response) {
        swal({
            title: "NOTIF!",
            text: response.last,
            type: "success",
            timer: 3000
        });
        $('#total_notif').html(response.total);
        // toastr.success(response.last);
        $.each(response.data, function(index, value) {
          $('#notif'+index).remove();
          wrapper.append(
            '<li id="notif'+index+'">'
                +'<div class="cartmini__thumb">'
                +'<i class="fa fa-bell" style="widows: 100px"></i>'
                +'</div>'
                +'<div class="cartmini__content">'
                +'<h5><a href="'+value.link+'">'+value.pesan+ '('+response.tanggal[index]+')'+'</a></h5>'
                +'<div class="product__sm-price-wrapper">'
                // +'<a href="#" class="product__sm-price btn btn-xs btn-primary text-white" style="border-radius:20px; font-size: 10px">mark as read</a>'
                +'</div>'
                +'</div>'
                +'<a href="#" class="cartmini__del"><i class="fal fa-times"></i></a>'
                +'</li>'
          );
        })
      }
  });
}