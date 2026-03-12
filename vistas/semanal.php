<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Semanal — <?= htmlspecialchars($nombre) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand">⛅ El Tiempo</a>
        <a href="historial.php" class="btn btn-outline-light btn-sm">📋 Historial</a>
    </div>
</nav>
<div class="container py-4" style="max-width:700px">
    <a href="ciudad.php?<?= $volver ?>" class="btn btn-outline-secondary btn-sm mb-3">← Volver a <?= htmlspecialchars($nombre) ?></a>
    <?php if (!$dias): ?>
        <div class="alert alert-danger">No se pudieron obtener los datos.</div>
    <?php else: ?>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">📅 Previsión semanal — <?= htmlspecialchars($nombre) ?></h5>
            <table class="table table-hover">
                <thead><tr><th>Día</th><th>Estado</th><th>Descripción</th><th class="text-danger">Máx</th><th class="text-primary">Mín</th></tr></thead>
                <tbody>
                    <?php foreach ($dias as $d): ?>
                    <tr>
                        <td><strong><?= date('D d/m', strtotime($d['fecha'])) ?></strong></td>
                        <td><img src="https://openweathermap.org/img/wn/<?= $d['icon'] ?>.png" width="38"></td>
                        <td><?= htmlspecialchars($d['desc']) ?></td>
<td class="text-danger fw-bold"><?= $d['temp_max'] ?>°C</td>
                        <td class="text-primary fw-bold"><?= $d['temp_min'] ?>°C</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow-sm"><div class="card-body"><canvas id="grafica" height="100"></canvas></div></div>
    <script>
    new Chart(document.getElementById('grafica'), {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [
                { label: 'Máx °C', data: <?= json_encode($maxTemps) ?>, borderColor: '#dc3545', backgroundColor: 'rgba(220,53,69,0.07)', fill: true, tension: 0.4 },
                { label: 'Mín °C', data: <?= json_encode($minTemps) ?>, borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,0.07)', fill: true, tension: 0.4 }
            ]
        },
        options: {}
    });
    </script>
    <?php endif; ?>
</div>
</body>
</html>
