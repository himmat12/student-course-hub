const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;


document.addEventListener('DOMContentLoaded', (e) => {

    const url = `${BASE_URL}/apis/auth.php`;

    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const loginBtn = document.querySelector('.login-btn');
    const errorMsgBox = document.querySelector('.error-message');

    // retriving user type from local storage (cache)
    const usertype = localStorage.getItem('userType');

    loginBtn.addEventListener('click', (event) => {
        event.preventDefault();

        // preset user credentials for development
        // username.value = 'admin_main';
        // password.value = 'admin_secure123';

        // validating empty input fields
        if (username.value !== "" && password.value !== "") {

            // managing loading state 
            loginBtn.textContent = "Authunticating...";
            username.disabled = true;
            password.disabled = true;

            // making auth api call
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    username: username.value,
                    password: password.value,
                    usertype: usertype
                })
            }).then((response) => {

                if (!response.ok) {
                    response.json().then((json) => {
                        // console.log(username.value);
                        // console.log(password.value);
                        // console.log(usertype);
                        // console.log(json);
                        showErrorBox(json.message);
                        throw new Error(`HTTP error! Status: ${json.message}`);
                    });

                }

                // managing loading completed state 
                loginBtn.textContent = "Login";
                username.disabled = false;
                password.disabled = false;

                response.json().then((json) => {

                    // storing localstorage user login session (username value as cache)
                    localStorage.setItem(usertype, json.data.Username);

                    // storing the userID of user
                    localStorage.setItem('userID', json.data.UserID);

                    // alert(json.data.Username);
                    if (usertype === 'admin') {
                        window.location.replace(`${BASE_URL}/pages/admin/`);
                    } else if (usertype === 'staff') {
                        window.location.replace(`${BASE_URL}/pages/staff/`);
                    } else {
                        window.location.replace(`${BASE_URL}/pages/404/`);
                    }
                })
            });

        } else {
            showErrorBox("Username and password field should not be empty.");
        }


    });

    // helper function to show error box with custommessage
    function showErrorBox(msg) {
        errorMsgBox.style.display = 'block';
        errorMsgBox.textContent = msg;
        setTimeout(() => {
            errorMsgBox.style.display = 'none';
        }, 3000);
    }
});




