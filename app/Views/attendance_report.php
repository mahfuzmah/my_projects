<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" href="<?= base_url('css/style_attendance.css') ?>">
</head>
<body>
    <div class="attendance-container">
        <h2>My Attendance Report</h2>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Total Hours</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalHours = 0;
                foreach ($records as $record):
                    $clockIn = strtotime($record['clock_in']);
                    $clockOut = $record['clock_out'] ? strtotime($record['clock_out']) : null;
                    $hours = $clockOut ? round(($clockOut - $clockIn) / 3600, 2) : '-';
                    if ($clockOut) $totalHours += $clockOut - $clockIn;
                ?>
                <tr>
                    <td><?= date('Y-m-d', strtotime($record['clock_in'])) ?></td>
                    <td><?= date('H:i:s', strtotime($record['clock_in'])) ?></td>
                    <td><?= $record['clock_out'] ? date('H:i:s', strtotime($record['clock_out'])) : 'Still Clocked In' ?></td>
                    <td><?= is_numeric($hours) ? $hours . ' hrs' : '-' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total Hours Worked: <?= round($totalHours / 3600, 2) ?> hrs</h4>

    </div>
</body>
</html>
