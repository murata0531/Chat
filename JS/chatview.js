
document.getElementById("send-button").onclick = function() {
    
    let send_text = document.getElementById("send-text");
    let output = document.getElementById('output');

    alert(send_text.value);
    const database = firebase.database();

    let now = new Date();
    let room = 1;
    database.ref(1).push({
        uid: 1,
        icon: "aikon",
        name: "name",
        message: send_text.value,
        isfile: 'nothing',
        date: now.getFullYear() + '年' + eval(now.getMonth() + 1) + '月' + now.getDate() + '日' + now.getHours() + '時' + now.getMinutes() + '分'
    });
    alert("d");

    axios.post('http://localhost/Chat/api/Write.php', {
            
        posttest:id,
        
    })
    .then(function (response) {
        alert(output);

        output.innerHTML = "<div>a</div>";
    })
    .catch(function(error){
        alert(error);
    });
};

// user-list click

function user_click(e){
    // let user_id = e.id;
    let title = document.getElementById('chat-header-title');
    title.innerHTML = e.textContent;
}



