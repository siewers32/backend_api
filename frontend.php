
<?php
    $api = "api.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontend</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <p><a href="<?= $api ?>?q=all">All cars</a></p>
    <h3>Search Car</h3>
    <form id="search" action="<?= $api ?>?q=search" method="POST">
        <label>
            Kenteken
            <input type="text" name="Kenteken">
        </label>
        <input type="submit">
    </form>
    <h3>Create Car</h3>
    <form id="create" action="<?= $api ?>?q=create" method="POST">
        <label>
            Kenteken
            <input type="text" name="Kenteken">
        </label>
        <label>
            Kilometerstand
            <input type="text" name="Kilometerstand">
        </label>
        <label>
            Merk
            <input type="text" name="Merk">
        </label>
        <label>
            Type
            <input type="text" name="Type">
        </label>
        <label>
            DatumAPK
            <input type="text" name="DatumAPK">
        </label>
        <input type="submit">
    </form>
    <h3>Delete Car</h3>
    <form id="delete" action="<?= $api ?>?q=delete" method="POST">
        <label>
            Kenteken
            <input type="text" name="Kenteken">
        </label>
        <input type="submit">
    </form>
    <h3>Update Car</h3>
    <form id="update" action="<?= $api ?>?q=update" method="POST">
        <label>
            Kenteken
            <input type="text" name="Kenteken">
        </label>
        <label>
            Kilometerstand
            <input type="text" name="Kilometerstand">
        </label>
        <label>
            Merk
            <input type="text" name="Merk">
        </label>
        <label>
            Type
            <input type="text" name="Type">
        </label>
        <label>
            DatumAPK
            <input type="text" name="DatumAPK">
        </label>
        <input type="submit">
    </form>
</body>

</html>