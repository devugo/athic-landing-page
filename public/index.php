<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATHIC - Sport App</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/main.css">
    <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
    <script src="public/js/axios.min.js"></script>
</head>
<body>
    <div class="alert-success hide" id="alert-success">
        <span id="x" onclick="removeSuccess()" class="x">X</span>
        <p>User created successfully!</p>
    </div>
    <section class="add-user">
        <div class="form">
            <div class="form-content devugo-card">
                <div class="form-content__errors">
                    <ul class="errors hide" id="errors">

                    </ul>
                </div>
                <div class="form-content__title">
                    <p>REGISTER</p>
                </div>
                <div class="form-content__form">
                    <form action="/subscribe" id="regForm">
                        <div class="field">
                            <label for="email">Email</label>
                            <input required type="email" name="email" id="email" autocomplete="off">
                        </div>
                        <input class="btn" type="submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    document.getElementById("regForm").addEventListener("submit", submitForm);
    
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
            errors.innerHTML = '';
            errors.classList.add("hide");
            document.getElementById('alert-success').classList.remove('hide');
            setTimeout(() => {
                document.getElementById('alert-success').classList.add('slide');
            }, 1000);
        })
        .catch(function (error) {
            console.log(error.response);
            errors.innerHTML = '';
            errors.classList.add("hide");
            document.getElementById('alert-success').classList.add('hide');
            if(error.response.status === 403){

                errors.classList.remove('hide');
                let errorData = error.response.data;
                errorData.map((data) => {
                    var node = document.createElement("LI");
                    var textnode = document.createTextNode(data);
                    node.appendChild(textnode);
                    errors.appendChild(node);
                })
            }
            
        });
    }
   
</script>
</html>