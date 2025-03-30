const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;


// retriving cached user type
const usertype = localStorage.getItem('userType');
const username = localStorage.getItem(usertype);

// retriving user id from local storage
const userID = localStorage.getItem('userID');

//  programmes list table
const table = document.querySelector('table');

// search field elements
const searchField = document.getElementById('searchField');
const filterLevel = document.getElementById('searchLevelField');
const searchBtn = document.getElementById('searchBtn');

// main event listner
document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    getProgrammesList(userID);

    const usernameTxt = document.querySelector('.username');

    usernameTxt.textContent = username;

    // logout logic

    const logoutBtn = document.querySelector('.logout-btn');

    logoutBtn.addEventListener('click', () => {

        // clearing local storage session cache (logging out basically)
        localStorage.removeItem(usertype);

        window.location.replace(BASE_URL);
    });


});

// function to list all programmes
function getProgrammesList(id) {

    const url = `${BASE_URL}/apis/staff/programmes.php?id=${id}`;


    fetch(url).then((response) => response.json().then((json) => {
        // list of programmes from our api response
        const programmeList = json.data;

        // resetting the table before loading results
        table.innerHTML = `
        <tr>
            <th>Id</th>
            <th>Program Name</th>
            <th>Level</th>
            <th>Status</th>
            <th>Role</th>
        </tr>
`;
        if (programmeList.length === 0) {
            table.innerHTML = `
            <tr>
                <th>Id</th>
                <th>Program Name</th>
                <th>Level</th>
                <th>Status</th>
                <th>Role</th>
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



//  helper funciton to create table item
function createTableItem(program) {

    const tableRow = document.createElement('tr');
    tableRow.setAttribute('id', 'tableRow');

    const programId = document.createElement('td');
    const programTitle = document.createElement('td');
    const programLevel = document.createElement('td');
    const role = document.createElement('td');
    const programStatus = document.createElement('td');

    programId.textContent = program.ProgrammeID;
    programTitle.textContent = program.ProgrammeName;
    programLevel.textContent = program.LevelID === 1 ? "Undergraduate" : "Postgraduate";
    programStatus.innerHTML = program.Status === 1 ? `<span class="status status-published">Published</span>` : `<span class="status status-unpublished">Unpublished</span>`;
    role.textContent = program.AssignmentType;

    tableRow.append(programId);
    tableRow.append(programTitle);
    tableRow.append(programLevel);
    tableRow.append(programStatus);
    tableRow.append(role);

    table.append(tableRow);

}




