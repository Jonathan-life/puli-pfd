<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Reporte de Superhéroes</title>
</head>
<body>
    <?= $estilos ?? '' ?>

    <h1>Reporte de Superhéroes</h1>

    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Alias</th>
                <th>Editorial</th>
                <th>Bando</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row): ?>
                <tr>
                    <td><?= esc($row['id']) ?></td>
                    <td><?= esc($row['superhero_name']) ?></td>
                    <td><?= esc($row['full_name']) ?></td>
                    <td><?= esc($row['publisher_name']) ?></td>
                    <td><?= esc($row['alignment']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
