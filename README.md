# Employee Management System - Sample CRUD

A simple PHP and MySQL CRUD application for an Employee Management System.

## Required environment
- XAMPP (Apache + MySQL)
- Visual Studio Code
- Git
- GitHub
- MySQL Workbench or phpMyAdmin

## Setup
1. Start **Apache** and **MySQL** in XAMPP.
2. Copy the `sample-crud` folder into your XAMPP `htdocs` folder.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. Open:
   `http://localhost/employee-management-system/sample-crud/index.php`
   (adjust the first folder name if you use a different repository/folder name).

## CRUD files
- `db.php` - MySQL connection
- `index.php` - Read/display all employees
- `create.php` - Create/add employee
- `edit.php` - Update employee
- `delete.php` - Delete employee

## GitHub workflow
Create the public repository using:
`lastname-projectname`

Then create and use the required branch:
`sample-crud`

Commit and push the branch, then create a pull request from `sample-crud` to `main`. Do not merge unless instructed.
