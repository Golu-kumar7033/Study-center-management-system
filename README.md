# 📚 Libro Study Center Management System

## 📌 About the Project

This is a web based application made using core PHP & MySql. This helps to manage study centre easily.

The goal of this project is to help reduce any manual work.

## 🚀 Features

- Admin & Users.
- Manage Users.
- Manage Study Centre.

- Manage Database.

- Dynamic Web Pages.
- Easy to Use UI.
- Email (Brevo SMTP )
## 🛠 Technologies Used
| Tech | Description |
|------|-------------|
| HTML | Structure |
| CSS | Styling |
| Bootstrap | Responsive Design |
| jQuery | AJAX & DOM Manipulation |

| Core PHP | Back End |
| MySQL | Database |
| PHPMailer | Email Integration |
| Brevo SMTP | Email Service  |
| WAMP Server | Local Development |
| Git & GitHub | Versioning |
## ⚙️ Installing Project
To get this project up and running on your local machine.
### 1.Clone Repository
```
```bash
git clone YOUR_GITHUB_REPOSITORY_URL
```
```
### 2.Copy Project Folder
Copy the Project folder to WAMP 'www' folder.
```
```text
C:/wamp64/www/
```
```
### 3.Start WAMP Server
Start Apache & MySQL.
### 4.Database
1.Open phpMyAdmin.
2.Create a new database in MySql.
3.Select the database you have just created.
4.Import the projects .sql database.
### 5.Database Connection
Open the database connection file and change the details.
```

```php
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "YOUR_DATABASE_NAME";
$conn = mysqli_connect(
$host,
$username,
$password,
$database
);
if (!$conn) {
die("Database connection failed: " . mysqli_connect_error());
}
```
```
Change YOUR_DATABASE_NAME to match your database name.
## 📧 Brevo SMTP Email
If using email within your project:
### 1.Create Brevo Account
1.Go to [Brevo](https://www.brevo.com/)
2.Create an account or sign in.
3.Complete any required verification.
### 2.Verify Sender Email
1.Open Brevo account.
2.Go to Settings.
3.Find Senders, Domains & Dedicated IPs.
4.Add sender email or domain.
### 3.SMTP Details
Go to Settings then SMTP & API.
Find SMTP.
Copy the following details:
- SMTP Server
- SMTP Port
- SMTP Login
- SMTP Key
### 4.SMTP In PHP
If using PHPMailer within your project:
```
```php
$mail->isSMTP();
$mail->Host = 'smtp-relay.brevo.com';
$mail->SMTPAuth = true;
$mail->Username = 'YOUR_BREVO_SMTP_LOGIN';
$mail->Password = 'YOUR_BREVO_SMTP_KEY';
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
```
```
Set sender:
```
```php
$mail->setFrom(
'your_verified_email@example.com',
'Libro Study Center'
);
```
```
Change the placeholders to your Brevo details.
Never upload any SMTP details or passwords to GitHub. Always store this information in environment variables or a private config file that will be ignored using .gitignore.
## ▶️ Running Project
Open up your browser and go to:
```
```text
http://localhost/YOUR_PROJECT_FOLDER/
```
```
## 👨‍💻 My Role
I developed this project using Core PHP & MySQL.
My Role in this project was:
- Back End development using Core PHP.
- Database design & connection.
- Application Logic.
- Dynamic Web Pages.
- Front End & Back End Integration.
- Database Operations & CRUD.
## 📚 What I Have learnt
- Improved Core PHP skills.
- Learned how to design & connect a MySQL database.
- Practice using CRUD.
- Improved Front End & Back End Integration.
- Practical Web Development Experience.
## 👤 Developer
Golu Kumar
PHP / Laravel Developer
