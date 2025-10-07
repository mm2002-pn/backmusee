<!-- dashboard.blade.php -->
<div class="container">
    <div class="row  shadow-none p-3">
        <!-- Graphique des inscriptions aux activités -->
        <div class="col-md-6 shadow-none">
            <div class="card shadow-none">
                <div class="card-header">
                    <h5>Inscriptions aux Activités</h5>
                </div>
                <div class="card-body">
                    <canvas id="inscriptionsChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique des ventes de billets par catégorie -->
        <div class="col-md-6 shadow-none">
            <div class="card shadow-none">
                <div class="card-header">
                    <h5>Ventes de Billets par Catégorie</h5>
                </div>
                <div class="card-body">
                    <canvas id="billetsChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique des produits les plus vendus -->
        <div class="col-md-6 shadow-none">
            <div class="card shadow-none">
                <div class="card-header">
                    <h5>Produits les Plus Vendus</h5>
                </div>
                <div class="card-body">
                    <canvas id="produitsChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique des statistiques des œuvres -->
        <div class="col-md-6 shadow-none">
            <div class="card shadow-none">
                <div class="card-header">
                    <h5>Répartition des Œuvres par Salle</h5>
                </div>
                <div class="card-body">
                    <canvas id="oeuvresChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique des revenus -->
        <div class="col-md-12">
            <div class="card shadow-none">
                <div class="card-header">
                    <h5>Revenus Mensuels</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenusChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique des inscriptions aux activités
    const inscriptionsCtx = document.getElementById('inscriptionsChart');
    new Chart(inscriptionsCtx, {
        type: 'bar',
        data: {
            labels: ['Poterie', 'Visite Guidée', 'Contes', 'Danses'],
            datasets: [{
                label: 'Nombre d\'inscriptions',
                data: [8, 15, 12, 20],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Popularité des Activités'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre d\'inscriptions'
                    }
                }
            }
        }
    });

    // Graphique des ventes de billets
    const billetsCtx = document.getElementById('billetsChart');
    new Chart(billetsCtx, {
        type: 'doughnut',
        data: {
            labels: ['Adulte', 'Enfant', 'Étudiant', 'Groupe'],
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: [
                    'rgba(41, 128, 185, 0.7)',
                    'rgba(52, 152, 219, 0.7)',
                    'rgba(93, 173, 226, 0.7)',
                    'rgba(174, 214, 241, 0.7)'
                ],
                borderColor: [
                    'rgba(41, 128, 185, 1)',
                    'rgba(52, 152, 219, 1)',
                    'rgba(93, 173, 226, 1)',
                    'rgba(174, 214, 241, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Répartition des Ventes de Billets'
                }
            }
        }
    });

    // Graphique des produits les plus vendus (CORRIGÉ)
    const produitsCtx = document.getElementById('produitsChart');
    new Chart(produitsCtx, {
        type: 'bar',
        data: {
            labels: ['Livres Art', 'Répliques', 'Impressions', 'Bijoux', 'T-shirts'],
            datasets: [{
                label: 'Quantité vendue',
                data: [28, 15, 42, 22, 35],
                backgroundColor: 'rgba(46, 204, 113, 0.7)',
                borderColor: 'rgba(46, 204, 113, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y', // Cette propriété rend le graphique horizontal
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Performance des Produits de la Boutique'
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Unités vendues'
                    }
                }
            }
        }
    });

    // Graphique des œuvres par salle
    const oeuvresCtx = document.getElementById('oeuvresChart');
    new Chart(oeuvresCtx, {
        type: 'pie',
        data: {
            labels: ['Art Royal', 'Spiritualité', 'Civilisations', 'Art Contemporain'],
            datasets: [{
                data: [2, 1, 1, 1],
                backgroundColor: [
                    'rgba(155, 89, 182, 0.7)',
                    'rgba(142, 68, 173, 0.7)',
                    'rgba(125, 60, 152, 0.7)',
                    'rgba(108, 52, 131, 0.7)'
                ],
                borderColor: [
                    'rgba(155, 89, 182, 1)',
                    'rgba(142, 68, 173, 1)',
                    'rgba(125, 60, 152, 1)',
                    'rgba(108, 52, 131, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Répartition des Œuvres par Salle'
                }
            }
        }
    });

    // Graphique des revenus mensuels
    const revenusCtx = document.getElementById('revenusChart');
    new Chart(revenusCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Revenus (FCFA)',
                data: [1250000, 980000, 1560000, 1420000, 1890000, 2100000, 1950000, 1760000, 1630000, 1480000, 1320000, 1580000],
                backgroundColor: 'rgba(230, 126, 34, 0.1)',
                borderColor: 'rgba(230, 126, 34, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Évolution des Revenus Mensuels'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenus (FCFA)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' F';
                        }
                    }
                }
            }
        }
    });
</script>