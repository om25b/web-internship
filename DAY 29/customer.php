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
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3011, 'Aarohi', 'Deshmukh', 'Laptop', 500, '9123456789', 'aarohi@example.com', 'Colaba')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3012, 'Rutuja', 'Jadhav', 'Mac', 700, '9123456789', 'rutuja@example.com', 'Marine Lines')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3013, 'Siddhi', 'Patil', 'Laptop', 15000, '9123456789', 'siddhi@example.com', 'Charni Road')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3014, 'Prachi', 'Phadke', 'Laptop', 65000, '9123456789', 'prachi@example.com', 'Cuffe Parade')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3015, 'Tejas', 'More', 'RR', 1000, '9123456789', 'tejas@example.com', 'Churchgate')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3016, 'Snehal', 'Naik', 'Lipstick', 500, '9123456789', 'snehal@example.com', 'Nariman Point')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3017, 'Omkar', 'Bhosale', 'BMW', 2000, '9123456789', 'omkar@example.com', 'Fort')",
    "INSERT INTO customer (Cust_ID, Firstname, Lastname, Product, Price, Phone, Email, Address) VALUES (3018, 'Vaishnavi', 'Shinde', 'Wallet', 300, '9123456789', 'vaishnavi@example.com', 'Ballard Estate')"
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
