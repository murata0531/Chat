# Chat
Realtime chat

using Firebase
    
    ・Realtime Database

    ・Storage

_____________________________________

Build

Create "firebaseapi.js" in the "api" folder and paste your api key

For example:

```firebaseapi.js

var firebaseConfig = {
  apiKey: "example",
  authDomain: "example.com",
  projectId: "example",
  storageBucket: "example.com",
  messagingSenderId: "example",
  appId: "example",
  measurementId: "example"
};
firebase.initializeApp(firebaseConfig);
firebase.analytics();
```
_____________________________________

You must change storage rules↓
```
rules_version = '2';
service firebase.storage {
  match /b/{bucket}/o {
    match /{allPaths=**} {
      allow read, write: if true;
    }
  }
}
```
