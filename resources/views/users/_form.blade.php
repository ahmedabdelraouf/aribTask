<!-- resources/views/employees/_form.blade.php -->

<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name"
           value="{{ old('first_name', $user->first_name ?? '') }}" required>
    @error('first_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name"
           value="{{ old('last_name', $user->last_name ?? '') }}" required>
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
           value="{{ old('salary', $user->salary ?? '') }}" required>
    @error('salary')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="form-group">
    <label for="salary">password</label>
    <input type="text" class="form-control" id="password" name="password"
           value="{{ old('password') }}"
           @if(empty($user)) required @endif>
    @error('password')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col">
    <label for="status">Manager</label>
    <select class="form-control" name="manager_id">
        <option value="0">Select Manager</option>

        @if(!empty($managers))
            @foreach($managers as $manager)
                <option
                    @if((request()->get("manager_id") == $manager->id) || ((!empty($user))&&($user->manager_id == $manager->id))) selected
                    @endif
                    value="{{$manager->id}}">{{$manager->full_name}}</option>
            @endforeach
        @endif
    </select>
    @error('employee_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col">
    <label for="status">Role</label>
    <select class="form-control" name="role">
        <option value="0">Select role</option>

        @if(!empty($roles))
            @foreach($roles as $role)
                <option
                    @if((request()->get("role") == $role) ||
 ((!empty($user))&&($user->role == $role))) selected
                    @endif
                    value="{{$role}}">{{$role}}</option>
            @endforeach
        @endif
    </select>
    @error('employee_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image" name="image">
    @if(isset($user) && $user->image)
        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->full_name }}" width="100">
    @endif
    @error('image')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<br>
