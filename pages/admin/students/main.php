<section class="main-section" id="programmes-section">

    <!-- header section -->
    <?php
    include '../components/header.php';
    ?>

    <!-- main content -->

    <div class="main-content">

        <div class="content-wrapper">
            <div class="header-ribbon">
                <div class="header-text">Prospective Students</div>
                <!-- <input id="addProgrammeBtn" class="btn btn-primary" type="button" value="+ Export to CSV"> -->
                <input id="" class="btn btn-primary" type="button" value="+ Export to CSV">
            </div>

            <!-- card header with search and actions -->
            <div class="search-section">
                <div class="search">
                    <input id="searchField" type="text" placeholder="Search students by name or email...">
                </div>

                <div class="filter">
                    <select id="searchLevelField">
                        <option value="">All Levels</option>
                        <option value="1">Undergraduate</option>
                        <option value="2">Postgraduate</option>
                    </select>
                </div>

                <!-- <input id="searchBtn" class="btn btn-light search-btn" type="button" value="Search"> -->
                <input id="" class="btn btn-light search-btn" type="button" value="Search">
            </div>

            <!-- table container -->
            <div class="table-container">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Level</th>
                        <th>Actions</th>
                        <th>Date</th>
                    </tr>
                    <tr id = "tableRow">
                            <td id="programId">1</td>
                            <td id="programTitle">Paulina Olaska</td>
                            <td id="programLeader">paula2004@example.com</td>
                            <td id="programLevel">BSc Computer Science</td>
                            <td id="programLevel">Undergraduate</td>
                            <td class="actions">
                                <button id="deleteProgrammeBtn" class="btn btn-danger" type="button">Delete</button>
                            </td>
                            <td id="programLevel">27-30-2025</td>
                        </tr>

                </table>
            </div>
        </div>
    </div>
</section>