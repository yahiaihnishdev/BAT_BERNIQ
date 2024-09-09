

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Holidays Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Holidays Report</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Holiday Name</th>
            <th>From</th>
            <th>To</th>
            <th>Employee ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($holidays as $holiday)
        <tr>
            <td>{{ $holiday->holiday_id }}</td>
            <td>{{ $holiday->holiday_name }}</td>
            <td>{{ $holiday->holiday_from->format('Y-m-d') }}</td>
            <td>{{ $holiday->holiday_to->format('Y-m-d') }}</td>
            <td>{{ $holiday->emp_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
