<form action="{{ route('owner.property.visitors.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="id_type">ID Type</label>
        <select name="id_type" class="form-control" id="id_type" required>
            <option value="" disabled selected>Select ID Type</option>
            <option value="NIDA" {{ old('id_type') == 'NIDA' ? 'selected' : '' }}>NIDA</option>
            <option value="Vehicle License ID" {{ old('id_type') == 'Vehicle License ID' ? 'selected' : '' }}>Vehicle
                License ID</option>
            <option value="Voters ID" {{ old('id_type') == 'Voters ID' ? 'selected' : '' }}>Voters ID</option>
            <option value="Passport ID" {{ old('id_type') == 'Passport ID' ? 'selected' : '' }}>Passport ID</option>
            <option value="Other" {{ old('id_type') == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>
    <div class="form-group">
        <label for="id_number">ID Number</label>
        <input type="text" name="id_number" class="form-control" id="id_number" value="{{ old('id_number') }}"
            required>
    </div>
    <div class="form-group">
        <label for="purpose">Purpose</label>
        <input type="text" name="purpose" class="form-control" id="purpose" value="{{ old('purpose') }}" required>
    </div>
    <div class="form-group">
        <label for="office_unit">Office Unit</label>
        <input type="text" name="office_unit" class="form-control" id="office_unit" value="{{ old('office_unit') }}"
            required>
    </div>
    <div class="form-group">
        <label for="visit_date">Visit Date</label>
        <input type="date" name="visit_date" class="form-control" id="visit_date" required>
    </div>
    <div class="form-group">
        <label for="entry_time">Entry Time</label>
        <input type="text" name="entry_time" class="form-control" id="entry_time" required>
    </div>

    <script>
        // Set current date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('visit_date').value = today;

        // Set current time in 24-hour format
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('entry_time').value = `${hours}:${minutes}`;
    </script>
</form>

<script>
    window.onload = function() {
        const visitDateInput = document.getElementById('visit_date');
        const entryTimeInput = document.getElementById('entry_time');
        const today = new Date();
        const year = today.getFullYear();
        const month = (today.getMonth() + 1).toString().padStart(2, '0');
        const day = today.getDate().toString().padStart(2, '0');
        visitDateInput.value = `${year}-${month}-${day}`;
        const hours = today.getHours().toString().padStart(2, '0');
        const minutes = today.getMinutes().toString().padStart(2, '0');
        entryTimeInput.value = `${hours}:${minutes}`;
    }
</script>
