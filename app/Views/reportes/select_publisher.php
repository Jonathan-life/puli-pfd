<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Seleccionar Editorial</title>
</head>
<body>
    <h1>Selecciona la editorial para generar el PDF</h1>

<form action="<?= site_url('reportes/generar') ?>" method="post">
  <select name="publisher_id" required>
    <option value="">-- Seleccione --</option>
    <?php foreach($publishers as $pub): ?>
      <option value="<?= esc($pub['id']) ?>"><?= esc($pub['publisher_name']) ?></option>
    <?php endforeach; ?>
  </select>
  <button type="submit">Generar PDF</button>
</form>

</body>
</html>
