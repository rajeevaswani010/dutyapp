<table>
    <thead>
        <tr>
            <th>Mission ID</th>
            <th>Purpose</th>
            <th>Country</th>
            <th>City</th>
            <th>Directorate</th>
            <th>Department</th>
            <th>Staff Required</th>
            <th>Num Of Days</th>
            <th>Num Of Nights</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr>
            <td>{{ $DT->id }}</td>
            <td>{{ $DT->purpose }}</td>
            <td>{{ $DT->country }}</td>
            <td>{{ $DT->city }}</td>
            <td>{{ $DT->directorate }}</td>
            <td>{{ $DT->department }}</td>
            <td>{{ $DT->num_of_staff }}</td>
            <td>{{ $DT->num_of_days }}</td>
            <td>{{ $DT->num_of_nights }}</td>
            <td>{{ $DT->start_date }}</td>
            <td>{{ $DT->end_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
