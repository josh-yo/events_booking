<h1>Upcoming Events</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event['title'] }}</td>
                <td>{{ $event['date_time'] }}</td>
                <td>{{ $event['location'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>