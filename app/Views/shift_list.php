<h2>Shift Management</h2>

<form method="post" action="<?= base_url('employees/shifts/create') ?>">
  <input type="text" name="name" placeholder="Shift Name" required>
  <input type="time" name="start_time" required>
  <input type="time" name="end_time" required>
  <button type="submit">Add Shift</button>
</form>

<table>
  <tr>

  
    <th>Name</th>
    <th>Start</th>
    <th>End</th>
  </tr>
  <?php foreach ($shifts as $shift): ?>
    <tr>
      <td><?= esc($shift['name']) ?></td>
      <td><?= esc($shift['start_time']) ?></td>
      <td><?= esc($shift['end_time']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>
