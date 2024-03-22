<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "boboiboy";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk menyimpan pesan
function saveMessage($subject, $nama, $email, $pesan)
{
    global $conn;
    $query = "INSERT INTO messages (subject, nama, email, pesan) VALUES ('$subject', '$nama', '$email', '$pesan')";
    mysqli_query($conn, $query);
}

// Proses formulir jika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $pesan = $_POST["pesan"];

    saveMessage($subject, $nama, $email, $pesan);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pesan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #3498db;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #34495e;
        }

        input,
        textarea {
    width: 100%;
    padding-left: 130px;
    padding-right: 130px;
    padding-top: 10px;
    padding-bottom: 10px;
    margin-bottom: 15px;
    border: 1px solid #bdc3c7;
    border-radius: 4px;
    box-sizing: border-box;
}


        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
<?php
      include 'menu.php';
      ?>
    <h2>Form Pesan</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" required>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="pesan">Pesan:</label>
        <textarea name="pesan" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>

    <h2>Daftar Pesan</h2>
    <table>
        <tr>
            <th>Subject</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
        </tr>
        <?php
        // Tampilkan data dari database
        $result = mysqli_query($conn, "SELECT * FROM messages");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['pesan'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
