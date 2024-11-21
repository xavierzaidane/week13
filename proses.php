<?php
// Include the database connection
include('konek.php');

// Get the action from the URL
$aksi = $_GET['aksi'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

// Check the action type (tambah, ubah, or hapus)
if ($aksi == 'tambah') {
    // Prepare the INSERT query using PDO
    $query = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp) VALUES (:nama, :jenis_kelamin, :alamat, :no_telp)";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    
    // Bind parameters to prevent SQL injection
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':no_telp', $no_telp);
    
    // Execute the query
    if ($stmt->execute()) {
        header("Location: indexv2.php");
        exit();
    } else {
        echo "Gagal menambahkan data.";
    }

} elseif ($aksi == 'ubah') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare the UPDATE query using PDO
        $query = "UPDATE anggota SET nama = :nama, jenis_kelamin = :jenis_kelamin, alamat = :alamat, no_telp = :no_telp WHERE id = :id";
        
        // Prepare and execute the query
        $stmt = $conn->prepare($query);
        
        // Bind parameters to prevent SQL injection
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':no_telp', $no_telp);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the query
        if ($stmt->execute()) {
            header("Location: indexv2.php");
            exit();
        } else {
            echo "Gagal mengupdate data.";
        }
    } else {
        echo "ID tidak valid.";
    }

} elseif ($aksi == 'hapus') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare the DELETE query using PDO
        $query = "DELETE FROM anggota WHERE id = :id";

        // Prepare and execute the query
        $stmt = $conn->prepare($query);

        // Bind the ID parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            header("Location: indexv2.php");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "ID tidak valid.";
    }

} else {
    // If no valid action, redirect to the index page
    header("Location: indexv2.php");
}

// Close the PDO connection
$conn = null;
?>