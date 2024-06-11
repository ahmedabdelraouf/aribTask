<!-- resources/views/employees/_form.blade.php -->

<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name"
           value="{{ old('first_name', $employee->first_name ?? '') }}" required>
    @error('first_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name"
           value="{{ old('last_name', $employee->last_name ?? '') }}" required>
    @error('last_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="form-group">
    <label for="last_name">Department</label>
    @include("departments.deps_select")
</div>

<div class="form-group">
    <label for="salary">Salary</label>
    <input type="number" step="0.01" class="form-control" id="salary" name="salary"
           value="{{ old('salary', $employee->salary ?? '') }}" required>
    @error('salary')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="manager_name">Manager Name</label>
    <input type="text" class="form-control" id="manager_name" name="manager_name"
           value="{{ old('manager_name', $employee->manager_name ?? '') }}" required>
    @error('manager_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="image">Employee Image</label>
    <input type="file" class="form-control" id="image" name="image">
    @if(isset($employee) && $employee->image)
        <img src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->full_name }}" width="100">
    @endif
    @error('image')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
