//button click event
document.getElementById("send-button").onclick = function() {

    let send_button = document.getElementById("send-button");

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

        if(response.data.result == "ok"){

            //exists file : push storage
            if(response.data.result_value[0].exists_file == "yes"){

                let storageRef = firebase.storage().ref();
                let uploadTask = storageRef.child(response.data.result_value[0].isfile);
               
                uploadTask.put(send_file.files[0]).then(function(snapshot) {

                    //push database
                    database.ref("users/" + room_id).push({
                        uid: my_id,
                        icon: my_icon,
                        name: my_name,
                        message: response.data.result_value[0].message,
                        isfile: response.data.result_value[0].isfile,
                        emessage: response.data.result_value[0].exists_message,
                        efile: response.data.result_value[0].exists_file,
                        senddate: response.data.result_value[0].date,
                    });
                    alert('Upload successfully');
                    send_file.value = '';

                });
            }else {

                //push database
                database.ref("users/" + room_id).push({
                    uid: my_id,
                    icon: my_icon,
                    name: my_name,
                    message: response.data.result_value[0].message,
                    isfile: response.data.result_value[0].isfile,
                    emessage: response.data.result_value[0].exists_message,
                    efile: response.data.result_value[0].exists_file,
                    senddate: response.data.result_value[0].date,
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
    database.ref("users/").off("child_added");


}

// user-list click
function user_click(e){
    // let user_id = e.id;
    let title = document.getElementsByClassName('chat-header-title');
    title[0].id = e.id;
    title[0].innerHTML = e.textContent;

    let pathReference = firebase.storage().ref();
    let room_id = title[0].id;
    let prevTask = Promise.resolve();
    let output = document.getElementById('output');

    //Talk room initialization
    while(output.firstChild ){
        output.removeChild(output.firstChild );
    }


    database.ref("users/" + e.id).on("child_added", (data) => {
        prevTask = prevTask.finally(async () => {
            const v = data.val();
            const k = data.key;


            // load message
            if(v.uid == my_id && v.emessage == "yes"){

                let str='';

                str += '<div class="my-message d-flex flex-column position-relative w-100 mt-5 bg-danger auto">';
                str += '<div class="d-flex flex-row position-relative m-3">';
                str += '<p class="my-message-date position-relative m-3">' + v.senddate + '</p>';
                str += '<img src="' + v.icon + '" class="my-message-icon ml-3 position-absolute"></div>';
                str += '<p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">' + v.message + '</p></div>';
                output.innerHTML += str;
            }else if(v.uid != my_id && v.emessage == "yes") {

                let str='';

                str += '<div class="opponent-message d-flex flex-column position-relative w-100 mt-5 bg-primary h-auto">';
                str += '<div class="d-flex flex-row position-relative m-3">';
                str += '<p class="my-message-date position-relative m-3">' + v.senddate + '</p>'
                str += '<img src="' + v.icon + '" class="my-message-icon ml-3 position-absolute"></div>';
                str += '<p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">' + v.message + '</p>';                
                output.innerHTML += str;
            }
            
            // load file
            if(v.efile == "yes"){

                await pathReference.child(v.isfile).getDownloadURL().then(function (url) {

                    if(v.uid == my_id){

                        let str='';

                        str += '<div class="my-message d-flex flex-column position-relative w-100 mt-5 bg-danger auto">';
                        str += '<div class="d-flex flex-row position-relative m-3">';
                        str += '<p class="my-message-date position-relative m-3">' + v.senddate + '</p>';
                        str += '<img src="' + v.icon + '" class="my-message-icon ml-3 position-absolute"></div>';
                        str += '<p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg"><a href=' + url + '><img id="file-message" src=' + url + ' target="_blank" rel="noopener noreferrer"></a></p></div>';
                    
                        output.innerHTML += str;

                    }else if(v.uid != my_id) {

                        let str='';

                        str += '<div class="opponent-message d-flex flex-column position-relative w-100 mt-5 bg-primary h-auto">';
                        str += '<div class="d-flex flex-row position-relative m-3">';
                        str += '<p class="my-message-date position-relative m-3">' + v.senddate + '</p>'
                        str += '<img src="' + v.icon + '" class="my-message-icon ml-3 position-absolute"></div>';
                        str += '<p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg"><a href=' + url + '><img id="file-message" src=' + url + ' target="_blank" rel="noopener noreferrer"></a></p></div>';
                        
                        output.innerHTML += str;
                    }
                });
            }
        });
    });


}

//textarea change value
function sendtextCahnge(e){

    let button = document.getElementById("send-button");
    let send_file = document.getElementById("send-file");

    if(e.value == '' && send_file.files.length <= 0){
        button.disabled = true;
        button.style.backgroundColor = 'gray';
    }else {
        button.disabled = false;
        button.style.backgroundColor = '#428bca';
    }
}

//file change value
function sendfilechange(e){

    let button = document.getElementById("send-button");
    let send_text = document.getElementById("send-text");

    if(send_text.value == '' && e.files.length <= 0){
        button.disabled = true;
        button.style.backgroundColor = 'gray';
    }else {
        button.disabled = false;
        button.style.backgroundColor = '#428bca';
    }
}


