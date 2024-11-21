<!DOCTYPE html>
<html>
    <head>
        <title>Data Anggota</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-4">
            <h2>Data Anggota</h2>
            <a class="btn btn-success mt-2" href="createv2.php">Tambah Data</a>
            <br><br>
            <?php
                // Include the database connection file
                include('konek.php');

                // Query to fetch data from SQL Server
                $query = "SELECT * FROM anggota ORDER BY id DESC";

                // Execute the query on SQL Server
                $stmt = $conn->query($query);

                // Check if the query failed
                if ($stmt === false) {
                    die(print_r($conn->errorInfo(), true)); // Print error details
                }
            ?>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        // Fetch the rows using sqlsrv_fetch_array
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Convert gender 'L' and 'P' to readable format
                            $kelamin = ($row["jenis_kelamin"] == "L") ? 'Laki-laki' : 'Perempuan';
                    ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$row["nama"]?></td>
                        <td><?=$kelamin?></td>
                        <td><?=$row["alamat"]?></td>
                        <td><?=$row["no_telp"]?></td>
                        <td>
                            <!-- Edit and Delete buttons -->
                            <a class="btn btn-primary" href="editv2.php?id=<?=$row["id"]?>">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle='modal' data-target='#hapusModal<?=$row["id"]?>'>Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal for Delete Confirmation -->
                    <div class="modal fade" id='hapusModal<?= $row["id"] ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class="modal-dialog" role='document'>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= "Apakah Anda yakin ingin menghapus data dengan nama " . $row["nama"] . "?" ?>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="proses.php?aksi=hapus&id=<?= $row["id"] ?>">Hapus</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss='modal'>Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Include necessary JS for Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>