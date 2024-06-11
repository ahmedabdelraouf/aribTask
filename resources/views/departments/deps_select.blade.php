<div class="col">
    <select class="form-control" name="department_id">
        <option value="0">{{__("choose department")}}</option>
        @if(!empty($departments))
            @foreach($departments as $department)
                <option
                    @if((request()->get("department_id") == $department->id) || ((!empty($employee))&&($employee->department_id == $department->id))) selected
                    @endif
                    value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        @endif
    </select>
    @error('department_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror

</div>
