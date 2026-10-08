<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to dashboard {{ session('u') }}</h1>

    <!-- Form Filter Between berdasarkan Tanggal -->
    <form action="/home" method="GET">
        <label for="start_date">Dari Tanggal:</label>
        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

        <label for="end_date">Sampai Tanggal:</label>
        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

        <button type="submit">Filter</button>
        <a href="/home"><button type="button">Reset</button></a>
    </form>

    <br>

    <!-- Tombol Export Excel (Membawa Filter Tanggal) -->
    <a href="/export-excel?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}">
        <button type="button">Export Excel</button>
    </a>

    <!-- Tombol Export PDF (Membawa Filter Tanggal & Hapus target="_blank") -->
    <a href="/export-pdf?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}">
        <button type="button">Export PDF</button>
    </a>

    <!-- Tombol Window Print -->
    <button type="button" onclick="window.print()">Window Print</button>

    <br><br>

    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Buat</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($users as $user)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') : '-' }}</td>
                <td>
                    <a href="/edit/{{ $user->id }}"><button type="button">Edit</button></a>
                </td>               
                <td>
                    <form action="/delete/{{ $user->id }}" method="POST">
                        @csrf
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <a href="/logout">
        <button type="button">Logout</button>
    </a>
</body>
</html>