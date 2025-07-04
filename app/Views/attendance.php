<!DOCTYPE html>
<html>
<head>
    <title>Attendance Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/style_attendance.css') ?>">
</head>
<body>
    <div class="attendance-container">
        <h2>Attendance Dashboard</h2>

        <!-- Clock In/Out Buttons -->
        <?php if ($status === 'not_clocked_in'): ?>
            <button type="button" onclick="handleClock('in')" class="clock-btn">Clock In</button>
        <?php elseif ($status === 'clocked_in'): ?>
            <button type="button" onclick="handleClock('out', <?= $attendance_id ?>)" class="clock-btn clock-out">Clock Out</button>
        <?php endif; ?>

        <!-- Attendance Table -->
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Hours Worked</th>
                    <th>Clock In Location</th>
                    <th>Clock Out Location</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $record): ?>
                    <tr>
                        <td><?= date('Y-m-d', strtotime($record['clock_in'])) ?></td>
                        <td><?= date('H:i', strtotime($record['clock_in'])) ?></td>
                        <td><?= $record['clock_out'] ? date('H:i', strtotime($record['clock_out'])) : '-' ?></td>
                        <td>
                            <?php 
                                if ($record['clock_out']) {
                                    $hours = (strtotime($record['clock_out']) - strtotime($record['clock_in'])) / 3600;
                                    echo number_format($hours, 2);
                                } else {
                                    echo '-';
                                }
                            ?>
                        </td>
                        <td><?= esc($record['clock_in_location'] ?? '-') ?></td>
                        <td><?= esc($record['clock_out_location'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Handle Clock In/Out -->
    <script>
        function handleClock(type, id = null) {
            console.log("Clock function triggered:", type, id);

            if (!navigator.geolocation) {
                alert("Geolocation is not supported.");
                return;
            }

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    console.log("Location:", position);

                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    const url = type === 'in'
                        ? "<?= base_url('attendance/clock-in') ?>"
                        : "<?= base_url('attendance/clock-out/') ?>" + id;

                    fetch(url, {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ lat: lat, lon: lon })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("HTTP " + response.status);
                        }
                        return response.text(); // Get raw text to debug
                    })
                    .then(text => {
                        console.log("Raw Response:", text);
                        // Try parsing JSON only if it's expected
                        try {
                            const data = JSON.parse(text);
                            console.log("Parsed Data:", data);
                        } catch (e) {
                            console.warn("Response is not valid JSON.");
                        }
                        setTimeout(() => window.location.reload(), 500);
                    })
                    .catch(error => {
                        console.error("FETCH failed:", error);
                        alert("Clock-in request failed: " + error.message);
                    });
                },
                function (error) {
                    console.error("Geolocation ERROR:", error);
                    alert("Location permission is required to clock in/out.");
                }
            );
        }
    </script>


</body>
</html>
