//database name
CREATE DATABASE IF NOT EXISTS bank;

//employee signup table
CREATE TABLE Employee_Signup (
    emp_id INT PRIMARY KEY,
    emp_name VARCHAR(255),
    emp_desg VARCHAR(255),
    user_name VARCHAR(255) UNIQUE,
    pass VARCHAR(255)
);

