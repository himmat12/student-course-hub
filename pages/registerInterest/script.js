const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;


// program description elements
const courseInfo = document.querySelector('.course-info');
const title = document.getElementById('title');
const level = document.getElementById('level');
const programLeader = document.getElementById('programLeader');
const description = document.getElementById('description');


// form fields elements
// const programmeID = document.getElementById('programmeID'); // might get changed with the localstorage stored id from programmes list page 
const fullName = document.getElementById('fullName');
const email = document.getElementById('email');
const terms = document.getElementById('terms');
const msgBox = document.querySelector('.message-box');
const programID = localStorage.getItem('programID');

document.addEventListener('DOMContentLoaded', (e) => {


    // loading th selected program description
    getProgramDetails(programID);

    document.getElementById('registerBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevents form submission for validation check

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Full Name Validation
        if (fullName.value === "") {
            showMsgBox("Please enter your full name.");
        }
        // Email Validation
        else if (!email.value.match(emailPattern)) {
            showMsgBox("Please enter a valid email address.");
        }
        // Terms & Conditions Validation
        else if (!terms.checked) {
            showMsgBox("You have to agree to the Terms & Conditions to proceed further.");
        } else {
            registerInterest();
        }


    });

});

// helper function to get program detail
function getProgramDetails(id) {

    const url = `${BASE_URL}/apis/programme.php?id=${id}`;

    try {
        fetch(url).then((response) => response.json().then((json) => {

            const program = json.data;

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {
                title.textContent = program.ProgramName;
                level.textContent = program.Level;
                programLeader.textContent = `${program.ProgramLeader} (Program Leader)`;
                description.textContent = program.Description;
            } else {
                showMsgBox(`Error: ${result.message}`);
                courseInfo.innerHTML = `<h2>No data.</h2>`;
            }
        }));



    } catch (error) {
        console.error('Error:', error);
    }
}



// helper function to register interest from frontend to database with api
function registerInterest() {

    const url = `${BASE_URL}/apis/register-interest.php`;

    const formData = {
        ProgrammeID: programID,
        StudentName: fullName.value,
        Email: email.value
    };

    try {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        }).then((response) => response.json().then((result) => {

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {
                showMsgBox(`Success: ${result.message}`);

                // Clear form on success
                document.getElementById('registerForm').reset();
            } else {
                showMsgBox(`Error: ${result.message}`);

            }
        }));



    } catch (error) {
        console.error('Error:', error);
    }


}


// helper function to show error box with custommessage
function showMsgBox(msg) {
    msgBox.style.display = 'block';
    msgBox.textContent = msg;
    setTimeout(() => {
        msgBox.style.display = 'none';
    }, 3000);
}

// clear form felds
function resetForm() {
    fullName.textContent = "";
    email.textContent = "";
    terms.textContent = false;
}