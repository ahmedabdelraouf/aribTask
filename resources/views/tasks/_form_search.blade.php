<form action="{{ route('tasks.index') }}" method="GET" class="mb-3">
    <div class="row bg-white p-3">
        <div class="col">
            <input type="text" name="subject" class="form-control"
                   value="{{request()->get("subject")}}" placeholder="Subject">
        </div>

        <div class="col">
            <select class="form-control" name="status">
                <option value="0">Select Status</option>

                @if(!empty($statuses))
                    @foreach($statuses as $statuse)
                        <option
                            @if((request()->get("status") == $statuse)) selected
                            @endif
                            value="{{$statuse}}">{{$statuse}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col">
            <select class="form-control" name="employee_id">
                <option value="0">Select Employee</option>

                @if(!empty($employees))
                    @foreach($employees as $employee)
                        <option
                            @if((request()->get("employee_id") == $employee->id)) selected
                            @endif
                            value="{{$employee->id}}">{{$employee->full_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
