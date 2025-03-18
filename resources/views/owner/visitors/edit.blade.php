<form action="{{ route('owner.property.visitors.update', $visitor->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $visitor->name) }}"
            required>
    </div>
    <div class="form-group">
        <label for="id_type">ID Type</label>
        <input type="text" name="id_type" class="form-control" id="id_type"
            value="{{ old('id_type', $visitor->id_type) }}" required>
    </div>
    <div class="form-group">
        <label for="id_number">ID Number</label>
        <input type="text" name="id_number" class="form-control" id="id_number"
            value="{{ old('id_number', $visitor->id_number) }}" required>
    </div>
    <div class="form-group">
        <label for="purpose">Purpose</label>
        <input type="text" name="purpose" class="form-control" id="purpose"
            value="{{ old('purpose', $visitor->purpose) }}" required>
    </div>
    <div class="form-group">
        <label for="office_unit">Office Unit</label>
        <input type="text" name="office_unit" class="form-control" id="office_unit"
            value="{{ old('office_unit', $visitor->office_unit) }}" required>
    </div>
    <div class="form-group">
        <label for="entry_time">Entry Time</label>
        <input type="text" name="entry_time" class="form-control" id="entry_time"
            value="{{ old('entry_time', \Carbon\Carbon::parse($visitor->entry_time)->format('H:i')) }}" required>
        <small class="form-text text-muted">Use 24-hour format, e.g., 14:30.</small>
    </div>

    <div class="form-group">
        <label for="visit_date">Visit Date</label>
        <input type="date" name="visit_date" class="form-control" id="visit_date"
            value="{{ old('visit_date', $visitor->visit_date) }}" required>
    </div>
</form>

<script>
    window.onload = function() {
        const entryTimeInput = document.getElementById('entry_time');
        let entryTime = entryTimeInput.value;
        if (entryTime.endsWith(':00')) {
            entryTime = entryTime.slice(0, -3);
        }
        entryTimeInput.value = entryTime;
    }
</script>
