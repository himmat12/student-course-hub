<section class="main-section" id="programmes-section">

    <!-- header section -->
    <?php
    include '../components/header.php';
    ?>

    <!-- main content -->

    <div class="main-content">

        <div class="content-wrapper">
            <div class="header-ribbon">
                <div class="header-text">All Programmes</div>
                <input id="addProgrammeBtn" class="btn btn-primary" type="button" value="+ Add New Programme">
            </div>

            <!-- card header with search and actions -->
            <div class="search-section">
                <div class="search">
                    <input id="searchField" type="text" placeholder="Search programmes by name...">
                </div>

                <div class="filter">
                    <select id="searchLevelField">
                        <option value="">All Levels</option>
                        <option value="1">Undergraduate</option>
                        <option value="2">Postgraduate</option>
                    </select>
                </div>

                <input id="searchBtn" class="btn btn-light search-btn" type="button" value="Search">
            </div>

            <!-- table container -->
            <div class="table-container">
                <table>
                    <!-- <tr>
                        <th>Id</th>
                        <th>Program Name</th>
                        <th>Program Leader</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr> -->
                    <!-- <tr id = "tableRow">
                            <td id="programId">1</td>
                            <td id="programTitle">BSc Computer Science</td>
                            <td id="programLeader">Dr. Tarjana Yagnik</td>
                            <td id="programLevel">Undergraduate</td>
                            <td id="programStatus"><span class="status status-unpublished">Unpublished</span></td>
                            <td class="actions">
                                <button id="editProgrammeBtn" class="btn btn-primary" type="button">Edit</button>
                                <button id="programmeModulesBtn" class="btn btn-success" type="button">Modules</button>
                                <button id="deleteProgrammeBtn" class="btn btn-danger" type="button">Delete</button>
                            </td>
                        </tr> -->

                </table>
            </div>
        </div>
    </div>
</section>