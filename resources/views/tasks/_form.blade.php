<!-- resources/views/tasks/_form.blade.php -->

<div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" class="form-control" id="first_name" name="subject"
           value="{{ old('subject', $task->subject ?? '') }}"
           required>
    @error('subject')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" name="description"
           value="{{ old('description', $task->description ?? '') }}" required>
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col">
    <label for="status">Status</label>
    <select class="form-control" name="status">
        @if(!empty($statuses))
            @foreach($statuses as $statuse)
                <option
                    @if((request()->get("status") == $statuse) || ((!empty($task))&&($task->status == $statuse))) selected
                    @endif
                    value="{{$statuse}}">{{$statuse}}</option>
            @endforeach
        @endif
    </select>
    @error('department_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col">
    <label for="status">Employee</label>
    <select class="form-control" name="employee_id">
        <option value="0">Select Employee</option>

        @if(!empty($employees))
            @foreach($employees as $employee)
                <option
                    @if((request()->get("employee_id") == $employee->id) ||((!empty($task))&&($task->employee_id == $employee->id))) selected
                    @endif
                    value="{{$employee->id}}">{{$employee->full_name}}</option>
            @endforeach
        @endif
    </select>
    @error('employee_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<br>
