<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Superhéroe</title>
    <?= $estilos ?>
</head>
<body>
    <h1>Reporte de Superhéroe</h1>

    <table class="table mb-2">
        <colgroup>
            <col style="width: 10%;">
            <col style="width: 30%;">
            <col style="width: 30%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
        </colgroup>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nombre completo</th>
                <th>Editorial</th>
                <th>Alineación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= esc($rows[0]['id']) ?></td>
                <td><?= esc($rows[0]['superhero_name']) ?></td>
                <td><?= esc($rows[0]['full_name']) ?></td>
                <td><?= esc($rows[0]['publisher_name']) ?></td>
                <td><?= esc($rows[0]['alignment']) ?></td>
            </tr>
        </tbody>
    </table>

    <h2>Atributos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Atributo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= esc($row['attribute_name']) ?></td>
                    <td><?= esc($row['attribute_value']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
