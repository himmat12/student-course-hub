<section class="main-section" id="programmes-section">

    <!-- header section -->
    <?php
    include '../components/header.php';
    ?>

    <!-- main content -->

    <div class="main-content">

        <div class="content-wrapper">
            <div class="header-ribbon">
                <div class="header-text">All Modules</div>
                <!-- <input id="addProgrammeBtn" class="btn btn-primary" type="button" value="+ Add New Module"> -->
                <input id="addModuleBtn" class="btn btn-primary" type="button" value="+ Add New Module">
            </div>

            <!-- card header with search and actions -->
            <div class="search-section">
                <div class="search">
                    <!-- <input id="searchField" type="text" placeholder="Search modules by name..."> -->
                    <input id="" type="text" placeholder="Search modules by name...">
                </div>

                <!-- <div class="filter">
                    <select id="searchLevelField">
                        <option value="">All Levels</option>
                        <option value="1">Undergraduate</option>
                        <option value="2">Postgraduate</option>
                    </select>
                </div> -->

                <!-- <input id="searchBtn" class="btn btn-light search-btn" type="button" value="Search"> -->
                <input id="" class="btn btn-light search-btn" type="button" value="Search">
            </div>

            <!-- table container -->
            <div class="table-container">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Module Name</th>
                        <th>Module Leader</th>
                        <th>Description</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                    <tr id = "tableRow">
                            <td id="programId">1</td>
                            <td id="programTitle">Data Structure & Algorithms</td>
                            <td id="programLeader">Dr. Tarjana Yagnik</td>
                            <td id="programLevel">Examines sorting, searching, graphs, and complexity analysis.</td>
                            <td id="programStatus">Year 2</td>
                            <td class="actions">
                                <button id="editProgrammeBtn" class="btn btn-primary" type="button">Edit</button>
                                <!-- <button id="programmeModulesBtn" class="btn btn-success" type="button">Programmes</button> -->
                                <button id="deleteProgrammeBtn" class="btn btn-danger" type="button">Delete</button>
                            </td>
                        </tr>

                </table>
            </div>
        </div>
    </div>
</section>