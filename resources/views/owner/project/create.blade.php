<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('owner.property.projects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Add project form fields -->
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="budget">Budget</label>
                            <input type="number" class="form-control" id="budget" name="budget" step="0.01"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority" name="priority" required>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="property_id">Property</label>
                        <select class="form-control" id="property_id" name="property_id">
                            <option value="" disabled selected>Select Property</option>
                            @foreach ($properties as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                     --}}
                    {{-- Inside your Blade view file --}}
                    <div class="form-group">
                        <label for="property_id">Property</label>
                        <select class="form-control" id="property_id" name="property_id">
                            <option value="">Select Property</option>
                            @foreach ($all_properties as $property)
                                <option value="{{ $property->id }}">{{ $property->name }}</option>
                            @endforeach
                        </select>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="theme-btn btn-sm mb-25"
                        style="background-color: #7f7e7e; color: #ffffff;" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="theme-btn btn-sm mb-25" id="modalSubmitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
