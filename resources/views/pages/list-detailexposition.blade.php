<div class="container intro-x bg-white p-4">
    <!-- En-tête avec bouton retour et statistiques -->
    <div class="d-flex align-items-center mb-4 justify-content-between gap-1">
        <!-- Bouton retour -->
        <a href="#!list-exposition" class="btn bg-theme-gradient rounded-2 border-none px-2 py-2">
            <img src="{{ asset('images/back.png') }}" class="icon-size w-75" alt="">
        </a>

        <!-- Statistiques -->
        <div class="d-flex gap-3 flex-wrap bg-theme-secondary-grey rounded-3 p-1">
            <div class="stat-box px-3  rounded">
                Œuvres exposées <span class="stat-count px-2 py-1 rounded">25</span>
            </div>
            <div class="stat-box px-3  rounded">
                Visiteurs attendus <span class="stat-count px-2 py-1 rounded">1 200</span>
            </div>
            <div class="stat-box px-3  rounded">
                Salles utilisées <span class="stat-count px-2 py-1 rounded">3</span>
            </div>
        </div>
    </div>

    <!-- Informations de l'exposition -->
    <div class="card-module-info d-flex align-items-center mb-4">
        <div class=" rounded me-0">
            <img src="{{ asset('images/exposition.png') }}" class="icon-size w-50" alt="">
        </div>
        <div class="text-title me-auto">
            <span class="fw-normal">Informations de l'exposition</span>
        </div>
    </div>
    <hr>

    <!-- Informations fixes de l'exposition -->
    <div class="mb-4">
        <div class="d-flex gap-3 mb-3">
            <div class="w-100">
                <Label class="text-muted">Date de début</Label>
                <input type="text" class="form-control w-100" value="15 janvier 2024" readonly>
            </div>
            <div class="w-100">
                <Label class="text-muted">Date de fin</Label>
                <input type="text" class="form-control w-100" value="31 décembre 2024" readonly>
            </div>
        </div>

        <!-- Titre de l'exposition -->
        <div class="mb-3">
            <input type="text" class="form-control w-100" value="L'Afrique : Berceau de l'Humanité" readonly>
        </div>

        <!-- Description et détails -->
        <div class="d-flex gap-3">
            <textarea class="form-control" rows="5" readonly>Exposition majeure sur les découvertes fossiles de Toumaï et Dinknesh dans la Rift Valley et le désert tchadien. Ces témoins des origines du genre humain retracent la marche inexorable vers plus d'humanité, de technicité et d'inventivité.</textarea>
            <textarea class="form-control" rows="5" readonly>Commissaire: Dr. Amadou Diallo
Salle: Salle 1 - Origines
Collection: Origines Humaines
Statut: Active
Type: Exposition permanente
Entrée: Incluse dans le billet</textarea>
        </div>
    </div>

    <!-- Boutons d'action -->
    <div>
        <div class="d-flex justify-content-end mb-3 gap-2">
            <button class="btn btn-warning rounded-2">
                <i class="fa fa-edit me-2"></i> Modifier
            </button>
            <button class="btn btn-success rounded-2">
                <i class="fa fa-check me-2"></i> Publier
            </button>
        </div>
    </div>

    <!-- Grille de sections spécifiques aux expositions -->
    <div class="row mb-4 shadow-none bg-white">
        <!-- Section Œuvres exposées -->
        <div class="col-md-4 mb-3">
            <a href="#!list-oeuvres" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-palette fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Œuvres exposées</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (25 œuvres)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Collections -->
        <div class="col-md-4 mb-3">
            <a href="#!list-collections" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-layer-group fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Collections</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (3 collections)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Salles -->
        <div class="col-md-4 mb-3">
            <a href="#!list-salles" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-door-open fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Salles utilisées</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (3 salles)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Catalogue -->
        <div class="col-md-4 mb-3">
            <a href="#!list-catalogue" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-book fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Catalogue</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (48 pages)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Visites guidées -->
        <div class="col-md-4 mb-3">
            <a href="#!list-visites" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-map-signs fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Visites guidées</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (15 programmées)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Documentation -->
        <div class="col-md-4 mb-3">
            <a href="#!list-documentation" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-file-alt fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Documentation</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (12 documents)
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Section Liste des œuvres principales -->
    <div>
        <div class="card-module-info d-flex align-items-center mb-4">
            <div class=" rounded me-0">
                <i class="fa fa-star fa-2x theme-color"></i>
            </div>
            <div class="text-title me-auto">
                <span class="fw-normal mx-2">Œuvres principales de l'exposition</span>
            </div>
        </div>

        <!-- Tableau des œuvres -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Œuvre</th>
                        <th>Artiste</th>
                        <th>Période</th>
                        <th>Origine</th>
                        <th>Salle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Plaque de bronze Oba Ozolua</td>
                        <td>Artiste anonyme</td>
                        <td>XVIe siècle</td>
                        <td>Royaume du Bénin</td>
                        <td>Salle 1A</td>
                    </tr>
                    <tr>
                        <td>Portrait d'Oba Oguola</td>
                        <td>Maître fondeur</td>
                        <td>XVe siècle</td>
                        <td>Nigeria</td>
                        <td>Salle 1A</td>
                    </tr>
                    <tr>
                        <td>Armure du chasseur Dogon</td>
                        <td>Artisan Dogon</td>
                        <td>XIXe siècle</td>
                        <td>Mali</td>
                        <td>Salle 2B</td>
                    </tr>
                    <tr>
                        <td>Statue de la déesse Sekhmet</td>
                        <td>Sculpteur égyptien</td>
                        <td>XIVe siècle av. JC</td>
                        <td>Égypte ancienne</td>
                        <td>Salle 3C</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Statistiques de fréquentation -->
    <div class="mt-4">
        <div class="card-module-info d-flex align-items-center mb-4">
            <div class="rounded me-0">
                <i class="fa fa-chart-line fa-2x theme-color"></i>
            </div>
            <div class="text-title me-auto">
                <span class="fw-normal">Statistiques de fréquentation</span>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row mb-4 shadow-none bg-white">
            <div class="col-md-6 mb-3">
                <div class="card p-3 h-100">
                    <h6 class="text-center mb-3">Fréquentation mensuelle</h6>
                    <canvas id="frequentationChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card p-3 h-100">
                    <h6 class="text-center mb-3">Répartition par salle</h6>
                    <canvas id="sallesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-module {
        background: radial-gradient(ellipse at center, #ffffff 0%, #f8f9fa 70%, #e9ecef 100%);
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .card-module:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .card-icon-module {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .theme-color {
        color: #6c757d;
    }

    .stat-count {
        background: #e9ecef;
        color: #495057;
        font-weight: 600;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique de fréquentation
    const frequentationCtx = document.getElementById('frequentationChart');
    new Chart(frequentationCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Visiteurs',
                data: [850, 920, 780, 1100, 950, 1200],
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique des salles
    const sallesCtx = document.getElementById('sallesChart');
    new Chart(sallesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Salle 1A - Origines', 'Salle 2B - Art Royal', 'Salle 3C - Civilisations'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a', 
                    '#36b9cc'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });
</script>