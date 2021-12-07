# exercise-project
#ESERCIZIO

Creare il file .env.local con le configurazioni necessarie al corretto funzionamento
dell'applicativo nel proprio ambiente di sviluppo.

Dopo aver installato symfony creare il db con doctrine:database:create
e quindi applicare le migrations.

È possibile consultare le API disponibili e 
la relativa documentazione a {mioUrl}/api

È possibile creare un utente da utilizzare per l'autenticazione lato api,
lanciando il command 

 - app:start:command

che si aspetta due parametri in ingresso:

    - email
    - password

Queste credenziali saranno quelle da utilizzare per richiedere il token
di autorizzazione per poi poter accedere alle API
