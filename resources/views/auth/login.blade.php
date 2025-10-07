@include('includes.head')

<div class="login-container w-100" style="
        position: relative;
        height: 100vh;
        background: linear-gradient(135deg, #ffc89a 0%, #ff9135 100%);
        overflow: hidden;
    ">
    <!-- Image de fond avec overlay -->
    <div class="background-image" style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://www.infomediaire.net/wp-content/uploads/2018/12/Le-mus%C3%A9e-des-civilisations-noires.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.4;
            z-index: 0;
        "></div>

    <!-- Carte de login -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; position: relative; z-index: 1;">
        <div class="card shadow-lg" style="
                max-width: 420px; 
                width: 100%; 
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border: none;
                overflow: hidden;
            ">
            <!-- En-tête avec logo -->
            <div class="card-header bg-transparent border-0 pt-4 pb-2">
                <div class="text-center">
                    <img src="https://mcn-sn.com/wp-content/uploads/2025/02/Logo_MCN_ang_Fran_Plan-de-travail-1-copie-4.png" class="logo-icon" alt="" style="height: 80px;">
                </div>
                <h4 class="text-center mt-3 mb-1" style="color: #ff7502; font-weight: 600;">Connexion</h4>
                <p class="text-center text-muted mb-0" style="font-size: 0.9rem;">Accédez à votre espace personnel</p>
            </div>

            <!-- Contenu du formulaire -->
            <div class="card-body px-4 py-3">
                <form method="post" action="{{ url('/login') }}" class="px-2">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <!-- Champ Identifiant -->
                    <div class="form-group mb-3">
                        <label for="login" class="form-label" style="font-size: 0.85rem; color: #495057; font-weight: 500;">Identifiant</label>
                        <input type="text" id="login" required name="login" class="form-control form-control-lg" placeholder="Saisissez votre identifiant" aria-label="login" value="{{ old('login') }}" style="border-radius: 8px; border: 1px solid #e0e0e0; padding: 12px 16px; font-size: 0.95rem;">
                    </div>

                    <!-- Champ Mot de passe -->
                    <div class="form-group mb-3 position-relative">
                        <label for="password" class="form-label" style="font-size: 0.85rem; color: #495057; font-weight: 500;">Mot de passe</label>
                        <div class="position-relative">
                            <input type="password" required name="password" id="password" class="form-control form-control-lg" placeholder="••••••••" aria-label="password" style="border-radius: 8px; border: 1px solid #e0e0e0; padding: 12px 16px; font-size: 0.95rem; padding-right: 40px;">
                            <i class="fas fa-eye position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: #adb5bd; cursor: pointer;" id="togglePassword"></i>
                        </div>
                    </div>

                    <!-- Lien mot de passe oublié -->
                    <div class="d-flex justify-content-end mb-4">
                        <a href="reset-password.html" class="text-decoration-none" style="font-size: 0.85rem; color: #ff7502 !important; font-weight: 500;">
                            Mot de passe oublié?
                        </a>
                    </div>

                    <!-- Messages d'erreur -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px; border: none; background-color: #f8d7da; color: #721c24;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                            <li style="list-style-type: none; font-size: 0.9rem;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Bouton de connexion -->
                    <button type="submit" class="btn btn-block btn-lg w-100" style="
                            background: linear-gradient(135deg, rgb(255, 117, 2) 0%, rgb(255, 117, 2) 100%);
                            color: #fff;
                            border: none;
                            border-radius: 8px;
                            padding: 12px;
                            font-weight: 500;
                            font-size: 1rem;
                            box-shadow: 0 4px 12px rgba(0, 93, 26, 0.2);
                            transition: all 0.3s ease;
                            height: 48px;
                        ">
                        Connexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #00aa14 !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 170, 20, 0.15) !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 93, 26, 0.3) !important;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
</style>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>