# API SPEAT

L'API REST Symfony utilisée pour fournir les données de la base de données SPEAT à l'application client. <br>
Cette API repose sur API Platform (voir <a href="https://api-platform.com/docs/distribution/">la documentation</a>). <br><br>

<h2>Utilisation</h2>

La racine de l'API que doit exposer le serveur est située dans le dossier <code>/public/</code>. Le serveur doit donc servir ce dossier. <br>
L'API peut être servie par le serveur de développement intégré à PHP... :

<ol>
  <li><code>cd public/</code></li>
  <li><code>php -S adresse-ip:port</code></li>
</ol>

...ou par tout autre serveur de développement comme http-server utilisé pour servir l'application client (voir README.md dans le dossier de l'application client).

Le point d'entrée principal de l'API se trouve à la route /api. Sur cette route, API Platform fournit une documentation des différents points d'entrée de l'API, des ressources mises à disposition, et des méthodes HTTP à utiliser pour interroger l'API.
