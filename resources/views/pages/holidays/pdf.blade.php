<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة العطلات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl; /* Right-to-left layout */
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>قائمة العطلات</h1>
    <table>
        <thead>
            <tr>
                <th>الرقم</th>
                <th>اسم العطلة</th>
                <th>من</th>
                <th>إلى</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($holidays as $holiday)
                <tr>
                    <td>{{ $holiday->holiday_id }}</td>
                    <td>{{ $holiday->holiday_name }}</td>
                    <td>{{ $holiday->holiday_from }}</td>
                    <td>{{ $holiday->holiday_to }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
