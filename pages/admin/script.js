const BASE_URL = `http://localhost/web-project-the-a-team`;
// const BASE_URL = `http://localhost:6789/web-project-the-a-team`;


// retriving cached user type
const usertype = localStorage.getItem('userType');
const username = localStorage.getItem(usertype);

const url = `${BASE_URL}/apis/admin-stats.php`;

const gridViewList = document.querySelector('.gridview-list');

const programCard = document.querySelector('#programme-card');
const moduleCard = document.querySelector('#module-card');
const staffCard = document.querySelector('#staff-card');
const studentCard = document.querySelector('#student-card');



function getAdminStatsData() {
    programCard.innerHTML = `
        Total Programmes
    <div class="digit-text"> - </div>
    <div class="subtitle">Loading...</div>
        `;

    moduleCard.innerHTML = `
    Total Modules
    <div class="digit-text"> - </div>
    <div class="subtitle">Loading...</div>
    `;

    staffCard.innerHTML = `
    Staff Members
    <div class="digit-text"> - </div>
    <div class="subtitle">Loading...</div>
    `;

    studentCard.innerHTML = `
    Interested Students
    <div class="digit-text"> - </div>
    <div class="subtitle">Loading...</div>
    `;


    try {
        fetch(url).then((response) => {

            if (!response.ok) {
                programCard.innerHTML = `
                    Total Programmes
                <div class="digit-text"> - </div>
                <div class="subtitle">No Data</div>
                    `;

                moduleCard.innerHTML = `
                Total Modules
                <div class="digit-text"> - </div>
                <div class="subtitle">No Data</div>
                `;

                staffCard.innerHTML = `
                Staff Members
                <div class="digit-text"> - </div>
                <div class="subtitle">No Data</div>
                `;

                studentCard.innerHTML = `
                Interested Students
                <div class="digit-text"> - </div>
                <div class="subtitle">No Data</div>
                `;
            }

            response.json().then((json) => {

                const data = json.data;
                const programmes = data.Programmes;
                const modules = data.Modules;
                const staffs = data.Staffs;
                const students = data.Students;

                programCard.innerHTML = `
                Total Programmes
                <div class="digit-text">${programmes.Total}</div>
                <div class="subtitle">${programmes.TotalUG} UG, ${programmes.TotalPG} PG</div>
                `;

                moduleCard.innerHTML = `
            Total Modules
            <div class="digit-text">${modules.Total}</div>
            <div class="subtitle">${modules.TotalUG} UG, ${modules.TotalPG} PG</div>
            `;

                staffCard.innerHTML = `
            Staff Members
            <div class="digit-text">${staffs.Total}</div>
            <div class="subtitle">${staffs.TotalSeinorProf} Sr Prof, ${staffs.TotalProf} Prof, ${staffs.TotalAssocProf} Asc Prof, ${staffs.TotalAssistProf} Ast Prof</div>
            `;

                studentCard.innerHTML = `
            Interested Students
            <div class="digit-text">${students.Total}</div>
            <div class="subtitle">Last 30 days</div>
            `;


            });
        });
    } catch (error) {

    }
}

document.addEventListener('DOMContentLoaded', (e) => {


    const usernameTxt = document.querySelector('.username');

    usernameTxt.textContent = username;

    // logout logic

    const logoutBtn = document.querySelector('.logout-btn');

    logoutBtn.addEventListener('click', () => {

        // clearing local storage session cache (logging out basically)
        localStorage.removeItem(usertype);

        window.location.replace(BASE_URL);
    });
    // ///////////////////////////////////////////////////////////////////////////////////
});

window.onload = () => {
    getAdminStatsData();
}