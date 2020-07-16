// Add event listeners to both top and bottom form on submit
document.getElementById("subscription-form").addEventListener("submit", (e) => submitForm(e, 'email'));
document.getElementById("subscription-form-2").addEventListener("submit", (e) => submitForm(e, 'email-2'));

/**
 * Function to make post request on either forms submit
 * 
 * @param {*event} e 
 * @param {*string} id 
 */
function submitForm(e, id) {
    e.preventDefault();
   addLoader(id, true);

    let email = document.getElementById(id).value;

    //  Make a post request
    axios.post('/subscribe', {
        email: email
    })
    .then(function (response) {
        console.log(response);
        if(response.status === 201){
            setTimeout(() => {
                showSuccess();
                clearInput(id);
                addLoader(id, false);
            }, 1000);
        }
    })
    .catch(function (error) {
        console.log(error.response);
      
        if(error.response.status === 403){
            showError('warning', error.response.data[0]);
        }else{
            showError('error', 'Something went wrong');
        }
        addLoader(id, false);
        
    });
}

/**
 * Show error if any on form submit
 * 
 * @param {*string} type 
 * @param {*} value 
 */
function showError(type, value){
    return swal({
        title: type === 'warning' ? "Oops!" : "Error",
        text: value,
        icon: type,
        button: "Continue",
    });
}

/**
 * Show success if form was submitted successfully
 */
function showSuccess(){
    return swal({
        title: "Success",
        text: "You were subscribed successfully!",
        icon: "success",
        button: "Continue",
    });
}

/**
 * Clear input value after a successfull form submission
 * 
 * @param {*string} id 
 */
function clearInput(id){
    document.getElementById(id).value = '';
}

/**
 * 
 * @param {*string} id 
 * @param {*boolean} status 
 */
function addLoader(id, status){
    if(status){
        return id === 'email' ? 
            document.getElementById('submit').innerHTML = 'Submitting...  <i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>' : 
            document.getElementById('submit-2').innerHTML = 'Submitting...  <i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>'
    }else {
        return id === 'email' ? 
            document.getElementById('submit').innerText = 'Notify Me' : 
            document.getElementById('submit-2').innerHTML = 'Notify Me'
    }
    
}