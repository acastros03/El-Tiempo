<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actual — <?= htmlspecialchars($nombre) ?></title>
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
    <?php if (!$t): ?>
        <div class="alert alert-danger">No se pudieron obtener los datos.</div>
    <?php else: ?>
    <div class="card shadow-sm mb-4 text-white bg-primary">
        <div class="card-body d-flex align-items-center gap-3">
            <img src="https://openweathermap.org/img/wn/<?= $t['weather'][0]['icon'] ?>@2x.png" width="90">
            <div>
                <div style="font-size:3.5rem;font-weight:700;line-height:1"><?= round($t['main']['temp']) ?>°C</div>
                <div><?= ucfirst($t['weather'][0]['description']) ?></div>
                <small>Sensación <?= round($t['main']['feels_like']) ?>°C · <?= htmlspecialchars($nombre) ?>, <?= htmlspecialchars($pais) ?></small>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-4"><div class="card shadow-sm text-center p-3"><div>💧</div><small class="text-muted">Humedad</small><div class="fw-bold"><?= $t['main']['humidity'] ?>%</div></div></div>
        <div class="col-4"><div class="card shadow-sm text-center p-3"><div>💨</div><small class="text-muted">Viento</small><div class="fw-bold"><?= round($t['wind']['speed']*3.6) ?> km/h</div></div></div>
        <div class="col-4"><div class="card shadow-sm text-center p-3"><div>🌡</div><small class="text-muted">Presión</small><div class="fw-bold"><?= $t['main']['pressure'] ?> hPa</div></div></div>
        <div class="col-4"><div class="card shadow-sm text-center p-3"><div>☁️</div><small class="text-muted">Nubosidad</small><div class="fw-bold"><?= $t['clouds']['all'] ?>%</div></div></div>
        <div class="col-4"><div class="card shadow-sm text-center p-3"><div>👁</div><small class="text-muted">Visibilidad</small><div class="fw-bold"><?= isset($t['visibility']) ? round($t['visibility']/1000,1).' km' : 'N/D' ?></div></div></div>
        <div class="col-4"><div class="card shadow-sm text-center p-3"><div>🌅</div><small class="text-muted">Amanecer</small><div class="fw-bold"><?= date('H:i', $t['sys']['sunrise'] + $t['timezone']) ?></div></div></div>
    </div>
    <div class="card shadow-sm"><div class="card-body"><canvas id="grafica" height="110"></canvas></div></div>
    <script>
    new Chart(document.getElementById('grafica'), {
        type: 'bar',
        data: {
            labels: ['Temp (°C)', 'Sensación (°C)', 'Humedad (%)', 'Nubosidad (%)', 'Viento (km/h)'],
            datasets: [{ data: [<?= round($t['main']['temp'],1) ?>, <?= round($t['main']['feels_like'],1) ?>, <?= $t['main']['humidity'] ?>, <?= $t['clouds']['all'] ?>, <?= round($t['wind']['speed']*3.6,1) ?>],
                backgroundColor: ['#ef4444','#f97316','#3b82f6','#94a3b8','#8b5cf6'], borderRadius: 8 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });
    </script>
    <?php endif; ?>
</div>
</body>
</html>
