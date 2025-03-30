<section class="modal-backdrop" style="display: none;">
    <div class="modal">
        <!-- header section with form title -->
        <div class="modal-header">
            <h4 class="form-title" id="programmeModalTitle">Add New Programme</h4>
            <button class="modal-close">&times;</button>
        </div>

        <div class="modal-body">
            <form id="programmeForm">
                <!-- programme name field -->
                <div class="form-group">
                    <label for="programmeName">Programme Name</label>
                    <input class="form-control" id="programmeName" placeholder="Enter programme name" type="text">
                </div>

                <!-- form controls -->
                <div class="form-row">

                    <!-- select level field -->
                    <div class="form-col">
                        <div class="form-group">
                            <label for="programmeLevel">Level</label>
                            <select class="form-control" id="programmeLevel">
                                <option value="">Select Level</option>
                                <option value="1">Undergraduate</option>
                                <option value="2">Postgraduate</option>
                            </select>
                        </div>
                    </div>

                    <!-- select programme leader field -->
                    <div class="form-col">
                        <div class="form-group">
                            <label for="\">Programme Leader</label>
                            <select class="form-control" id="programmeLeader">
                                <!-- <option value="">Select Programme Leader</option>
                                <option value="1">Dr. Tarjana Yagnik</option>
                                <option value="2">Dr. Paul Wolf</option> -->
                            </select>
                        </div>
                    </div>
                </div>

                <!-- description field -->
                <div class="form-group">
                    <label for="programmeDescription">Description</label>
                    <textarea class="form-control" id="programmeDescription" placeholder="Enter programme description" type="text"></textarea>
                </div>

                <!-- img url field -->
                <div class="form-group">
                    <label for="imageUrl">Programme Image URL</label>
                    <input class="form-control" id="imageUrl" placeholder="Enter image URL (Optional)" type="text">
                </div>

                <!-- programme status field -->
                <div class="form-group">
                    <label for="programmeStatus">Programme Status</label>
                    <select class="form-control" id="programmeStatus">
                        <!-- <option value="">Select Status</option> -->
                        <option value="0">Unpublished</option>
                        <option value="1">Published</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button id="cancleBtn" class="btn btn-secondary">Cancel</button>
            <button id="saveBtn" class="btn btn-primary">Save Programme</button>
        </div>
    </div>
    </div>
</section>