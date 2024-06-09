<!-- resources/views/employees/_form.blade.php -->

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $department->name ?? '') }}" required>
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
