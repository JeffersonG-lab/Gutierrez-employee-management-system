CREATE DATABASE IF NOT EXISTS employee_management;
USE employee_management;

CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30),
    department VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    salary DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    date_hired DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO employees
(first_name, last_name, email, phone, department, position, salary, date_hired)
VALUES
('Juan', 'Dela Cruz', 'juan.delacruz@example.com', '09171234567', 'IT', 'System Developer', 35000.00, '2025-01-15'),
('Maria', 'Santos', 'maria.santos@example.com', '09181234567', 'Human Resources', 'HR Officer', 30000.00, '2024-08-20');