<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Por horas — <?= htmlspecialchars($nombre) ?></title>
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
    <?php if (!$data): ?>
        <div class="alert alert-danger">No se pudieron obtener los datos.</div>
    <?php else: ?>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">⏱️ Próximas 24h — <?= htmlspecialchars($nombre) ?></h5>
            <div class="d-flex gap-3 overflow-auto pb-2">
                <?php foreach ($horas as $item): ?>
                <div class="card text-center flex-shrink-0" style="min-width:90px">
                    <div class="card-body p-2">
                        <small class="text-primary fw-bold"><?= date('H:i', $item['dt']) ?></small>
                        <img src="https://openweathermap.org/img/wn/<?= $item['weather'][0]['icon'] ?>.png" width="40" class="d-block mx-auto">
                        <div class="fw-bold"><?= round($item['main']['temp']) ?>°</div>
                        <small class="text-muted">💧<?= $item['main']['humidity'] ?>%</small>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="card shadow-sm"><div class="card-body"><canvas id="grafica" height="100"></canvas></div></div>
    <script>
    new Chart(document.getElementById('grafica'), {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{ label: 'Temp °C', data: <?= json_encode($temps) ?>,
                borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,0.08)', fill: true, tension: 0.4 }]
        },
        options: { plugins: { legend: { display: false } } }
    });
    </script>
    <?php endif; ?>
</div>
</body>
</html>
