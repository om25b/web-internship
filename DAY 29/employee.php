<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "v2v";
$conn = mysqli_connect($server, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$queries = [
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7011, 'Aarohi', 'Deshmukh', 'Chief Strategy Officer', 120000, 'aarohi@example.com', 'Colaba')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7012, 'Rutuja', 'Jadhav', 'Operations Director', 98000, 'rutuja@example.com', 'Marine Lines')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7013, 'Siddhi', 'Patil', 'Senior HR Manager', 87000, 'siddhi@example.com', 'Charni Road')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7014, 'Prachi', 'Phadke', 'Product Analyst', 83000, 'prachi@example.com', 'Churchgate')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7015, 'Tejas', 'More', 'Business Consultant', 79000, 'tejas@example.com', 'Cuffe Parade')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7016, 'Snehal', 'Naik', 'QA Engineer', 76500, 'snehal@example.com', 'Nariman Point')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7017, 'Omkar', 'Bhosale', 'Accounts Supervisor', 81500, 'omkar@example.com', 'Mantralaya')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7018, 'Vaishnavi', 'Shinde', 'Tech Lead', 70500, 'vaishnavi@example.com', 'Fort')",
    "INSERT INTO employee (ID, Firstname, Lastname, Designation, Salary, Email, Address) VALUES (7019, 'Ameya', 'Kulkarni', 'Market Researcher', 69500, 'ameya@example.com', 'Ballard Estate')"
];
foreach ($queries as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
}
mysqli_close($conn);
?>
