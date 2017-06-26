<li style="list-style-type: none">
    <table class="table table-bordered">
        <thead>
            <th>Name</th>
            <th>Position</th>
            <th>Start Date</th>
            <th>Salary</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->position }}</td>
                <td>{{ $employee->start_date }}</td>
                <td>{{ $employee->salary }}</td>
            </tr>
        </tbody>
    </table>
</li>

@if(isset($employees[$employee->id]))
    @include('partials._list', ['collection' => $employees[$employee->id]])
@endif