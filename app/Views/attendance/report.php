<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" href="<?= base_url('css/style_attendance.css') ?>">
</head>
<body>
    <div class="attendance-container">
        <h2>Attendance Summary Report</h2>

        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Hours Worked</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($records as $record): ?>
                    <?php
                        $worked = 0;
                        if ($record['clock_out']) {
                            $worked = (strtotime($record['clock_out']) - strtotime($record['clock_in'])) / 3600;
                            $total += $worked;
                        }
                    ?>
                    <tr>
                        <td><?= esc($record['user_id']) ?></td>
                        <td><?= esc($record['username']) ?></td>
                        <td><?= date('Y-m-d', strtotime($record['clock_in'])) ?></td>
                        <td><?= date('H:i', strtotime($record['clock_in'])) ?></td>
                        <td><?= $record['clock_out'] ? date('H:i', strtotime($record['clock_out'])) : '-' ?></td>
                        <td><?= $record['clock_out'] ? number_format($worked, 2) . ' hrs' : '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total Hours Worked: <?= number_format($total, 2) ?> hrs</h3>
    </div>
</body>
</html>
