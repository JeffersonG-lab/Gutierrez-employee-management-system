<?php
require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $position = trim($_POST["position"] ?? "");
    $salary = trim($_POST["salary"] ?? "");
    $date_hired = trim($_POST["date_hired"] ?? "");

    if ($first_name === "" || $last_name === "" || $email === "" || $department === "" ||
        $position === "" || $salary === "" || $date_hired === "") {
        $error = "Please complete all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (!is_numeric($salary) || $salary < 0) {
        $error = "Salary must be a valid non-negative number.";
    } else {
        $stmt = $conn->prepare("INSERT INTO employees
            (first_name, last_name, email, phone, department, position, salary, date_hired)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssds", $first_name, $last_name, $email, $phone,
            $department, $position, $salary, $date_hired);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        }
        $error = "Unable to add employee: " . $stmt->error;
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Employee</title>
<style>
body{font-family:Arial;background:#f4f6f8}.form-box{max-width:650px;margin:40px auto;background:#fff;padding:25px;border-radius:8px;box-shadow:0 2px 8px #ddd}
label{display:block;margin-top:14px;font-weight:bold}input{width:100%;padding:10px;box-sizing:border-box;margin-top:6px;border:1px solid #ccc;border-radius:5px}
button,.back{margin-top:20px;padding:10px 15px;border:0;border-radius:5px;background:#2563eb;color:#fff;text-decoration:none;cursor:pointer}.error{padding:10px;background:#fee2e2;color:#991b1b;margin-bottom:15px}
</style>
</head>
<body>
<div class="form-box">
<h1>Add Employee</h1>
<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post">
<label>First Name *</label><input type="text" name="first_name" required value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
<label>Last Name *</label><input type="text" name="last_name" required value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
<label>Email *</label><input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
<label>Phone</label><input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
<label>Department *</label><input type="text" name="department" required value="<?= htmlspecialchars($_POST['department'] ?? '') ?>">
<label>Position *</label><input type="text" name="position" required value="<?= htmlspecialchars($_POST['position'] ?? '') ?>">
<label>Salary *</label><input type="number" name="salary" min="0" step="0.01" required value="<?= htmlspecialchars($_POST['salary'] ?? '') ?>">
<label>Date Hired *</label><input type="date" name="date_hired" required value="<?= htmlspecialchars($_POST['date_hired'] ?? '') ?>">
<button type="submit">Save Employee</button>
<a class="back" href="index.php">Cancel</a>
</form>
</div>
</body>
</html>