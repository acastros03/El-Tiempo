<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>El Tiempo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">⛅ El Tiempo</span>
        <a href="historial.php" class="btn btn-outline-light btn-sm">📋 Historial</a>
    </div>
</nav>
<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width:600px">
        <div class="card-body text-center py-5">
            <div style="font-size:3rem">🌍</div>
            <h2 class="fw-bold mt-2">¿Qué tiempo hace hoy?</h2>
            <p class="text-muted">Busca cualquier ciudad del mundo.</p>
            <form method="POST" class="d-flex gap-2 justify-content-center mt-3">
                <input type="text" name="ciudad" class="form-control w-auto"
                    placeholder="Ej: Madrid, Tokyo..."
                    value="<?= htmlspecialchars($_POST['ciudad'] ?? '') ?>" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger mt-3"><?= $error ?></div>
            <?php endif; ?>
        </div>
        <?php if (!empty($ciudades)): ?>
        <ul class="list-group list-group-flush">
            <?php foreach ($ciudades as $c): ?>
            <li class="list-group-item">
                <a href="ciudad.php?lat=<?= $c['lat'] ?>&lon=<?= $c['lon'] ?>&nombre=<?= urlencode($c['name']) ?>&pais=<?= urlencode($c['country'] ?? '') ?>"
                   class="d-flex justify-content-between text-decoration-none text-dark">
                    <span>
                        <strong><?= htmlspecialchars($c['name']) ?></strong>
                        <small class="text-muted d-block"><?= htmlspecialchars($c['state'] ?? '') ?> · <?= htmlspecialchars($c['country'] ?? '') ?></small>
                    </span>
                    <span>→</span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
