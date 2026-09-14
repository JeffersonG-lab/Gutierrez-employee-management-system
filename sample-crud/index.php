<?php
require_once "db.php";

$result = $conn->query("SELECT * FROM employees ORDER BY employee_id DESC");
if (!$result) {
    die("Error loading employees: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f6f8; margin:0; color:#222; }
        .container { max-width:1200px; margin:40px auto; padding:0 20px; }
        .header { display:flex; justify-content:space-between; align-items:center; gap:15px; margin-bottom:20px; }
        h1 { margin:0; }
        .btn { display:inline-block; padding:10px 15px; background:#2563eb; color:#fff; text-decoration:none; border-radius:6px; border:0; cursor:pointer; }
        .btn:hover { opacity:.9; }
        .btn-edit { background:#16a34a; }
        .btn-delete { background:#dc2626; }
        table { width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,.08); }
        th, td { padding:12px; border-bottom:1px solid #ddd; text-align:left; }
        th { background:#1f2937; color:#fff; }
        tr:hover { background:#f8fafc; }
        .actions { white-space:nowrap; }
        .actions a { margin-right:5px; }
        .empty { background:#fff; padding:25px; text-align:center; }
        @media(max-width:800px) { table { font-size:13px; } th,td { padding:8px; } .header { align-items:flex-start; flex-direction:column; } }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>Employee Management System</h1>
            <p>Employee records - CRUD Application</p>
        </div>
        <a class="btn" href="create.php">+ Add Employee</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Date Hired</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($employee = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($employee['employee_id']) ?></td>
                <td><?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?></td>
                <td><?= htmlspecialchars($employee['email']) ?></td>
                <td><?= htmlspecialchars($employee['phone']) ?></td>
                <td><?= htmlspecialchars($employee['department']) ?></td>
                <td><?= htmlspecialchars($employee['position']) ?></td>
                <td>₱<?= number_format((float)$employee['salary'], 2) ?></td>
                <td><?= htmlspecialchars($employee['date_hired']) ?></td>
                <td class="actions">
                    <a class="btn btn-edit" href="edit.php?id=<?= $employee['employee_id'] ?>">Edit</a>
                    <a class="btn btn-delete" href="delete.php?id=<?= $employee['employee_id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="empty">No employee records found. Click "Add Employee" to create one.</div>
    <?php endif; ?>
</div>
</body>
</html>