const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;

// retriving program id from local strage
const programmeId = localStorage.getItem('programID');

//  html elements
const curriculumYear = document.querySelector('.curriculum-years');
const courseIntro = document.querySelector('.course-intro');

const title = document.getElementById('title');
const level = document.getElementById('level');
const description = document.getElementById('description');
const programLeader = document.getElementById('programLeader');

const registerBtn = document.querySelector('.register-button');


document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();
    getProgramDetails(programmeId);
    fetchModules(programmeId);

    //  register interest btn event handler
    registerBtn.addEventListener('click', () => {
        localStorage.setItem('programID', programmeId);
        window.location.href = "/web-project-the-a-team/pages/registerInterest";
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
                level.textContent = program.Level + " Program";
                programLeader.textContent = `${program.ProgramLeader} (Program Leader)`;
                description.textContent = program.Description;
            } else {
                courseIntro.innerHTML = `<div>No data.</div>`;
            }
        }));

    } catch (error) {
        console.error('Error:', error);
    }
}

// Fetch modules for each year
async function fetchModules(id) {

    const url = `${BASE_URL}/apis/modules.php?id=${id}`;
    try {
        fetch(url).then((response) => response.json().then((json) => {

            const modules = json.data;

            // checking http status code 200 and 201 for successful requt and response with http 
            if (response.status === 201 || response.status === 200) {

                // Group modules by year and update the DOM
                const year1Modules = modules.filter(module => module.Year === 1);
                const year2Modules = modules.filter(module => module.Year === 2);
                const year3Modules = modules.filter(module => module.Year === 3);

                // console.log(id);

                // console.log(response.status);

                // console.log(json);

                // console.log(modules);


                // console.log(year1Modules);
                // console.log(year2Modules);
                // console.log(year3Modules);

                //  dom objects
                const year1ModulesList = document.getElementById('year1-modules');
                const year2ModulesList = document.getElementById('year2-modules');
                const year3ModulesList = document.getElementById('year3-modules');

                if (year1Modules.length === 0) {
                    year1ModulesList.innerHTML = `<div>To be announched...</div>`;
                }
                if (year2Modules.length === 0) {
                    year2ModulesList.innerHTML = `<div>To be announched...</div>`;
                }
                if (year3Modules.length === 0) {
                    year3ModulesList.innerHTML = `<div>To be announched...</div>`;
                }

                for (const module of year1Modules) {
                    // alert(module.ModuleName + ' ' + module.Year);

                    const curriculumItem = document.createElement('div');
                    curriculumItem.classList.add('curriculum-item');
                    curriculumItem.textContent = module.ModuleName;
                    year1ModulesList.append(curriculumItem);

                    curriculumItem.addEventListener('click', () => {
                        localStorage.setItem('moduleID', module.ModuleId);
                        window.location.href = "/web-project-the-a-team/pages/module-desc";
                    });
                }

                for (const module of year2Modules) {
                    // alert(module.ModuleName + ' ' + module.Year);

                    const curriculumItem = document.createElement('div');
                    curriculumItem.classList.add('curriculum-item');
                    curriculumItem.textContent = module.ModuleName;
                    year2ModulesList.append(curriculumItem);

                    curriculumItem.addEventListener('click', () => {
                        localStorage.setItem('moduleID', module.ModuleId);
                        window.location.href = "/web-project-the-a-team/pages/module-desc";
                    });

                }

                for (const module of year3Modules) {
                    // alert(module.ModuleName + ' ' + module.Year);

                    const curriculumItem = document.createElement('div');
                    curriculumItem.classList.add('curriculum-item');
                    curriculumItem.textContent = module.ModuleName;
                    year3ModulesList.append(curriculumItem);

                    curriculumItem.addEventListener('click', () => {
                        localStorage.setItem('moduleID', module.ModuleId);
                        window.location.href = "/web-project-the-a-team/pages/module-desc";
                    });

                }


            } else {
                curriculumYear.innerHTML = `<div>No data.</div>`;
            }

        }));


    } catch (error) {
        console.error('Error fetching modules:', error);
    }
}

