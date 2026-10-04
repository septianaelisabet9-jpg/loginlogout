<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>welcome to dashboard {{ session('u') }}</h1>

    <!-- Form Filter Between berdasarkan ID/Nomor -->
    <form action="/home" method="GET">
        <label for="start_id">Dari No:</label>
        <input type="number" id="start_id" name="start_id" value="{{ request('start_id') }}" placeholder="1">

        <label for="end_id">Sampai No:</label>
        <input type="number" id="end_id" name="end_id" value="{{ request('end_id') }}" placeholder="5">

        <button type="submit">Filter</button>
        <a href="/home"><button type="button">Reset</button></a>
    </form>

    <br>

    <!-- Tombol Download Excel -->
    <a href="{{ asset('Data_User.xlsx') }}" download="Data_User.xlsx">
        <button type="button">Print Excel</button>
    </a>

    <!-- Tombol Window Print -->
    <button type="button" onclick="window.print()">Window Print</button>

    <br><br>

    <table border="1" width="100">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        <?php
            $no = 1;
            foreach ($hai as $key => $value) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $value->name ?></td>
            <td><?= $value->email ?></td>
        </tr>
        <?php
            }
        ?>
    </table>

    <br>
    <button>
        <a href="/logout">logout</a>
    </button>
</body>
</html>