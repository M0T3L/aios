<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>IP Adresi Formu</title>
</head>
<body>

<div class="container mt-5">
    <form id="ip">
        <div class="form-group">
            <label for="ipAddress">IP Adresi:</label>
            <input type="text" class="form-control" id="ipAddress" placeholder="Örneğin: 192.168.0.1" required>
            <small id="ipError" class="form-text text-danger"></small>
        </div>
        <button type="button" class="btn btn-primary" onclick="validateIP()">Gönder</button>
    </form>
    <mat-form-field class="form-element">
<input
matInput
placeholder="Ip"
name="ip"
[(ngModel)]="ip"
required
pattern="^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$"
[disabled]="data.btnDisabled"
/>
</mat-form-field>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
        crossorigin="anonymous"></script>
<script src="src/ipInput.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

