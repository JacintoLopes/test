<?php
// Récupération du nom de la machine (serveur)
$hostname = gethostname();

// Fonction pour obtenir l’IP du client, même derrière proxy
function get_client_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]);
    }
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return 'IP non disponible';
}

// Fonction pour obtenir le nom d’utilisateur système
function get_system_user() {
    if ($u = getenv('USER')) {
        return $u;
    }
    if ($u = getenv('USERNAME')) {
        return $u;
    }
    return get_current_user();
}

$client_ip = get_client_ip();
$system_user = get_system_user();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Lazarus Group - IMMOSION SA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Poppins:wght@400;600&display=swap');

    body {
      background: linear-gradient(135deg,rgb(255, 255, 255),rgb(255, 255, 255));
      font-family: 'Poppins', sans-serif;
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
      padding: 3rem 3rem 4rem 3rem;
      text-align: center;
    }

    h1 {
      font-weight: 700;
      color: #0d6efd;
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
      color: #0d6efd;
    }

    .contact-message {
      margin-top: 2rem;
      font-weight: 500;
      font-size: 1.1rem;
      color: #333;
      max-width: 560px;
      margin-left: auto;
      margin-right: auto;
    }

 .btn-contact {
  margin-top: 2rem;
  width: 100%;
  padding: 0.7rem 1.2rem;
  font-size: 1rem;
  font-weight: 700;
  border-radius: 25px;
  background: linear-gradient(45deg, #0d6efd, #6610f2);
  border: none;
  color: white;
  box-shadow: 0 6px 15px rgba(13, 110, 253, 0.6);
  transition: all 0.4s ease;
  width: auto;       /* pas pleine largeur */
  max-width: 220px;  /* limite la largeur maxi */
}
.btn-contact:hover {
  background: linear-gradient(45deg, #6610f2, #0d6efd);
  box-shadow: 0 9px 20px rgba(102, 16, 242, 0.8);
  transform: scale(1.05);
}

    /* Chrono style digital LED */
    .countdown {
      margin-top: 3rem;
      font-family: 'Orbitron', monospace;
      font-size: 5rem;
      color:rgb(230, 29, 15);
      text-shadow:
        0 0 10pxrgb(0, 0, 0),
        0 0 20px #0d6efd,
        0 0 40px #6610f2,
        0 0 80px #6610f2;
      user-select: none;
      letter-spacing: 0.2em;
    }

    .progress {
  border: 1px solid red;
}

    /* Responsive tweaks */
    @media (max-width: 480px) {
      .card {
        padding: 2rem 1.5rem 3rem 1.5rem;
      }
      h1 {
        font-size: 2rem;
      }
      .countdown {
        font-size: 3.5rem;
      }
      .btn-contact {
        font-size: 1.1rem;
        padding: 0.85rem 0;
      }
    }
  </style>
</head>
<body>
    <div class="countdown" aria-live="polite" aria-atomic="true">
    <span> </span><span id="timer">03:00:00</span>
  </div>
 
  
  <div class="card shadow">
    <h1>IMMOSION SA</h1>
    <p><strong>Nom de la machine :</strong> <?= htmlspecialchars($hostname) ?></p>
    <p><strong>Nom d’utilisateur :</strong> <?= htmlspecialchars($system_user) ?></p>
    <p><strong>Votre adresse IP :</strong> <?= htmlspecialchars($client_ip) ?></p>
    <p><strong>Adresse :</strong></p>
  </div>

  <p class="contact-message">
    Nous avons toutes vos données si vous le souhaitez et l'accès à vos comptes si vous souhaitez les récupérer, contactez-nous pour parvenir à un accord.
    Le temps compte
  </p>

  <button
    class="btn-contact"
    onclick="window.location.href='https://www.securemind.ch/'"
    type="button"
  >
    +41 78 123 45 67
  </button>
    <img src="/giphy.gif" alt="Loading..." />


  <script>
    let duration = 3 * 60 * 60;

    function formatTime(seconds) {
      const h = Math.floor(seconds / 3600).toString().padStart(2, '0');
      const m = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
      const s = (seconds % 60).toString().padStart(2, '0');
      return `${h}:${m}:${s}`;
    }

    const timerElem = document.getElementById('timer');

    function countdown() {
      if (duration <= 0) {
        timerElem.textContent = "Temps écoulé !";
        clearInterval(intervalId);
        return;
      }
      timerElem.textContent = formatTime(duration);
      duration--;
    }

    const intervalId = setInterval(countdown, 1000);
    countdown();

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
