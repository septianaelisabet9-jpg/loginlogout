<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data</title>
</head>
<body>
    <h1>edit data</h1>
     <form action="/edit/{{ $user->id }}" method="POST">
        @csrf
        <table>
            <tr>
                <td><label for="name">Name</label></td>
            <td><input type="text" name="name" value="{{ $user->name }}" required></td>
</tr>

            <tr>
             <td><label for="email">Email</label></td>
            <td><input type="email" name="email" value="{{ $user->email }}" required></td>
            </tr>
            
            <tr>
            <td colspan="2">
                <button type="submit">Simpan Perubahan</button>
            </td>



            </tr>
        </table>
</body>
</html>