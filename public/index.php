<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATHIC</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link href="public/css/aos.min.css" rel="stylesheet">
    <link href="public/css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>
    <section class="banner">
        <div class="content">
            <div class="content-text text-center">
                <h2>Welcome to Athic</h2>
                <p>The game changer for professionals<br />
                    and budding sport enthusiasts.
                </p>
            </div>
            <img class="banner-cloud banner-cloud-1" src="public/img/banner-cloud-1.png" />
            <img class="banner-cloud banner-cloud-2" src="public/img/banner-cloud-2.png" />
            <img class="banner-cloud banner-cloud-3" src="public/img/banner-cloud-3.png" />
        </div>
    </section>
    <section>
        <div class="container">
            <div class="content">
                <div class="form">
                    <form id="subscription-form">
                        <input placeholder="Enter a valid email address" name="subscribe" id="email" />
                        <button type="submit">Notify Me</button>
                    </form>
                </div>
                <div class="mobile-stores">
                    <div class="appstore">

                    </div>
                    <div class="playstore">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <div class="content">
                <div class="section-title">
                    <h3>How it works</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="col-content">
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="col-content">
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="col-content">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="app-screens">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="col-content">

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="col-content">
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="col-content">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="col-content">

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="col-content">
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="col-content">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bottom-subscribe">
        <div class="container">
            <div class="content">
                <div class="section-title">
                    <h3>Be among the first to try our app</h3>
                </div>
                <div class="form">
                    <!-- <form>
                        <input placeholder="Enter a valid email address" name="email" />
                        <button>Notify Me</button>
                    </form> -->
                </div>
            </div>
        </div>
    </section>

    <script src="public/js/popper.min.js"></script>
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/axios.min.js"></script>
    <script src="public/js/sweetalert.min.js"></script>

    <script src="public/js/aos.min.js"></script>
</body>
<script>
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
   
</script>
</html>