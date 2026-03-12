<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial — El Tiempo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand">⛅ El Tiempo</a>
    </div>
</nav>
<div class="container py-4" style="max-width:700px">
    <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">📋 Historial de consultas</h5>
            <?php if (empty($consultas)): ?>
                <p class="text-muted text-center py-4">No hay consultas todavía.</p>
            <?php else: ?>
            <table class="table table-hover">
                <thead><tr><th>Ciudad</th><th>País</th><th>Tipo</th><th>Fecha</th></tr></thead>
                <tbody>
                    <?php foreach ($consultas as $c): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($c['nombre']) ?></strong></td>
                        <td><?= htmlspecialchars($c['pais']) ?></td>
                        <td><span class="badge bg-primary"><?= htmlspecialchars($c['tipo']) ?></span></td>
                        <td class="text-muted small"><?= $c['fecha'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
