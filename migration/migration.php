<?php

$conn = new mysqli('localhost', "root", '', 'phpcore');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$sql_student = "
    CREATE TABLE IF NOT EXISTS student (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(200) NOT NULL,
        class INT(11) NOT NULL,
        division VARCHAR(1) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

// Execute student table creation
if ($conn->query($sql_student) === TRUE) {
    echo "Student table created successfully.\n";
} else {
    echo "Error creating student table: " . $conn->error . "\n";
}

// SQL to create marks table
$sql_marks = "
    CREATE TABLE IF NOT EXISTS marks (
        std_id INT(11) PRIMARY KEY,
        mathematics INT(100) NOT NULL,
        science INT(100) NOT NULL,
        english INT(100) NOT NULL,
        history INT(100) NOT NULL,
        FOREIGN KEY (std_id) REFERENCES student(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

// Execute marks table creation
if ($conn->query($sql_marks) === TRUE) {
    echo "Marks table created successfully.\n";
} else {
    echo "Error creating marks table: " . $conn->error . "\n";
}

// Close connection
$conn->close();
