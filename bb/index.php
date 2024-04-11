<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "administratif_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aldeia_id = $_POST['aldeia'];
    $pos_administrativo = $_POST['posto_administrativo'];  // Menggunakan value dari select untuk Nama Pos Administratif

    $sql_insert = "INSERT INTO posto_administrativo (nama, suku_id) VALUES ('$pos_administrativo', $aldeia_id)";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjM" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container mt-5">
        <form method="post" action="" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <label>Nama Municipio:</label>
                    <select name="municipio" id="municipio" class="form-select">
                        <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM municipio";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada data</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Nama Posto Administrativo:</label>
                    <select name="posto_administrativo" id="posto_administrativo" class="form-select">
                        <!-- Opsi akan diisi berdasarkan pilihan municipio yang dipilih -->
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Nama Suku:</label>
                    <select name="suku" id="suku" class="form-select">
                        <!-- Opsi akan diisi berdasarkan pilihan posto administrativo yang dipilih -->
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Nama Aldeia:</label>
                    <select name="aldeia" id="aldeia" class="form-select">
                        <!-- Opsi akan diisi berdasarkan pilihan suku yang dipilih -->
                    </select>
                </div>

                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary d-block w-100">
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const municipioSelect = document.getElementById('municipio');
            const postoAdministrativoSelect = document.getElementById('posto_administrativo');
            const sukuSelect = document.getElementById('suku');
            const aldeiaSelect = document.getElementById('aldeia');

            municipioSelect.addEventListener('change', function() {
                const municipioId = this.value;
                fetch('get_data.php?table=posto_administrativo&municipio_id=' + municipioId)
                    .then(response => response.json())
                    .then(data => {
                        postoAdministrativoSelect.innerHTML = '<option value="">Pilih Posto Administrativo</option>';
                        data.forEach(item => {
                            postoAdministrativoSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                        });
                    });
            });

            postoAdministrativoSelect.addEventListener('change', function() {
                const postoAdministrativoId = this.value;
                fetch('get_data.php?table=suku&posto_administrativo_id=' + postoAdministrativoId)
                    .then(response => response.json())
                    .then(data => {
                        sukuSelect.innerHTML = '<option value="">Pilih Suku</option>';
                        data.forEach(item => {
                            sukuSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                        });
                    });
            });

            sukuSelect.addEventListener('change', function() {
                const sukuId = this.value;
                fetch('get_data.php?table=aldeia&suku_id=' + sukuId)
                    .then(response => response.json())
                    .then(data => {
                        aldeiaSelect.innerHTML = '<option value="">Pilih Aldeia</option>';
                        data.forEach(item => {
                            aldeiaSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                        });
                    });
            });
        });
    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>