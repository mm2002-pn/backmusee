<!-- Performances -->
<div class="container-fluid w-100">
    <div class="row mb-2 shodow-none m-0 p-0">
        <div class="col-md-12 m-0 p-0">
            <!-- Cartes de statistiques principales -->
            <div class="row shadow-none bg-white">
                <div class="col-xl-3 col-md-6 shadow-none m-0  bg-transparent">
                    <div class="card shadow-none m-0  bg-transparentt">
                        <div class="card-body">
                            <div class="row shadow-none bg-white">
                                <div class="col shadow-none bg-white">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Visiteurs Total</h5>
                                    <span class="h2 font-weight-bold mb-0">12,458</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 15.8%</span>
                                <span class="text-nowrap">vs mois dernier</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 shadow-none m-0  bg-transparent">
                    <div class="card card-stats m-0 p-0 bg-transparent">
                        <div class="card-body">
                            <div class="row shadow-none bg-white">
                                <div class="col shadow-none bg-white">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Revenus Total</h5>
                                    <span class="h2 font-weight-bold mb-0">18.7M FCFA</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="fa fa-money-bill"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 22.3%</span>
                                <span class="text-nowrap">vs trimestre dernier</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 shadow-none m-0  bg-transparent">
                    <div class="card card-stats m-0 p-0 bg-transparent">
                        <div class="card-body">
                            <div class="row shadow-none bg-white">
                                <div class="col shadow-none bg-white">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Œuvres Numérisées</h5>
                                    <span class="h2 font-weight-bold mb-0">85%</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fa fa-qrcode"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 12.5%</span>
                                <span class="text-nowrap">progression mensuelle</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 shadow-none m-0  bg-transparent">
                    <div class="card card-stats m-0 p-0 bg-transparent">
                        <div class="card-body">
                            <div class="row shadow-none bg-white">
                                <div class="col shadow-none bg-white">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Satisfaction</h5>
                                    <span class="h2 font-weight-bold mb-0">94%</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.2%</span>
                                <span class="text-nowrap">vs dernier mois</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques de performance -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Performance des Visiteurs - 6 Derniers Mois</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="performanceVisiteursChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Sources des Visiteurs</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="sourcesVisiteursChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableaux de performance détaillés -->
            <div class="row mt-4">
                <div class="col-md-6 shadow-none m-0  bg-transparent">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Top 5 des Œuvres les Plus Consultées</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Œuvre</th>
                                            <th>Salle</th>
                                            <th>Consultations</th>
                                            <th>Temps Moyen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Plaque Oba Ozolua</td>
                                            <td>Art Royal</td>
                                            <td>1,245</td>
                                            <td>4m 32s</td>
                                        </tr>
                                        <tr>
                                            <td>Armure Dogon</td>
                                            <td>Spiritualité</td>
                                            <td>987</td>
                                            <td>3m 15s</td>
                                        </tr>
                                        <tr>
                                            <td>Déesse Sekhmet</td>
                                            <td>Civilisations</td>
                                            <td>856</td>
                                            <td>5m 12s</td>
                                        </tr>
                                        <tr>
                                            <td>Portrait Oba Oguola</td>
                                            <td>Art Royal</td>
                                            <td>723</td>
                                            <td>3m 45s</td>
                                        </tr>
                                        <tr>
                                            <td>Œuvre Contemporaine</td>
                                            <td>Art Moderne</td>
                                            <td>654</td>
                                            <td>2m 58s</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 shadow-none m-0  bg-transparent">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Performance des Activités</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Activité</th>
                                            <th>Participants</th>
                                            <th>Taux de Remplissage</th>
                                            <th>Satisfaction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Atelier Poterie</td>
                                            <td>156</td>
                                            <td>92%</td>
                                            <td>96%</td>
                                        </tr>
                                        <tr>
                                            <td>Visite Guidée</td>
                                            <td>289</td>
                                            <td>85%</td>
                                            <td>94%</td>
                                        </tr>
                                        <tr>
                                            <td>Contes Africains</td>
                                            <td>203</td>
                                            <td>78%</td>
                                            <td>98%</td>
                                        </tr>
                                        <tr>
                                            <td>Danses Traditionnelles</td>
                                            <td>187</td>
                                            <td>88%</td>
                                            <td>95%</td>
                                        </tr>
                                        <tr>
                                            <td>Atelier Sculpture</td>
                                            <td>134</td>
                                            <td>95%</td>
                                            <td>97%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métriques d'engagement digital -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Engagement Digital - Scan QR Codes</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="card bg-gradient-primary text-white">
                                        <div class="card-body">
                                            <h3>4,258</h3>
                                            <p>Scans Total</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-gradient-success text-white">
                                        <div class="card-body">
                                            <h3>68%</h3>
                                            <p>Taux d'Utilisation</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-gradient-info text-white">
                                        <div class="card-body">
                                            <h3>12m 45s</h3>
                                            <p>Temps Moyen par Scan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-gradient-warning text-white">
                                        <div class="card-body">
                                            <h3>3.2</h3>
                                            <p>Œuvres Moyennes Consultées</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique d'engagement temporel -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Affluence Horaire - Moyenne Hebdomadaire</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="affluenceHoraireChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique de performance des visiteurs
    const perfVisiteursCtx = document.getElementById('performanceVisiteursChart');
    new Chart(perfVisiteursCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Visiteurs Physiques',
                data: [1850, 2100, 2450, 1980, 2670, 3120],
                borderColor: 'rgba(41, 128, 185, 1)',
                backgroundColor: 'rgba(41, 128, 185, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Visiteurs Virtuels',
                data: [1250, 1450, 1670, 1890, 2150, 2430],
                borderColor: 'rgba(46, 204, 113, 1)',
                backgroundColor: 'rgba(46, 204, 113, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Évolution de la Fréquentation'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de Visiteurs'
                    }
                }
            }
        }
    });

    // Graphique des sources de visiteurs
    const sourcesCtx = document.getElementById('sourcesVisiteursChart');
    new Chart(sourcesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Site Web', 'Réseaux Sociaux', 'Recommandation', 'Presse', 'Autres'],
            datasets: [{
                data: [35, 25, 20, 12, 8],
                backgroundColor: [
                    'rgba(41, 128, 185, 0.7)',
                    'rgba(52, 152, 219, 0.7)',
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(155, 89, 182, 0.7)',
                    'rgba(241, 196, 15, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Graphique d'affluence horaire
    const affluenceCtx = document.getElementById('affluenceHoraireChart');
    new Chart(affluenceCtx, {
        type: 'bar',
        data: {
            labels: ['9h', '10h', '11h', '12h', '13h', '14h', '15h', '16h', '17h'],
            datasets: [{
                label: 'Nombre de Visiteurs',
                data: [45, 120, 185, 95, 65, 210, 175, 140, 80],
                backgroundColor: 'rgba(230, 126, 34, 0.7)',
                borderColor: 'rgba(230, 126, 34, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Visiteurs'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Heures de la Journée'
                    }
                }
            }
        }
    });
</script>

<style>
.card-stats m-0 p-0 bg-transparent {
    transition: transform 0.2s;
}
.card-stats m-0 p-0 bg-transparent:hover {
    transform: translateY(-5px);
}
.icon-shape {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-gradient-red {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
}
.bg-gradient-orange {
    background: linear-gradient(45deg, #e67e22, #d35400);
}
.bg-gradient-green {
    background: linear-gradient(45deg, #27ae60, #229954);
}
.bg-gradient-info {
    background: linear-gradient(45deg, #3498db, #2980b9);
}
.bg-gradient-primary {
    background: linear-gradient(45deg, #2c3e50, #34495e);
}
.bg-gradient-success {
    background: linear-gradient(45deg, #27ae60, #229954);
}
.bg-gradient-warning {
    background: linear-gradient(45deg, #f39c12, #e67e22);
}
</style>