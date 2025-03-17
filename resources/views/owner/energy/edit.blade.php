<!-- Modal for Editing Utility Record -->
<div class="modal fade" id="addUtilityModal" tabindex="-1" aria-labelledby="addUtilityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUtilityModalLabel">Edit Utility Record</h5>
            </div>
            <form action="{{ route('owner.property.energy.store') }}" method="POST">
                @csrf
                @method('PUT') <!-- This indicates an update request -->

                <div class="modal-body">
                    <!-- Month Field -->
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input type="month" class="form-control" id="month" name="month" required>
                    </div>

                    <!-- Utility Type Field -->
                    <div class="mb-3">
                        <label for="utility_type" class="form-label">Utility Type</label>
                        <select class="form-control" id="utility_type" name="utility_type" required>
                            <option value="electricity">Electricity</option>
                            <option value="fuel">Fuel</option>
                            <option value="water">Water</option>
                        </select>
                    </div>

                    <!-- Property Type Selection -->
                    <div class="mb-3">
                        <label class="form-label">Select Property Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="property_type" id="commercial"
                                value="commercial" required>
                            <label class="form-check-label" for="commercial">Commercial</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="property_type" id="non_commercial"
                                value="non_commercial">
                            <label class="form-check-label" for="non_commercial">Non-Commercial</label>
                        </div>
                    </div>

                    <!-- Property Selection -->
                    <div class="mb-3">
                        <label for="property_id" class="form-label">Property</label>
                        <select class="form-control" id="property_id" name="property_id" required>
                            <!-- Options will be populated dynamically based on property type selection -->
                        </select>
                    </div>

                    <!-- Cost Field -->
                    <div class="mb-3">
                        <label for="cost" class="form-label">Cost</label>
                        <input type="number" step="0.01" class="form-control" id="cost" name="cost"
                            required>
                    </div>

                    <!-- Notes Field (Optional) -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="theme-btn btn-sm mb-25"
                        style="background-color: #7f7e7e; color: white;" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="theme-btn btn-sm mb-25">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
