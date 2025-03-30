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

    getModulesList(userID);
    
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
function getModulesList(id) {

    const url = `${BASE_URL}/apis/staff/modules.php?id=${id}`;


    fetch(url).then((response) => response.json().then((json) => {
        // list of programmes from our api response
        const moduleList = json.data;

        // resetting the table before loading results
        table.innerHTML = `
        <tr>
                <th>Id</th>
                <th>Module Name</th>
                <th>Associated Programme</th>
                <th>Year</th>
        </tr>
`;
        if (moduleList.length === 0) {
            table.innerHTML = `
            <tr>
                <th>Id</th>
                <th>Module Name</th>
                <th>Associated Programme</th>
                <th>Year</th>
            </tr>
    
    <tr">
    No records found...
    </tr>
    `;
        } else {
            for (const module of moduleList) {
                createTableItem(module);
            }
        }

    }));


}



//  helper funciton to create table item
function createTableItem(module) {

    const tableRow = document.createElement('tr');
    tableRow.setAttribute('id', 'tableRow');

    const moduleId = document.createElement('td');
    const moduleTitle = document.createElement('td');
    const assocProgram = document.createElement('td');
    const programYear = document.createElement('td');

    moduleId.textContent = module.ModuleID;
    moduleTitle.textContent = module.ModuleName;
    assocProgram.textContent = module.AssociatedProgramme;
    programYear.textContent = "Year " + module.ProgrammeYear;

    tableRow.append(moduleId);
    tableRow.append(moduleTitle);
    tableRow.append(assocProgram);
    tableRow.append(programYear);

    table.append(tableRow);

}




