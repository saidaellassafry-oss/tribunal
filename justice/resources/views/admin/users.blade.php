<!DOCTYPE html>
<html>
<head>
<title>Add User</title>
</head>

<body>

<h1>➕ Add User</h1>

<!-- error messages -->
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/admin/users">
    @csrf

    <input type="text" name="name" placeholder="Name" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role" required>
        <option value="employee">Employee</option>
        <option value="citizen">Citizen</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>