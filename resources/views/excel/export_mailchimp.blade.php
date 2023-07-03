<table>
    <thead>
        <tr>
            <th>Email Address</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{ $client->email }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->surname }}</td>
        </tr>
    @endforeach
    </tbody>
</table>