<div class="container intro-x bg-white p-4">
    <!-- phase 1 -->
    <div class="d-flex align-items-center mb-4 justify-content-between gap-1">
        <!-- Bouton retour -->
        <a href="#!list-evenement" class="btn bg-theme-gradient rounded-2 border-none px-2 py-2">
            <img src="{{ asset('images/back.png') }}" class="icon-size w-75" alt="">
        </a>

        <!-- Statistiques -->
        <div class="d-flex gap-3 flex-wrap bg-theme-secondary-grey rounded-3 p-1">
            <div class="stat-box px-3  rounded">
                Inscriptions <span class="stat-count px-2 py-1 rounded">45</span>
            </div>
            <div class="stat-box px-3  rounded">
                Places disponibles <span class="stat-count px-2 py-1 rounded">155</span>
            </div>
            <div class="stat-box px-3  rounded">
                Revenus générés <span class="stat-count px-2 py-1 rounded">225 000 FCFA</span>
            </div>
        </div>
    </div>

    <!-- Informations de l'événement -->
    <div class="card-module-info d-flex align-items-center mb-4">
        <div class=" rounded me-0">
            <img src="{{ asset('images/evenement.png') }}" class="icon-size w-50" alt="">
        </div>
        <div class="text-title me-auto">
            <span class="fw-normal">Informations de l'événement</span>
        </div>
    </div>
    <hr>

    <!-- Informations fixes de l'événement -->
    <div class="mb-4">
        <div class="d-flex gap-3 mb-3">
            <div class="w-100">
                <Label class="text-muted">Date de début</Label>
                <input type="text" class="form-control w-100" value="18 mai 2024 - 18h00" readonly>
            </div>
            <div class="w-100">
                <Label class="text-muted">Date de fin</Label>
                <input type="text" class="form-control w-100" value="19 mai 2024 - 02h00" readonly>
            </div>
        </div>

        <!-- Titre de l'événement -->
        <div class="mb-3">
            <input type="text" class="form-control w-100" value="Nuit des Musées 2024" readonly>
        </div>

        <!-- Description et détails -->
        <div class="d-flex gap-3">
            <textarea class="form-control" rows="5" readonly>Une soirée exceptionnelle avec visites guidées nocturnes, ateliers créatifs et performances artistiques. Découvrez le musée sous un nouvel angle avec des animations spéciales et des œuvres mises en lumière.</textarea>
            <textarea class="form-control" rows="5" readonly>Type: Nocturne
Prix: Gratuit
Places: 200
Statut: Actif
Lieu: Musée entier
Animateur: Équipe du musée</textarea>
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

    <!-- Grille de sections -->
    <div class="row mb-4 shadow-none bg-white">
        <!-- Section Participants -->
        <div class="col-md-4 mb-3">
            <a href="#!list-participants" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-users fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Participants inscrits</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (45 participants)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Intervenants -->
        <div class="col-md-4 mb-3">
            <a href="#!list-intervenants" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-microphone fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Intervenants</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (8 intervenants)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Activités -->
        <div class="col-md-4 mb-3">
            <a href="#!list-activites" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-calendar fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Activités programmées</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (12 activités)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Réservations -->
        <div class="col-md-4 mb-3">
            <a href="#!list-reservations" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-ticket fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Réservations</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (38 réservations)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Photos -->
        <div class="col-md-4 mb-3">
            <a href="#!list-photos" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-camera fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Galerie photos</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (24 photos)
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Section Feedback -->
        <div class="col-md-4 mb-3">
            <a href="#!list-feedback" class="text-decoration-none">
                <div class="card-module rounded-3 p-3 h-100">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="card-icon-module mb-2">
                            <i class="fa fa-star fa-2x theme-color"></i>
                        </div>
                        <h5 class="card-title-module fw-normal mb-2">Avis & Commentaires</h5>
                        <div class="card-value-module theme-color fw-bold">
                            (4.5/5 étoiles)
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Section Planning des activités -->
    <div>
        <div class="card-module-info d-flex align-items-center mb-4">
            <div class=" rounded me-0">
                <i class="fa fa-clock fa-2x theme-color"></i>
            </div>
            <div class="text-title me-auto">
                <span class="fw-normal mx-2"> Planning des activités</span>
            </div>
        </div>

        <!-- Tableau du planning -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Heure</th>
                        <th>Activité</th>
                        <th>Lieu</th>
                        <th>Intervenant</th>
                        <th>Places</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>18h00 - 19h00</td>
                        <td>Visite guidée "Art Royal"</td>
                        <td>Salle 1A</td>
                        <td>Dr. Diallo</td>
                        <td>25/25</td>
                    </tr>
                    <tr>
                        <td>19h30 - 20h30</td>
                        <td>Atelier poterie</td>
                        <td>Atelier Est</td>
                        <td>M. Sarr</td>
                        <td>15/15</td>
                    </tr>
                    <tr>
                        <td>21h00 - 22h00</td>
                        <td>Concert de kora</td>
                        <td>Auditorium</td>
                        <td>Ensemble traditionnel</td>
                        <td>80/80</td>
                    </tr>
                    <tr>
                        <td>22h30 - 23h30</td>
                        <td>Projection documentaire</td>
                        <td>Salle vidéo</td>
                        <td>Réalisateur</td>
                        <td>40/40</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Statistiques -->
    <div class="mt-4">
        <div class="card-module-info d-flex align-items-center mb-4">
            <div class="rounded me-0">
                <i class="fa fa-chart-bar fa-2x theme-color"></i>
            </div>
            <div class="text-title me-auto">
                <span class="fw-normal">Statistiques de l'événement</span>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row mb-4 shadow-none bg-white">
            <div class="col-md-6 mb-3">
                <div class="card p-3 h-100">
                    <h6 class="text-center mb-3">Inscriptions par jour</h6>
                    <canvas id="inscriptionsChart"></canvas>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card p-3 h-100">
                    <h6 class="text-center mb-3">Répartition par activité</h6>
                    <canvas id="activitesChart"></canvas>
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
    // Graphique des inscriptions
    const inscriptionsCtx = document.getElementById('inscriptionsChart');
    new Chart(inscriptionsCtx, {
        type: 'bar',
        data: {
            labels: ['01/05', '05/05', '10/05', '15/05', '18/05'],
            datasets: [{
                label: 'Inscriptions',
                data: [5, 12, 8, 15, 5],
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
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

    // Graphique des activités
    const activitesCtx = document.getElementById('activitesChart');
    new Chart(activitesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Visites guidées', 'Ateliers', 'Concerts', 'Projections'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });
</script>