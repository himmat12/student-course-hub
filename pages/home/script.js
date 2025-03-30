
const UG_PROGRAM = 'undergraduate';
const PG_PROGRAM = 'postgraduate';
const ALL_PROGRAM = 'all';

const ugProgram = document.getElementById('ugProgram');
const pgProgram = document.getElementById('pgProgram');



document.addEventListener('DOMContentLoaded', () => {

    // search field elements
    const searchForm = document.getElementById('searchForm');
    const searchField = document.getElementById('searchField');
    const programLevel = document.getElementById('programLevel');
    const searchBtn = document.querySelector('.search-button');

    //  program categories section logics
    ugProgram.addEventListener('click', () => {
        localStorage.setItem('selectedProgram', UG_PROGRAM);
        window.location.href = "/web-project-the-a-team/pages/pragram-page/";
    });

    pgProgram.addEventListener('click', () => {
        localStorage.setItem('selectedProgram', PG_PROGRAM);
        window.location.href = "/web-project-the-a-team/pages/pragram-page/";
    });


    searchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        // validating the search field
        if (searchField.value !== "") {


            localStorage.setItem('searchField', searchField.value);
            localStorage.setItem('searchLevelField', programLevel.value);

            window.location.href = "/web-project-the-a-team/pages/pragram-page";

        } else {
            alert("Search field should not be empty.");
        }

    });

});

