# dfva_webphp

Este proyecto es una demostración de como integrar dfva_php en una aplicación web, permite demostrar cómo se realiza la firma.

Está desarrollado con Laravel + php 7.3 + dfva_php , conecta con una base de datos sqlite.

# Instalación
 
Instale dependencias

    rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
    yum --enablerepo=remi-php73 install php
    yum --enablerepo=remi-php73 install php-xml php-soap php-xmlrpc php-mbstring php-json php-gd php-mcrypt
    yum install supervisor

Clone el proyecto

    cd ~
    git clone https://github.com/luisza/dfva_webphp.git
    git clone https://github.com/luisza/dfva_php.git
    ln -s ~/dfva_php/dfva_php ~/dfva_webphp/app/dfva_php
    touch ~/dfva_webphp/database/database.sqlite
    composer install
    php artisan serve --port=8090
    php artisan migrate

Cree un archivo `/etc/supervisord.d/dfvawebphp.ini`

    [program:dfvawebphp]
    command=/usr/bin/php -S 0.0.0.0:8080 /home/user/dfva_webphp/server.php
    directory=/home/user/dfva_webphp
    user=user
    group=user
    autostart=true
    autorestart=true
    stderr_logfile=/var/log/dfva_webphp.err.log
    stdout_logfile=/var/log/dfva_webphp.out.log
    environment=PATH="/usr/local/bin:/usr/bin:/usr/local/sbin:/usr/sbin:/home/user/.local/bin:/home/user/bin";HOME=/home/user

Cree el archivo de logs

    touch /var/log/dfva_php.log
    chown user:user /var/log/dfva_php.log

Corra la aplicación 

    supervisorctl reread
    supervisorctl update

# Archivos de interés 

Debido a que este es un proyecto de demostración y varios archivos no son necesarios para entender el procedimiento se describen cuales 

- public/js       // archivos javascript
- public/css      // archivos css
- public/static   // archivos de imágenes del firmador

- routes/web.php  // configuración de rutas de la aplicación
- database/migrations // migraciones de la base de datos
- resources/views  // plantillas gráficas de la aplicación
- app/Http/Controllers/SigndocumentController.php

```
    // Muestra el botón de firmado
    public function sign_screen(Request $request, $id)
    // Envía a firmar un documento dado por $id
    public function sign($id)
    // Verifica el estado de la transacción
    public function sign_check($id)
    // Descarga el documento firmado
    public function download($id)

```

# Aspectos importantes 

Este proyecto solo pretende mostrar cómo usar dfva_php, por lo que no detalla algunas particulares de seguridad, por ejemplo es recomendable
guardar variables de control en la sesión para prevenir que entes externos puedan consultar las transacciones.
Además la información se almacena en disco y no en base de datos.

