<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fiscal</title>
</head>
<body>
    <form action="{{ route('res') }}" method="GET">
        <label for="fiscal">Email address</label>
        <input type="text" id="fiscal" name="user" placeholder="Input email">
        <label for="facture">Password</label>
        <input type="text" id="facture" name="password" placeholder="Input password">
        <input type="submit" value="Submit">
        
    </form>
</body>
</html>