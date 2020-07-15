document.getElementById("subscription-form").addEventListener("submit", submitForm);
    
function removeSuccess() {
    document.getElementById('alert-success').classList.add('hide');
    document.getElementById('alert-success').classList.remove('slide');
}
function submitForm(e) {
    e.preventDefault();
    let email = document.getElementById('email').value;
    // console.log(firstname, lastname, email, password_again, password);
    
    let errorsNode = document.getElementById("errors");

    axios.post('/subscribe', {
        email: email
    })
    .then(function (response) {
        console.log(response);
        // errors.innerHTML = '';
        // errors.classList.add("hide");
        // document.getElementById('alert-success').classList.remove('hide');
        setTimeout(() => {
            // document.getElementById('alert-success').classList.add('slide')
            swal({
                title: "Success",
                text: "You were subscribed successfully!",
                icon: "success",
                button: "Continue",
            });
        }, 1000);
    })
    .catch(function (error) {
        console.log(error.response);
        // errors.innerHTML = '';
        // errors.classList.add("hide");
        // document.getElementById('alert-success').classList.add('hide');
        if(error.response.status === 403){

            // errors.classList.remove('hide');
            // let errorData = error.response.data;
            swal({
                title: "Oops!",
                text: error.response.data[0],
                icon: "warning",
                button: "Continue",
            });
            // errorData.map((data) => {
            //     var node = document.createElement("LI");
            //     var textnode = document.createTextNode(data);
            //     node.appendChild(textnode);
            //     errors.appendChild(node);
            // })
        }else{
            swal({
                title: "Error",
                text: "Something went wrong",
                icon: "error",
                button: "Continue",
            });
        }
        
    });
}