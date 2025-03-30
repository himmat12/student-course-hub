const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;

// dom elements
const moduleHeader = document.querySelector('.module-header');

const moduleTitle = document.getElementById('moduleTitle');
const description = document.getElementById('description');
const moduleLeader = document.getElementById('moduleLeader');


// retriving module id from localstorage
const moduleID = localStorage.getItem('moduleID');


document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();


    getModuleDetails(moduleID);
    fetchSharedProgrammes(moduleID);
});


// helper function to get module detail
function getModuleDetails(id) {

    const url = `${BASE_URL}/apis/module.php?id=${id}`;

    try {
        fetch(url).then((response) => response.json().then((json) => {

            const module = json.data;

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {
                moduleTitle.textContent = module.ModuleName;
                description.textContent = module.Description;
                moduleLeader.textContent = `${module.ModuleLeader} (Module Leader)`;
            } else {
                moduleHeader.innerHTML = `<div>No data.</div>`;
            }
        }));

    } catch (error) {
        console.error('Error:', error);
    }
}


// Function to fetch programmes sharing the module
async function fetchSharedProgrammes(id) {
    // alert(id);

    const pragramGrid = document.querySelector('.program-grid');

    const url = `${BASE_URL}/apis/module-programmes.php?id=${id}`;

    try {


        fetch(url).then((response) => response.json().then((json) => {

            const programmes = json.data;

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {

                for (const program of programmes) {
                    createProgramCard(program.ProgramName, program.ProgramLeader, program.Description, program.ProgrammeID, program.ModuleID);
                }
            } else {
                pragramGrid.innerHTML = `<div>No data.</div>`;
            }
        }));
    } catch (error) {
        console.error('Error fetching shared programmes:', error);
        document.getElementById('shared-programmes').innerHTML = '<p>Failed to load shared programmes.</p>';
    }
}

// helper function to create the program card item
function createProgramCard(title, programLeader, description, programID, moduleID) {
    // Remove the dot from class names when adding classes
    const programGrid = document.querySelector('.program-grid');

    const programCard = document.createElement('div');
    programCard.classList.add('program-card');

    const programContent = document.createElement('div');
    programContent.classList.add('program-content');

    const programTitle = document.createElement('h3');
    const programLead = document.createElement('p');
    const programDescription = document.createElement('p');
    programLead.classList.add('programLeadTxt');
    programLead.style.fontWeight = "700";

    // Set attributes and classes correctly
    programTitle.id = 'programTitle';
    programLead.classList.add('program-lead');
    programDescription.classList.add('program-description');

    const programActions = document.createElement('div');
    const registerBtn = document.createElement('button');
    programActions.classList.add('program-action');
    registerBtn.classList.add('btn-register');

    // Set content
    registerBtn.textContent = "Register Interest";
    programTitle.textContent = title;
    programLead.textContent = programLeader + " (Programme Leader)";
    programDescription.textContent = description;

    // Append elements
    programContent.append(programTitle, programLead, programDescription);
    programActions.append(registerBtn);

    programCard.append(programContent, programActions);
    programGrid.append(programCard);

    // event listener for register button
    registerBtn.addEventListener('click', () => {
        localStorage.setItem('programID', programID);
        window.location.href = "/web-project-the-a-team/pages/registerInterest";
    });

    // program content event handler
    programContent.addEventListener('click', () => {
        localStorage.setItem('moduleID', moduleID);
        window.location.href = "/web-project-the-a-team/pages/program-desc";
    });
}