<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProjectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Same fields as the create modal but populated with data -->
                    <div class="form-group">
                        <label for="edit_title">Project Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_start_date">Start Date</label>
                        <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_end_date">End Date</label>
                        <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_budget">Budget</label>
                        <input type="number" class="form-control" id="edit_budget" name="budget" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_priority">Priority</label>
                        <select class="form-control" id="edit_priority" name="priority" required>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_location_type">Location Type</label>
                        <select class="form-control" id="edit_location_type" name="location_type" required>
                            <option value="commercial">Commercial</option>
                            <option value="non_commercial">Non-Commercial</option>
                        </select>
                    </div>
                    <div class="form-group" id="edit_commercial_property" style="display:none;">
                        <label for="edit_property_id">Commercial Property</label>
                        <select class="form-control" id="edit_property_id" name="property_id">
                            <!-- Populate with commercial properties -->
                        </select>
                    </div>
                    <div class="form-group" id="edit_non_commercial_property" style="display:none;">
                        <label for="edit_non_commercial_property_id">Non-Commercial Property</label>
                        <select class="form-control" id="edit_non_commercial_property_id" name="non_commercial_property_id">
                            <!-- Populate with non-commercial properties -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
