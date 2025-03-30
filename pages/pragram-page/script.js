const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;

const UG_PROGRAM = 'undergraduate';
const PG_PROGRAM = 'postgraduate';
const ALL_PROGRAM = 'all';

const programmesURL = `${BASE_URL}/apis/programmes.php`;

const selectedProgram = localStorage.getItem('selectedProgram');

// this variables are set when the user clicks search btn from anywhere other then programmes list page
const searchFieldVal = localStorage.getItem('searchField');
const searchLevelField = localStorage.getItem('searchLevelField');

const programContainer = document.querySelector('.course-container');
const programHeader = document.querySelector('.programmes-header');

// search field elements
const searchForm = document.getElementById('searchForm');
const searchField = document.getElementById('searchField');
const programLevel = document.getElementById('programLevel');
const searchBtn = document.querySelector('.search-button');

// programmes list header
// const programmesListHeader = document.getElementById('programmesHeader');


window.onload = () => {
    const selectedProgram = localStorage.getItem('selectedProgram');

    // logic for search in home
    if (searchFieldVal !== null) {

        searchField.value = searchFieldVal;
        programLevel.value = searchLevelField;

        searchProgrammes();

        // resetting the local cached value form home search field after each search operation
        localStorage.removeItem('searchField');
        localStorage.removeItem('searchLevelField');
    } else {

        // loading prograammes list based on id and if not id then default
        if (selectedProgram === UG_PROGRAM) {
            getFilteredProgrammes(1);
        } else if (selectedProgram === PG_PROGRAM) {
            getFilteredProgrammes(2);
        } else {
            getProgrammesList();
        }


    }

}


searchBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // validating the search field
    if (searchField.value !== "") {
        searchProgrammes();
    } else {
        alert("Search field should not be empty.");
    }
});



// helper function to search feature
function searchProgrammes() {

    const searchURL = `${BASE_URL}/apis/programmes.php?query=${searchField.value}&level=${programLevel.value}`;

    fetch(searchURL).then((response) => response.json().then((json) => {

        const programmesList = json.data;

        programContainer.innerHTML = ``;

        if (programmesList.length === 0) {
            programContainer.innerHTML = `
            <div class="course-item">
            No records found...
            </div>
            `;
        } else {
            for (const program of programmesList) {
                createMenuItem(program);
            }

            // clearing the search field and setting the dropdown to defualt selected value
            // searchForm.reset();

        }

    }));


}


// function to retrive programmes list data from api (backend) and populate it into our course container (div)
function getProgrammesList() {


    programContainer.innerHTML = `  
    <div class="course-item">
    Loading...
    </div>
    `;

    fetch(programmesURL).then((response) => response.json().then((json) => {
        // list of programmes from our api response
        const programmeList = json.data;

        // resetting the loading text with blank empty space in html document (screen)
        programContainer.innerHTML = ``;

        for (const program of programmeList) {
            createMenuItem(program);
        }


    }));
}

// helper function to get filtered programmes list based on level id
function getFilteredProgrammes(id) {

    const searchURL = `${BASE_URL}/apis/programmes.php?query=&level=${id}`;


    programContainer.innerHTML = `  
        <div class="course-item">
        Loading...
        </div>
        `;

    fetch(searchURL).then((response) => response.json().then((json) => {
        // list of programmes from our api response
        const programmeList = json.data;

        // resetting the loading text with blank empty space in html document (screen)
        programContainer.innerHTML = ``;

        for (const program of programmeList) {
            createMenuItem(program);
        }


    }));

}

// helper function to create menu item
function createMenuItem(program) {
    const courseItem = document.createElement('div');
    const courseDetails = document.createElement('div');
    const courseHeader = document.createElement('h3');
    const courseLevel = document.createElement('p');
    const courseDescription = document.createElement('p');
    const registerBtn = document.createElement('button');

    courseItem.classList.add('course-item');
    courseDetails.classList.add('course-details');
    courseLevel.classList.add('course-type');
    courseDescription.classList.add('course-description');
    registerBtn.classList.add('register-button');

    registerBtn.textContent = "Register Interest";

    courseHeader.textContent = program.ProgrammeName;
    courseLevel.textContent = program.LevelID === 1 ? 'Undergraduate' : 'Postgraduate';
    courseDescription.textContent = program.Description;


    courseDetails.append(courseHeader);
    courseDetails.append(courseLevel);
    courseDetails.append(courseDescription);

    courseItem.append(courseDetails);
    courseItem.append(registerBtn);

    programContainer.append(courseItem);

    registerBtn.addEventListener('click', () => {
        // alert(program.ProgrammeID);
        localStorage.setItem('programID', program.ProgrammeID);
        window.location.href = "/web-project-the-a-team/pages/registerInterest";
    });


    courseHeader.addEventListener('click', () => {
        localStorage.setItem('programID', program.ProgrammeID);
        window.location.href = "/web-project-the-a-team/pages/program-desc";
    });

}




