<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fiscal</title>
</head>
<body>
    <form action="{{ route('getresult') }}" method="GET">
        <label for="fiscal">Fiscal Number</label>
        <input type="text" id="fiscal" name="fiscal" placeholder="Input fiscal">
        <label for="facture">Reference Number</label>
        <input type="text" id="facture" name="facture" placeholder="Input facture">
        <input type="submit" value="Submit">
        
    </form>
</body>
</html>