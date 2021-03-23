//button click event
document.getElementById("send-button").onclick = function() {
    

    let send_text = document.getElementById("send-text");
    let send_image = document.getElementById("send-image");
    let output = document.getElementById('output');

    const database = firebase.database();
    let title = document.getElementsByClassName('chat-header-title');
    let room_id = title[0].id;
    let now = new Date();

    database.ref(room_id).push({
        uid: my_id,
        icon: my_icon,
        name: my_name,
        message: send_text.value,
        isfile: 'nothing',
        date: now.getFullYear() + '/' + eval(now.getMonth() + 1) + '/' + now.getDate() + '/' + now.getHours() + ':' + now.getMinutes()
    });
    alert("d");

    // axios.post('http://localhost/Chat/api/Write.php', {
            
    //     posttest:id,
        
    // })
    // .then(function (response) {
    //     alert(output);

    //     output.innerHTML = "<div>a</div>";
    // })
    // .catch(function(error){
    //     alert(error);
    // });
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

