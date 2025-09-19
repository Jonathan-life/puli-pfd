<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Reporte Superhéroes</title>
  <?= $estilos ?>
</head>
<body>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">

  <page_header>
    <div style="text-align: right; font-size: 10pt; color: gray;">
      Página [[page_cu]] de [[page_nb]]
    </div>
  </page_header>

  <page_footer>
    <div style="text-align: center; font-size: 9pt; color: gray;">
      Lista de Superhéroes - Reporte generado por tu aplicación
    </div>
  </page_footer>

  <h1 style="text-align:center; margin-bottom: 15px;">Listado de Superhéroes</h1>

  <table class="table" cellspacing="0" cellpadding="5" border="1" style="width: 100%; border-collapse: collapse; font-size: 12pt;">
    <thead style="background-color: #f2f2f2;">
      <tr>
        <th style="width: 5%;">ID</th>
        <th style="width: 25%;">Nombre</th>
        <th style="width: 25%;">Alias</th>
        <th style="width: 25%;">Casa</th>
        <th style="width: 20%;">Bando</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
          <tr>
            <td><?= esc($row['id']) ?></td>
            <td><?= esc($row['superhero_name']) ?></td>
            <td><?= esc($row['full_name']) ?></td>
            <td><?= esc($row['publisher_name']) ?></td>
            <td><?= esc($row['alignment']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" style="text-align:center;">No hay datos para mostrar.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</page>

</body>
</html>
