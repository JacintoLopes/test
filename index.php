<?php
$hostname = gethostname();

function get_client_ip() {
     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]); // la première IP est l’IP originale du client
    }
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR']; // dernier recours
    }
    return 'IP non disponible';if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
    if (!empty($_SERVER['REMOTE_ADDR'])) return $_SERVER['REMOTE_ADDR'];
    return 'IP non disponible';
}

function get_system_user() {
    return getenv('USER') ?: (getenv('USERNAME') ?: get_current_user());
}

$client_ip = get_client_ip();
$system_user = get_system_user();

// Définir l'adresse en fonction de l'utilisateur
switch (strtolower($system_user)) {
    case 'jacinto':
        $user_address = 'AV de la gare 5 ';
        break;
    case 'carol':
        $user_address = 'feijodada';
        break;
    case 'fredetic':
        $user_address = 'salayar';
        break;
    default:
        $user_address = 'Non spécifiée';
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Lazarus Group - IMMOSION SA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;600&display=swap');

    body {
      background: linear-gradient(135deg,#000,#000);
      font-family: 'Consolas', sans-serif;
      padding: 3rem 1rem;
      color: #222;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
      max-width: 600px;
      width: 100%;
      padding: 3rem;
      text-align: center;
    }

    h1 {
      font-weight: 700;
      color:rgb(240, 7, 7);
      font-size: 2.8rem;
      margin-bottom: 2rem;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    p {
      font-size: 1.15rem;
      margin: 0.6rem 0;
      color: #444;
    }

    strong {
      color:rgb(245, 20, 4);
    }

    .contact-message {
      margin-top: 2rem;
      font-weight: 500;
      font-size: 1.1rem;
      color: #fff;
      max-width: 560px;
      margin-left: auto;
      margin-right: auto;
    }

  

    .progress {
      height: 30px;
      width: 100%;
      max-width: 600px;
      margin: 1.5rem auto;
    }

    @media (max-width: 480px) {
      .card {
        padding: 2rem 1.5rem 3rem 1.5rem;
      }
      h1 {
        font-size: 2rem;
      }
      .btn-contact {
        font-size: 1.1rem;
        padding: 0.85rem 0;
      }

    }
  </style>
</head>
<body>

<div class="text-center mb-4 w-100">
  <h2 style="font-family: 'Orbitron', monospace; font-size: 2rem; color:rgb(250, 0, 0);">
    Копирование файлов <span id="loadValue">0</span>%
  </h2>
  <div class="progress">
    <div id="loadBar" class="progress-bar progress-bar-striped progress-bar-animated"
         role="progressbar"Metrics
         Manage
         Environment
         Previews
         Redirects/Rewrites
         
         style="width: 0%;"
         aria-valuenow="0"
         aria-valuemin="0"
         aria-valuemax="100">
    </div>
  </div>
</div>

<div class="card shadow">
  <h1>IMMOSION SA</h1>
  <p><strong>Имя машины :</strong> <?= htmlspecialchars($hostname) ?></p>
  <p><strong>Имя пользователя :</strong> <?= htmlspecialchars($system_user) ?></p>
  <p><strong>Ваш IP-адрес :</strong> <?= htmlspecialchars($client_ip) ?></p>
  <p><strong>Адрес :</strong> <?= htmlspecialchars($user_address) ?></p>
</div>

<p class="contact-message">
  Привет,  <?= htmlspecialchars($system_user) ?>,
Я хакер. Как видите, я скопировал все данные с этого компьютера. Это позор ! Вероятно, есть некоторые важные вещи, которыми не стоит делиться со всеми.

Но я думаю, мы можем прийти к соглашению: позвоните мне по телефону +79161434297, прежде чем я продам по самой высокой цене.
</p>


<script>
  let percent = 0;
  const loadBar = document.getElementById("loadBar");
  const loadValue = document.getElementById("loadValue");

  function loadProgress() {
    if (percent > 100) return;
    loadBar.style.width = percent + "%";
    loadBar.setAttribute("aria-valuenow", percent);
    loadValue.textContent = percent;
    percent++;
  }

  setInterval(loadProgress, 150); // ~10 secondes pour atteindre 100%
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

