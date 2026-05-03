<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>

<h2>Tambah User</h2>

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div>
        Nama:
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <br>

    <div>
        Email:
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <br>

    <div>
        Password:
        <input type="password" name="password">
        @error('password')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <br>

    <button type="submit">Simpan</button>

</form>

</body>
</html>