<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($nombre) ?> — El Tiempo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand">⛅ El Tiempo</a>
        <a href="historial.php" class="btn btn-outline-light btn-sm">📋 Historial</a>
    </div>
</nav>
<div class="container py-4" style="max-width:700px">
    <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">← Volver</a>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="fw-bold">📍 <?= htmlspecialchars($nombre) ?>, <?= htmlspecialchars($pais) ?></h4>
            <p class="text-muted small mb-0">Lat: <?= round($lat,4) ?> · Lon: <?= round($lon,4) ?></p>
        </div>
    </div>
    <?php $p = "lat=$lat&lon=$lon&nombre=" . urlencode($nombre) . "&pais=" . urlencode($pais); ?>
    <div class="row g-3">
        <div class="col-4">
            <a href="actual.php?<?= $p ?>" class="card text-center text-decoration-none text-dark h-100 shadow-sm">
                <div class="card-body py-4">
                    <div style="font-size:2rem">🌡️</div>
                    <strong>Tiempo actual</strong>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="horas.php?<?= $p ?>" class="card text-center text-decoration-none text-dark h-100 shadow-sm">
                <div class="card-body py-4">
                    <div style="font-size:2rem">⏱️</div>
                    <strong>Por horas</strong>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="semanal.php?<?= $p ?>" class="card text-center text-decoration-none text-dark h-100 shadow-sm">
                <div class="card-body py-4">
                    <div style="font-size:2rem">📅</div>
                    <strong>Semanal</strong>
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
