
// Author: Himmat Rai
// Purpose: A sample code implementation to make an api call and manupulate DOM with JS.

// const programmesURL = "http://localhost:6789/web-project-the-a-team/apis/programmes.php";
const programmesURL = "http://localhost/web-project-the-a-team/apis/programmes.php";

const programmesListContainer = document.querySelector('.programmes-list');
const searchField = document.getElementById('search-field');
const searchBtn = document.getElementById('search-btn');
const levelField = document.getElementById('level-field');

document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    searchBtn.addEventListener('click', () => {
        // const searchURL = `http://localhost:6789/web-project-the-a-team/apis/programmes.php?query=${searchField.value}&level=${levelField.value}`;
        const searchURL = `http://localhost/web-project-the-a-team/apis/programmes.php?query=${searchField.value}&level=${levelField.value}`;

        const url = searchField.value === "" ? programmesURL : searchURL;

        fetch(url).then((response) => response.json().then((json) => {

            const programmesList = json.data;

            programmesListContainer.innerHTML = ``;

            if (programmesList.length === 0) {
                programmesListContainer.innerHTML = `
            <h1>No records found...</h1>`;
            } else {
                for (const program of programmesList) {
                    programmesListContainer.innerHTML += `
                <h1>${program.ProgrammeName}</h1>
                `;
                }
            }

        }));

    });

    fetch(programmesURL).then((response) => response.json().then((json) => {

        const programmesList = json.data;

        programmesListContainer.innerHTML = ``;

        if (programmesList.length === 0) {
            programmesListContainer.innerHTML = `
        <h1>No records found...</h1>`;
        } else {
            for (const program of programmesList) {
                programmesListContainer.innerHTML += `
            <h1>${program.ProgrammeName}</h1>
            `;
            }
        }

    }));

});
