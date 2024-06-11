<form action="{{ route('users.search') }}" method="GET" class="mb-3">
    <div class="row bg-white p-3">
        <div class="col">
            <input type="text" name="name" class="form-control" value="{{request()->get("name")}}" placeholder="Name">
        </div>
        {{--        <div class="col">--}}
        {{--            <input type="text" name="manager_name" class="form-control" value="{{request()->get("manager_name")}}"--}}
        {{--                   placeholder="Manager name">--}}
        {{--        </div>--}}
        @include("departments.deps_select")
        <div class="col">
            <select class="form-control" name="role">
                <option value="0">{{__("choose Role")}}</option>
                @if(!empty($userRoles))
                    @foreach($userRoles as $userRole)
                        <option
                            @if((request()->get("role") == $userRole) || ((!empty($user))&&($user->role == $department->id))) selected
                            @endif
                            value="{{$userRole}}">{{$userRole}}</option>
                    @endforeach
                @endif
            </select>
            @error('department_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="col">
            <input type="number" name="salary_from" class="form-control" value="{{request()->get("salary_from")}}"
                   placeholder="Salary From">
        </div>
        <div class="col">
            <input type="number" name="salary_to" class="form-control" placeholder="Salary To"
                   value="{{request()->get("salary_to")}}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
