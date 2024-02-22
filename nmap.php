<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aioS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("partials/_navbar.php");?>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="scan-form" action="partials/_nmap.php" method="get">
                    <div class="mb-3">
                        <label for="scanInput" class="form-label">Scan:</label>
                        <input type="text" class="form-control" id="scanInput" name="name" placeholder="Hedef IP/URL">
                    </div>
                    <button type="submit" class="btn btn-primary">Tara</button>
                </form>
                <br>
                <div id="result-container">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('scan-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var form = this;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action + '?' + new URLSearchParams(formData).toString(), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('result-container').innerHTML = xhr.responseText;
                } else {
                    console.error('Hata oluştu. Kod: ' + xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error('İstek hatası!');
            };
            xhr.send();
        });
    </script>
</body>
</html>
