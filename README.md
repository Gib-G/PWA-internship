# PWA SPEAT

This repo contains the documentation and guides I redacted for a progressive web app (PWA) prototype whose development I supervised during an internship.
The app is meant to offer a collaborative food delivery service.

The source code is hosted on a private repo of mine and has been removed from this public repo as the app is considered proprietary software. All sensitive information regarding the company has also been removed.
If you still wish to get a demo of the app, please contact me at gibril.gunder@outlook.fr.

I have added a few screenshots of pages of the application we built during my internship (see bellow). Those illustrations only come from a prototype of the client app which is not yet linked to the back end logic (a REST API built with Symfony and API Platform whose development I also supervised partly). Most of the code for this front end was made by interns in less than 4 weeks with no review from more experienced developers. Thus, it is obviously flawed : I only captured a snapshot of the project when I left the company. My goal with this repo is not to showcase the source code - which is impossible anyway due to the fact that the app is proprietary, but rather illustrate the work I did when supervising the creation of this prototype.

All the documentation and guides within this repo are redacted in french. My goal was to write comprehensive resources for other junior developers and interns to quickly understand the project and get a handle on the source code.

Here are a few illustrations of some pages of the app we built (you may find all the images used in this repo under <code>/documentation/images/</code>):

<table>
  <tr>
    <td><img src="./documentation/images/screenshot_1.png" alt="Screenshot of the app's prototype"></td>
    <td><img src="./documentation/images/screenshot_2.png" alt="Screenshot of the app's prototype"></td>
  </tr>
  <tr>
    <td><img src="./documentation/images/screenshot_3.png" alt="Screenshot of the app's prototype"></td>
    <td><img src="./documentation/images/screenshot_4.png" alt="Screenshot of the app's prototype"></td>
  </tr>
  <tr>
    <td><img src="./documentation/images/screenshot_5.png" alt="Screenshot of the app's prototype"></td>
    <td><img src="./documentation/images/screenshot_6.png" alt="Screenshot of the app's prototype"></td>
  </tr>
  <tr>
    <td><img src="./documentation/images/screenshot_7.png" alt="Screenshot of the app's prototype"></td>
    <td><img src="./documentation/images/screenshot_8.png" alt="Screenshot of the app's prototype"></td>
  </tr>
</table>

_____________________________________________________________________________

Application Web pour la consultation de cartes de restaurants et la livraison.

<strong>
  IMPORTANT : ?? LIRE JUSQU'AU BOUT !! LA SECTION "UTILISATION" ?? LA FIN DE CE README REDIRIGE VERS LES DOCUMENTATIONS DE L'API (BACKEND) ET DE L'APPLICATION CLIENT (FRONTEND).</strong> <br><br>

<h2>Organisation / architecture</h2>

Ce dossier contient l'application client et l'API REST qui fait office de serveur/backend. <br>
Ces deux parties sont compl??tement ind??pendantes et doivent ??tre servies s??par??ment. <br>
La communication entre l'application client et l'API utilise le processus CORS. 

L'application client se trouve dans le dossier <strong>SPEAT-client-app</strong>. Le dossier <strong>SPEAT-API</strong> contient l'API. <br><br>

Ce r??po contient ??galement un dossier <strong>documentation</strong> qui regroupe de la documentation sur le projet et l'application SPEAT (guides, aspects de sp??cification, de conception, ressources diverses pour se former, cerner le projet, etc...). <br>
Voir <code>/documentation/README.txt</code> pour plus d'explications sur le contenu et l'organisation de ce dossier. <br><br>

<h3>?? propos de l'application client</h3>

<strong>
  IMPORTANT POUR LES D??VELOPPEURS FRONT PRINCIPALEMENT : <br>
  Le design de l'application client est expos?? dans <a href="">ce projet Figma</a> (lien supprim?? pour prot??ger la propri??t?? de l'entreprise : ci-dessous, une illustration d'une partie du projet Figma). Merci de s'y   r??f??rer pour prendre connaissance des pages que doit poss??der l'application client.
</strong><br><br>

<img src="./documentation/images/figma.png" alt="Capture d'??cran du projet Figma sur lequel nous travaillions">
  
L'application client est une <i>Single Page Application</i> (SPA) (voir 
<a href="https://blog.octo.com/a-la-decouverte-des-architectures-du-front-3-4-les-single-page-applications/">ici</a>, 
<a href="https://www.bloomreach.com/en/blog/2018/07/what-is-a-single-page-application.html">ici</a>,  
<a href="https://medium.com/@NeotericEU/single-page-application-vs-multiple-page-application-2591588efe58">l??</a>, ou 
<a href="./documentation/autres-ressources/spa-vs-conventional-web-app.pdf">ce sch??ma</a> qui explique la diff??rence entre une SPA et une application Web conventionnelle) 
dot??e de fonctionnalit??s d'une <i>Progressive Web Application</i> (PWA) (voir 
<a href="https://web.dev/progressive-web-apps/">cette introduction</a>, 
<a href="https://developer.mozilla.org/fr/docs/Web/Progressive_web_apps">ce guide</a>, ou
<a href="https://pwa-workshop.js.org/fr/">ce petit workshop</a> qui permet d'apprendre ?? mettre en place une PWA). 
L'application impl??mente, par exemple, un service worker (voir 
<a href="https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API/Using_Service_Workers">ici</a>, ou 
<a href="https://serviceworke.rs/">l??</a>). 

En tant que PWA, l'application client est con??ue pour ??tre utilis??e comme une application native. Elle peut ??tre install??e facilement sur une grande vari??t?? d'environnements diff??rents (Windows, Linux, Android, iOS, etc...) sans ajustements n??cessaires. Cela est permis par les technologies Web qui sont utilis??es pour sa conception. De plus, l'installation de l'application ne n??cessite pas de passer par un store (les conventionnels App Store et Play Store) : l'application client peut ??tre utilis??e dans un navigateur, mais peut aussi ??tre install??e comme application native depuis ce navigateur. <br>

L'application client est construite autour d'AngularJS (Angular 0.* et 1.\*; Pour plus de d??tails, consulter le <a href="https://angularjs.org/">site</a> d'AngularJS, ou <a href="https://www.w3schools.com/angular/default.asp">ce cours</a>). 

<strong>Un changement de framework/biblioth??que frontend est fortement conseill?? : AngularJS ne sera plus maintenu au del?? de d??cembre 2021.</strong> <br><br>

<h3>?? propos de l'API</h3>

Le "serveur" est une API REST impl??ment??e avec Symfony et API Platform (voir la <a href="https://api-platform.com/docs">documentation</a>). L'application client y fait appel pour r??cup??rer des donn??es au format JSON majoritairement (les informations des restaurants, des produits, etc...). <br><br>

<h2>Utilisation</h2>

Les instructions d'utilisation de l'application client sont disponibles <a href="./SPEAT-client-app/README.md">ici</a>. <br>
Les instructions d'utilisation de l'API sont disponibles <a href="./SPEAT-API/README.md">ici</a>.
