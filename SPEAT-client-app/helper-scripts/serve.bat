:: On enregistre l'emplacement depuis lequel ce script est exécuté.
set current_location=%cd%

:: Récupère le chemin du répertoire dans lequel se trouve ce script.
set script_location=%~dp0

:: Suppose que la racine de l'application client est le répertoire parent du répertoire dans lequel se trouve ce script.
cd %script_location%..

:: Dans le cas où aucune paire certificat/clé privée TLS/SSL n'est trouvée, le 
:: serveur sert l'application en HTTP standard.
set https=

:: Si une paire certificat/clé privée TLS/SSL est trouvée, 
:: le serveur sert l'application avec HTTPS (-S).
:: Pour cela, on utilise le certificat situé dans /tls/certificate.pem, et la clé située dans /tls/private-key.pem.
if exist tls\certificate.pem if exist tls\private-key.pem (
    set https=-S -C tls/certificate.pem -K tls/private-key.pem
)

:: On lance le serveur à l'adresse localhost, sur le port 8000.
:: L'option -c-1 désactive la mise en cache.
http-server -a localhost -p 8000 -c-1 %https%

:: On se replace à l'emplacement depuis lequel le script a été exécuté.
cd %current_location%