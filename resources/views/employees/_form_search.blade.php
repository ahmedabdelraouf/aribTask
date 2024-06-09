<form action="{{ route('employees.search') }}" method="GET" class="mb-3">
    <div class="row bg-white p-3">
        <div class="col">
            <input type="text" name="name" class="form-control" value="{{request()->get("name")}}" placeholder="Name">
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
