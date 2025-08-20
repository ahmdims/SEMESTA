<!DOCTYPE html>
<html>

<head>
    <title>Weekly Attendance Report</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1,
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Weekly Attendance Report</h1>
    <h2>{{ $dateRange }}</h2>

    @foreach ($reportData as $locationName => $attendances)
        <h3>Location: {{ $locationName }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Scan Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->scanned_at->format('Y-m-d') }}</td>
                        <td>{{ $attendance->scanned_at->format('H:i:s') }}</td>
                        <td>{{ ucfirst($attendance->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No attendance records for this location this week.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>
    @endforeach
</body>

</html>