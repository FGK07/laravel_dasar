<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    @if(session('success'))
    <div style="color:green">
        {{ session('success') }}
    </div>
@endif

<h2>Daftar User</h2>

<a href="{{ route('users.create') }}">Tambah User</a>

<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Dibuat</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>