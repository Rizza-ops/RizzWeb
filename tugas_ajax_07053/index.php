<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Live Search Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .search-container {
      max-width: 700px;
      margin: auto;
      background-color: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    #search {
      border-radius: 10px;
      padding: 12px;
    }

    table th, table td {
      vertical-align: middle;
    }

    .table-container {
      margin-top: 25px;
    }

    #loading {
      display: none;
    }
  </style>
</head>
<body class="py-5">
  <div class="container">
    <div class="search-container">
      <h3 class="text-center mb-4 text-primary fw-bold">Live Search Mahasiswa</h3>
      
      <input type="text" id="search" class="form-control mb-3" placeholder="Ketik nama, NIM, atau jurusan...">
      
      <div id="loading" class="text-center my-3">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <div class="table-container">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-light">
            <tr class="text-center">
              <th>NIM</th>
              <th>Nama</th>
              <th>Jurusan</th>
            </tr>
          </thead>
          <tbody id="result" class="text-center"></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Aesthetic Footer -->
  <footer class="text-center mt-5">
    <p class="text-muted" style="font-size: 0.9rem;">
     <strong>Rizza Husna Aufa Putra</strong> <br>
      <span style="font-style: italic;">A12.2023.07053</span>
    </p>
  </footer>

  <script>
    const searchBox = document.getElementById("search");
    const result = document.getElementById("result");
    const loading = document.getElementById("loading");

    searchBox.addEventListener("keyup", function() {
      const keyword = searchBox.value.trim();
      if (keyword.length === 0) {
        result.innerHTML = "";
        return;
      }

      loading.style.display = "block";

      fetch("search.php?keyword=" + encodeURIComponent(keyword))
        .then(res => res.json())
        .then(data => {
          setTimeout(() => {
            loading.style.display = "none";
            result.innerHTML = "";

            if (data.length === 0) {
              result.innerHTML = "<tr><td colspan='3' class='text-muted'>Data tidak ditemukan</td></tr>";
            } else {
              data.forEach(row => {
                const rowHtml = `<tr style="display: none">
                  <td>${row.nim}</td>
                  <td>${row.nama}</td>
                  <td>${row.jurusan}</td>
                </tr>`;
                result.insertAdjacentHTML('beforeend', rowHtml);
                $('#result tr:last-child').fadeIn(300);
              });
            }
          }, 200);
        });
    });
  </script>
</body>
</html>
