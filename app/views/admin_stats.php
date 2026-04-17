<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=login');
    exit;
}

//  préparation données
$labels = [];
$dataOrders = [];
$dataRevenue = [];

$maxOrders = 0;
$maxRevenue = 0;

foreach ($ordersData as $index => $item) {

    $labels[] = $item['_id'];

    $orders = $item['total_orders'];
    $revenue = $revenueData[$index]['total_revenue'] ?? 0;

    $dataOrders[] = $orders;
    $dataRevenue[] = $revenue;

    $maxOrders = max($maxOrders, $orders);
    $maxRevenue = max($maxRevenue, $revenue);
}
?>

<h2 class="mb-4">📊 Dashboard Admin</h2>


<div class="row mb-4">

<?php foreach ($ordersData as $index => $item): 

    $orders = $item['total_orders'];
    $revenue = $revenueData[$index]['total_revenue'] ?? 0;

    $ordersPercent = $maxOrders > 0 ? ($orders / $maxOrders) * 100 : 0;
    $color = $ordersPercent > 70 ? 'success' : ($ordersPercent > 40 ? 'warning' : 'danger');
?>

    <div class="col-md-3 mb-3">
        <div class="card shadow border-0 p-3 h-100">

            <h5 class="text-center"><?= $item['_id'] ?></h5>

            <div class="text-center my-2">
                <span class="badge bg-<?= $color ?>">
                    <?= $orders ?> commandes
                </span>
            </div>

            <div class="text-center text-success fw-bold">
                💰 <?= $revenue ?> €
            </div>

        </div>
    </div>

<?php endforeach; ?>

</div>

<!--  GRAPHIQUES -->
<div class="row">

    <div class="col-md-6">
        <div class="card p-3 shadow border-0">
            <h5 class="text-center">📦 Commandes par menu</h5>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-3 shadow border-0">
            <h5 class="text-center">💰 Chiffre d'affaires</h5>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

//  COMMANDES
new Chart(document.getElementById('ordersChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Commandes',
            data: <?= json_encode($dataOrders) ?>
        }]
    }
});

// 💰 REVENUE
new Chart(document.getElementById('revenueChart'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Chiffre d\'affaires',
            data: <?= json_encode($dataRevenue) ?>
        }]
    }
});

</script>

<style>
.card {
    border-radius: 15px;
}

canvas {
    max-height: 300px;
}
</style>