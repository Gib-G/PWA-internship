# Récupère le chemin du répertoire dans lequel se trouve ce script.
script_location=$(readlink -f $(dirname $0))

# Suppose que la racine de l'application client est le répertoire parent du répertoire dans lequel se trouve ce script.
cd ${script_location}/..

# On crée un dossier /tls/ à la racine de l'application client, et on s'y déplace.
# Ce dossier va contenir le certificat et la clé privée SSL/TLS.
rm -rf tls
mkdir tls
cd tls

# On configure une autorité de certification (CA) locale avec mkcert.
mkcert -install

# On crée un certificat et une clé privée TLS/SSL.
# Le certificat se trouve dans /tls/certificate.pem.
# La clé privée se trouve dans /tls/private-key.pem.
mkcert -cert-file certificate.pem -key-file private-key.pem localhost 127.0.0.1 ::1