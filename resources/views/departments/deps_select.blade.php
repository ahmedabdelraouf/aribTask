<div class="col">
    <select class="form-control" name="department_id">
        <option value="0">{{__("choose department")}}</option>
        @if(!empty($departments))
            @foreach($departments as $department)
                <option @if(request()->get("department_id") == $department->id) selected @endif
                value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        @endif
    </select>
</div>
