//button click event
document.getElementById("send-button").onclick = function() {
    
    let send_button = document.getElementById("send-button");
    let database = firebase.database();

    let title = document.getElementsByClassName('chat-header-title');
    let room_id = title[0].id;
    let now = new Date();
    let send_text = document.getElementById("send-text");
    let existsMessage;
    let message_send;

    // message null?
    if(send_text.value == ''){
        message_send = "nothing";
        existsMessage = "no";
    }else {
        message_send = send_text.value;
        existsMessage = "yes";
    }

    let send_file = document.getElementById("send-file");
    alert(send_file.files[0]);
    let image_send;
    let existsFile;

    // file null?
    if(send_file.files.length <= 0){
        file_send = "nothing";
        existsFile = "no";
    }else {
        file_send = 'images/' + room_id + '/' + now + send_file.files[0].name;
        existsFile = "yes";
    }

   

    let params = new URLSearchParams();
    params.append('post_user_id',my_id);
    params.append('post_chat_id',room_id);
    params.append('post_message',message_send);
    params.append('post_isfile',file_send);
    params.append('post_existsMessage',existsMessage);
    params.append('post_existsFile',existsFile);


    axios.post('http://localhost/Chat/api/Write.php',params)
    .then(response => {

        alert(response.data.result);
        if(response.data.result == "ok"){

            //push database
            database.ref(room_id).push({
                uid: my_id,
                icon: my_icon,
                name: my_name,
                message: response.data.result_value[0].message,
                isfile: response.data.result_value[0].isfile,
                emessage: response.data.result_value[0].exists_message,
                efile: response.data.result_value[0].exists_file,
                senddate: response.data.result_value[0].date,
            });

            //exists file : push storage
            if(response.data.result_value[0].exists_file == "yes"){

                let storageRef = firebase.storage().ref();
                alert(send_file.files[0]);
                let uploadTask = storageRef.child(response.data.result_value[0].isfile);
               
                uploadTask.put(send_file.files[0]).then(function(snapshot) {
                alert('Upload successfully');
                send_file.value = '';

                });
            }
        }
    })
    .catch(error => {
        alert("error");
    });
    
    send_text.value = "";
    send_button.disabled = "disabled";
    send_button.style.backgroundColor = "gray";

}

// user-list click
function user_click(e){
    // let user_id = e.id;
    let title = document.getElementsByClassName('chat-header-title');
    title[0].id = e.id;
    title[0].innerHTML = e.textContent;
}

//textarea change value
function sendtextCahnge(e){

    let button = document.getElementById("send-button");

    if(e.value == ''){
        button.disabled = true;
        button.style.backgroundColor = 'gray';
    }else {
        button.disabled = false;
        button.style.backgroundColor = '#428bca';
    }
}

//get chat message

// outputopponent  message
{/* <div class="opponent-message d-flex flex-column position-relative w-100 mt-5 bg-primary h-auto">
    <div class="d-flex flex-row position-relative m-3">
    <img src="./images/icon_default.png" class="opponent-message-icon">
    <p class="position-relative m-3 ml-5">2021/01/01 22:44</p>
    </div>
    <p class=" opponent-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">message</p>
</div> */}

//output my message
{/* <div class="my-message d-flex flex-column position-relative w-100 mt-5 bg-danger auto">
    <div class="d-flex flex-row position-relative m-3">
    <p class="my-message-date position-relative m-3">2021/01/01 22:44</p>
    <img src="" class="my-message-icon ml-3 position-absolute">
    </div>
    <p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">messhuiiiiiiiiiiiiiiiiiiiagllllllllllllle</p>
</div> */}

function read_firebase(){

    let database = firebase.database();
    let title = document.getElementsByClassName('chat-header-title');
    let room_id = title[0].id;
    let prevTask = Promise.resolve();

    database.ref(room_id).on("child_added", (data) => {
        prevTask = prevTask.finally(async () => {
            const v = data.val();
            const k = data.key;
            let str;

            //my message
            if(v.uid == my_id){

                if(v.message){
                    str += '<div class="my-message d-flex flex-column position-relative w-100 mt-5 bg-danger auto">';
                    str += '<div class="d-flex flex-row position-relative m-3">';
                    str += '<p class="my-message-date position-relative m-3">' + v.senddate + '</p>';
                    str += '<img src=".' + my_icon + '" class="my-message-icon ml-3 position-absolute"></div>';
                    str += '    <p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">' + v.message + '</p></div>';
                    
                }
            }
            
            str += '';
            output.innerHTML(str);
            output.scrollIntoView();
    
        }).catch(function (error) {

            // A full list of error codes is available at
            // https://firebase.google.com/docs/storage/web/handle-errors
            switch (error.code) {
                case 'storage/object-not-found':
                    alert('File doesn\'t exist');
                    break;

                case 'storage/unauthorized':
                    alert('User doesn\'t have permission to access the object');
                    break;

                case 'storage/canceled':
                    alert('User canceled the upload');
                    break;


                case 'storage/unknown':
                    alert('Unknown error occurred, inspect the server response');
                    break;
            }
        });
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })
    .finally(function () {
        // always executed
    });
}

