<!DOCTYPE html>
<?php include("functions/_check.php");?>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAYKUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("partials/_navbar.php");?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="scan-form" action="tools/_nmap.php" method="get">
                <div class="mb-3">
                <input type="text" class="form-control" id="scanInput" name="ip" placeholder="xxx.xxx.xxx.xxx" pattern="\b(?:\d{1,3}\.){3}\d{1,3}\b" required>
                </div>
                <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sT" name="sT">
                <label class="form-check-label" for="sT">Use -sT</label>
                </div>
                <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sC" name="sC">
                <label class="form-check-label" for="sU">Use -sC</label>
                </div>
                <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sV" name="sV">
                <label class="form-check-label" for="sV">Use -sV</label>
                </div>
                <div class="mb-3">
                <div class="form-check">
                <input type="checkbox" class="form-check-input" id="usePort" name="usePort">
                <label class="form-check-label" for="usePort">Specify Port</label>
                </div>
                <input type="text" class="form-control" id="portInput" name="port" placeholder="Port Number" pattern="\d+" disabled>
                </div>
                <button type="submit" id="scan-button" class="btn btn-primary">Scan</button>
                </form>
                <script>
                document.getElementById('usePort').addEventListener('change', function () {
                document.getElementById('portInput').disabled = !this.checked;
                });
                </script>
                <br>
                <div id="result-container">
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('scan-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);
        document.getElementById('result-container').innerHTML = '<pre>Scanning...</pre>';
        var xhr = new XMLHttpRequest();
        xhr.open(form.method, form.action + '?' + new URLSearchParams(formData).toString(), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('result-container').innerHTML = xhr.responseText;
            } else {
                console.error('Error. Code: ' + xhr.status);
            }
            document.getElementById('scan-button').disabled = false;
        };
        xhr.onerror = function() {
            console.error('Error!');
            document.getElementById('scan-button').disabled = false;
        };
        document.getElementById('scan-button').disabled = true;
        xhr.send();
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
