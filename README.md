# Administratif Database Web App

This is a simple web application for managing administrative divisions like Municipio, Posto Administrativo, Suku, and Aldeia.

## Technologies Used

- PHP
- MySQL
- Bootstrap

## Setup

1. **Database Configuration**

    ```php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "administratif_db";
    ```

2. **Database Structure**

    - `municipio` table: `id`, `nama`
    - `posto_administrativo` table: `id`, `nama`, `suku_id`
    - `suku` table: `id`, `nama`, `posto_administrativo_id`
    - `aldeia` table: `id`, `nama`, `suku_id`

3. **Connect to Database**

    ```php
    $conn = new mysqli($servername, $username, $password, $dbname);
    ```

4. **Insert Data**

    When a `POST` request is made, the following data is inserted into the `posto_administrativo` table:

    ```php
    $sql_insert = "INSERT INTO posto_administrativo (nama, suku_id) VALUES ('$pos_administrativo', $aldeia_id)";
    ```

## How to Use

1. **Select Municipio**

    - Select a Municipio from the dropdown list.

2. **Select Posto Administrativo**

    - The Posto Administrativo dropdown will be populated based on the selected Municipio.

3. **Select Suku**

    - The Suku dropdown will be populated based on the selected Posto Administrativo.

4. **Select Aldeia**

    - The Aldeia dropdown will be populated based on the selected Suku.

5. **Save Data**

    - After selecting all the required data, click the "Simpan" button to save the data.

## Scripts

- `get_data.php`: Fetches data from the database based on the selected options.
  
    ```javascript
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
    ```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
