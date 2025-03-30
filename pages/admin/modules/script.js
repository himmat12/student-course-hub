const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;


// retriving cached user type
const usertype = localStorage.getItem('userType');
const username = localStorage.getItem(usertype);

//  programmes list table
const table = document.querySelector('table');

// search field elements
const searchField = document.getElementById('searchField');
const filterLevel = document.getElementById('searchLevelField');
const searchBtn = document.getElementById('searchBtn');

// main event listner
document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    const addProgrammeBtn = document.getElementById('addProgrammeBtn');
    const modalCloseBtn = document.querySelector('.modal-close');
    const modalCancleBtn = document.getElementById('cancleBtn');
    const modalSaveBtn = document.getElementById('saveBtn');


    addProgrammeBtn.addEventListener('click', () => showAddProgrammeModal());

    modalCloseBtn.addEventListener('click', () => closeModalOverlay());

    modalCancleBtn.addEventListener('click', () => closeModalOverlay());

    searchBtn.addEventListener('click', () => {
        searchProgrammes();
    });

    const usernameTxt = document.querySelector('.username');

    usernameTxt.textContent = username;

    // logout logic

    const logoutBtn = document.querySelector('.logout-btn');

    logoutBtn.addEventListener('click', () => {

        // clearing local storage session cache (logging out basically)
        localStorage.removeItem(usertype);

        window.location.replace(BASE_URL);
    });

    getProgrammesList();

    // retriving list of staffs for add module form
    getStaffsList();

});

//  helper function to delete program based on program id
function deleteProgram(id) {
    const url = `${BASE_URL}/apis/admin/delete-programme.php`;

    const data = { ProgrammeID: id };

    console.log(data);
    try {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        }).then((response) => response.json().then((result) => {

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {
                alert(`${result.message}`);
                window.location.reload();
            } else {
                alert(`Error: ${result.message} | Fields: ${result.fields}`);

            }
        }));



    } catch (error) {
        console.error('Error:', error);
    }


}

// function to list all programmes
function getProgrammesList() {

    const url = `${BASE_URL}/apis/admin/programmes.php`;


    fetch(url).then((response) => response.json().then((json) => {
        // list of programmes from our api response
        const programmeList = json.data;

        // resetting the table before loading results
        table.innerHTML = `
        <tr>
            <th>Id</th>
            <th>Program Name</th>
            <th>Program Leader</th>
            <th>Level</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
`;
        if (programmeList.length === 0) {
            table.innerHTML = `
            <tr>
                <th>Id</th>
                <th>Program Name</th>
                <th>Program Leader</th>
                <th>Level</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
    
    <tr">
    No records found...
    </tr>
    `;
        } else {
            for (const program of programmeList) {
                createTableItem(program);
            }
        }

    }));


}


// helper function to search feature
function searchProgrammes(query, level) {
    const searchURL = `${BASE_URL}/apis/admin/programmes.php?query=${searchField.value}&level=${filterLevel.value}`;

    fetch(searchURL).then((response) => response.json().then((json) => {

        const programmesList = json.data;

        // resetting the table before loading results
        table.innerHTML = `
        <tr>
            <th>Id</th>
            <th>Program Name</th>
            <th>Program Leader</th>
            <th>Level</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
`;

        if (programmesList.length === 0) {
            table.innerHTML = `
                    <tr>
                        <th>Id</th>
                        <th>Program Name</th>
                        <th>Program Leader</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
            
            <tr">
            No records found...
            </tr>
            `;
        } else {
            table.innerHTML = `
                    <tr>
                        <th>Id</th>
                        <th>Program Name</th>
                        <th>Program Leader</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
            `;
            for (const program of programmesList) {
                createTableItem(program);
            }

            // clearing the search field and setting the dropdown to defualt selected value
            // resetSearchFields();

        }

    }));


}

// publish/unpublish programme
function togglePublishStatus(id, status) {
    const url = `${BASE_URL}/apis/admin/publish-program.php`;

    //  status toggle logic
    const data = {
        ProgrammeID: id,
        Status: status === 1 ? 0 : 1
    };

    // console.log(data);
    try {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        }).then((response) => response.json().then((result) => {

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {
                // alert(`${result.message}`);
                window.location.reload();
            } else {
                alert(`Error: ${result.message} | Fields: ${result.fields}`);

            }
        }));

    } catch (error) {
        console.error('Error:', error);
    }

}

// helper funciton to reset search field
function resetSearchFields() {
    searchField.value = "";
    filterLevel.value = "";
}

//  helper funciton to create table item
function createTableItem(program) {

    const tableRow = document.createElement('tr');
    tableRow.setAttribute('id', 'tableRow');

    const programId = document.createElement('td');
    const programTitle = document.createElement('td');
    const programLeader = document.createElement('td');
    const programLevel = document.createElement('td');
    const programStatus = document.createElement('td');

    programId.setAttribute('id', 'programId');
    programTitle.setAttribute('id', 'programTitle');
    programLeader.setAttribute('id', 'programLeader');
    programLevel.setAttribute('id', 'programLevel');
    programStatus.setAttribute('id', 'programStatus');

    const actions = document.createElement('td');
    const editBtn = document.createElement('button');
    const moduleBtn = document.createElement('button');
    const deleteBtn = document.createElement('button');

    actions.setAttribute('class', 'actions');
    editBtn.setAttribute('id', 'editProgrammeBtn');
    moduleBtn.setAttribute('id', 'programmeModulesBtn');
    deleteBtn.setAttribute('id', 'deleteProgrammeBtn');

    editBtn.classList.add('btn');
    editBtn.classList.add('btn-primary');
    moduleBtn.classList.add('btn');
    moduleBtn.classList.add('btn-success');
    deleteBtn.classList.add('btn');
    deleteBtn.classList.add('btn-danger');

    editBtn.textContent = "Edit";
    moduleBtn.textContent = "Modules";
    deleteBtn.textContent = "Delete";

    actions.append(editBtn);
    actions.append(moduleBtn);
    actions.append(deleteBtn);

    programId.textContent = program.ProgramID;
    programTitle.textContent = program.ProgramName;
    programLeader.textContent = program.ProgramLeader;
    programLevel.textContent = program.LevelID === 1 ? "Undergraduate" : "Postgraduate";
    programStatus.innerHTML = program.Status === 1 ? `<span class="status status-published">Published</span>` : `<span class="status status-unpublished">Unpublished</span>`;

    tableRow.append(programId);
    tableRow.append(programTitle);
    tableRow.append(programLeader);
    tableRow.append(programLevel);
    tableRow.append(programStatus);
    tableRow.append(actions);

    table.append(tableRow);

    editBtn.addEventListener('click', () => showEditProgrammeModal(program));

    deleteBtn.addEventListener('click', () => {
        const isConfirmed = confirm(`Do you want to delete "${program.ProgramName}" permanently?`);
        isConfirmed ? deleteProgram(program.ProgramID) : null;
    });

    programStatus.addEventListener('click', () => {
        togglePublishStatus(program.ProgramID, program.Status);
    });

    moduleBtn.addEventListener('click', () => {
        const isAgreed = confirm("Do you agree students needed more time to finish this projrct completely?");

        isAgreed ? alert("So do we, most of us had struggled with this module. But it's all good at least you agree with us.") : alert(".");
    });
}


// get list of staffs
function getStaffsList() {
    const url = `${BASE_URL}/apis/admin/staffs.php`;

    const programmeLeaderSelect = document.getElementById('programmeLeader');

    // clearing existing options
    programmeLeaderSelect.innerHTML = '<option value="">Select Programme Leader</option>';

    // fetching staffs and populating dropdown
    fetch(url)
        .then(response => {
            // checking if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(result => {
            // checking if data exists and is an array
            if (result.data && Array.isArray(result.data)) {
                // populating dropdown with staff members
                result.data.forEach(staff => {
                    const option = document.createElement('option');
                    option.value = staff.StaffID;
                    option.textContent = `${staff.Name} (${staff.Position})`;
                    programmeLeaderSelect.appendChild(option);
                });
            } else {
                console.error('Invalid staff data format');
            }
        })
        .catch(error => {
            console.error('Error fetching staffs:', error);

            // adding error option to dropdown
            const errorOption = document.createElement('option');
            errorOption.textContent = 'Error loading staff list';
            errorOption.value = '';
            programmeLeaderSelect.appendChild(errorOption);
        });
}


//  helper function to show the add progrmme form
function showAddProgrammeModal() {
    const modalBackdrop = document.querySelector('.modal-backdrop');

    const modalHeaderTitle = document.getElementById('programmeModalTitle');
    modalHeaderTitle.textContent = "Add New Programme";

    // form input elements
    const programmeNameInput = document.getElementById('programmeName');
    const programmeLevelSelect = document.getElementById('programmeLevel');
    const programmeLeaderSelect = document.getElementById('programmeLeader');
    const programmeDescriptionTextarea = document.getElementById('programmeDescription');
    const imageUrlInput = document.getElementById('imageUrl');
    const programmeStatusSelect = document.getElementById('programmeStatus');

    programmeNameInput.value = "";
    programmeLevelSelect.value = "";
    programmeLeaderSelect.value = "";
    programmeDescriptionTextarea.value = "";
    imageUrlInput.value = "";
    programmeStatusSelect.value = "0";

    modalBackdrop.style.display = 'flex';

    // select modal control buttons
    const saveBtn = document.getElementById('saveBtn');

    // helper function to collect form data
    function collectProgrammeFormData() {
        return {
            ProgrammeName: programmeNameInput.value.trim(),
            LevelID: programmeLevelSelect.value,
            ProgrammeLeaderID: programmeLeaderSelect.value,
            Description: programmeDescriptionTextarea.value.trim(),
            Image: imageUrlInput.value.trim(),
            Status: programmeStatusSelect.value
        };
    }


    // handling form submission
    saveBtn.addEventListener('click', () => {
        const url = `${BASE_URL}/apis/admin/add-programme.php`;


        const formData = collectProgrammeFormData();

        // console.log(formData);

        // validating form data (you can add more robust validation)
        if (!formData.ProgrammeName) {
            alert('Please enter a programme name');
            return;
        } else if (!formData.LevelID) {
            alert('Please select program level');
            return;
        } else if (!formData.ProgrammeLeaderID) {
            alert('Please select program leader');
            return;
        } else if (!formData.Description) {
            alert('Please enter program description');
            return;
        }

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
                    alert(`${result.message}`);
                    // closeModalOverlay();
                    window.location.reload();
                } else {
                    alert(`Error: ${result.message} | Fields: ${result.fields}`);

                }
            }));

        } catch (error) {
            console.error('Error:', error);
        }
    });

}


//  helper function to show the add progrmme form
function showEditProgrammeModal(program) {
    const modalBackdrop = document.querySelector('.modal-backdrop');
    const modalHeaderTitle = document.getElementById('programmeModalTitle');
    const programmeName = document.getElementById('programmeName');
    const programmeLevel = document.getElementById('programmeLevel');
    const programmeLeader = document.getElementById('programmeLeader');
    const programmeDescription = document.getElementById('programmeDescription');
    const imageUrl = document.getElementById('imageUrl');
    const programmeStatus = document.getElementById('programmeStatus');

    // actions btn 
    const saveBtn = document.getElementById('saveBtn');

    modalHeaderTitle.textContent = "Edit Programme";

    //  populating program description from the program object passed from funciton parameter
    programmeName.value = program.ProgramName;
    programmeLevel.value = program.LevelID;
    programmeDescription.value = program.Description;
    programmeLeader.value = program.ProgramLeaderID;
    imageUrl.value = "";
    programmeStatus.value = program.Status;

    //  showing the form with loaded data from api
    modalBackdrop.style.display = 'flex';

    // helper function to collect form data
    function collectProgrammeFormData() {
        return {
            ProgrammeID: program.ProgramID,
            ProgrammeName: programmeName.value.trim(),
            LevelID: programmeLevel.value,
            ProgrammeLeaderID: programmeLeader.value,
            Description: programmeDescription.value.trim(),
            Image: imageUrl.value.trim(),
            Status: programmeStatus.value
        };
    }


    // handling form submission
    saveBtn.addEventListener('click', () => {
        const url = `${BASE_URL}/apis/admin/update-programme.php`;


        const formData = collectProgrammeFormData();

        // console.log(formData);

        // validating form data (you can add more robust validation)
        if (!formData.ProgrammeName) {
            alert('Please enter a programme name');
            return;
        } else if (!formData.LevelID) {
            alert('Please select program level');
            return;
        } else if (!formData.ProgrammeLeaderID) {
            alert('Please select program leader');
            return;
        } else if (!formData.Description) {
            alert('Please enter program description');
            return;
        }

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
                    alert(`${result.message}`);
                    // closeModalOverlay();
                    window.location.reload();
                } else {
                    alert(`Error: ${result.message} | Fields: ${result.fields}`);

                }
            }));

        } catch (error) {
            console.error('Error:', error);
        }
    });
}

//  helper function to close the form
function closeModalOverlay() {
    document.querySelector('.modal-backdrop').style.display = "none";
}