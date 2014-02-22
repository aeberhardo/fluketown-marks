fluketown/marks
===============

Online bookmarks manager. Written in Laravel 3.2.13.


Installation in XAMPP
=====================

Symlink erstellen auf public-Verzeichnis in htdocs.

Beispiel: Symlink direkt zum public-Verzeichnis innerhalb des lokalen Git-Repos erstellen:

 I:\dev\server\xampp\htdocs>mklink /D mylaravel "I:\dev\repo\aeberhardo\php\LaravelTest\public"
 symbolische Verknüpfung erstellt für mylaravel <<===>> I:\dev\repo\aeberhardo\php\LaravelTest\public

Nun kann via http://localhost/mylaravel auf die Seite zugegriffen werden.

Besser: Via NetBeans das Laravel automatisch exportieren lassen, z.B. nach I:\dev\server\xampp\apps\mylaravel.
        Danach einen (relativen) Link erstellen von I:\dev\server\xampp\htdocs nach I:\dev\server\xampp\apps\mylaravel\public


Siehe auch: "Understanding the Laravel PUBLIC folder" http://forums.laravel.com/viewtopic.php?id=1258


Deployment
==========

Neues Verzeichnis ausserhalb von htdocs anlegen, z.B. "apps" in /home/<username>/apps.
Die Laravel-Seite nach "apps" kopieren.

In /home/<username>/public_html einen Symlink erstellen:

Symlink-Name: mylaravel
Symlink-Ziel: ../apps/MyLaravelTest/public

Symlinks können z.B. mit WinSCP erstellt werden.
Dafür muss man aber eine SFTP-Verbindung aufgebaut werden.

Nun kann die Seite via http://www.<username>.ch/mylaravel erreicht werden.

Tabellen anlegen
----------------

Es ist eine neue MySQL-Datenbank zu erstellen.
Die zu wählende Collation ist "latin1_german2_ci".
Dies hat Einfluss, wie die Suche mit "LIKE" funktioniert.
Bei den meisten Collations wird z.B. ä==a oder sogar ü==y behandelt.
(Alternativ könnte "utf8_bin" verwendet werden, dort wir aber immer ein
case-sensitiver String-Vergleich gemacht)


Mittels Artisan Web Bundle (siehe unten):
http://localhost/marks/artisan/migrate.install
http://localhost/marks/artisan/migrate


PHP Version
===========

Einige Features benötigen PHP 5.4+, z.B. der Task "testdata:insert".

Beim Hoster cyon.ch kann die PHP-Version mittels .htacces konfiguriert werden:
In der Datei mylaravel/public/.htaccess als letzte Zeile hinzufügen: AddHandler application/x-httpd-php54 .php


Artisan
=======

PATH erweitern
--------------

$ export PATH=$PATH:/cygdrive/i/dev/server/xampp/php


Key erzeugen
------------

In "I:\dev\repo\aeberhardo\php\LaravelTest\application\config\application.php"
den "key" auf einen leeren String setzen. Danach die folgenden Commands in
einer Shell ausführen:

$ pwd
/cygdrive/i/dev/repo/aeberhardo/php/LaravelTest

$ php artisan key:generate
Configuration updated with secure key!


PHPUnit-Tests ausführen
-----------------------

PHPUnit muss installiert sein.

$ php artisan test



MySQL
=====

Verbinden
---------

I:\dev\server\xampp\mysql\bin>mysql -uroot <dbname>

oder

I:\dev\server\xampp\mysql\bin>mysql --user=root --password= <dbname>


mysql> show tables;
+------------------------+
| Tables_in_urlshortener |
+------------------------+
| laravel_migrations     |
| urls                   |
+------------------------+
2 rows in set (0.00 sec)


Autocommit ausschalten
----------------------

mysql> set autocommit=0;


Timezone setzen
===============

In application.php die Zeitzone wechseln von UTC zu

'timezone' => 'Europe/Zurich',


Application Index
=================

In application.php: Schönere URLs durch setzen von

'index' => ''


Sessions
========

Soll eine Session beim Schliessen des Browsers beendet werden, so ist in
session.php zu setzen:

'expire_on_close' => true,


Laravel Bundles installieren
============================

Damit Laravel-Bundles installiert werden können,
muss in php.ini (z.B. I:\dev\server\xampp\php\php.ini) die
Zeile "extension=php_openssl.dll" aktiviert werden.

Um danach beispielsweise das Artisan-Web-Bundle zu installieren:
$ php artisan bundle:install artisan


Artisan Web Bundle
==================

Wurde das Artisan Web Bundle installiert, können Artisan Commands
wie folgt im Browser ausgeführt werden:

http://localhost/marks/artisan/testdata.insert

Dies ist gleichbedeutend wie: $ php artisan testdata:insert


Maven
=====

$ mvn clean package clean package -Dapp.key=<my_key> -Dimg.path='../apps/marks-images' -Dimg.url='marks-images' -Ddb.host=localhost -Ddb.database=<my_db_name> -Ddb.username=<my_db_username> -Ddb.password=<my_db_password> -Dftp.host=<my_ftp_host> -Dftp.user=<my_ftp_user> -Dftp.dir=apps/marks-images -Djson.url=http://<my_domain>/marks/bookmarks/missing_thumbs_json


Git
===

Bei der Git-Konfiguration ist darauf zu achten, dass das CRLF-Verhalten korrekt ist.
Damit z.B. Shell-Scripts nicht CRLFs unter Windows erhalten, wenn das Repo gecloned wird,
muss die Einstellung "autocrlf = false" in der "gitconfig" vorgenommen werden.
Bei MSYS-Git kann dies generell in "msysgit\etc\gitconfig" konfiguriert werden.
Dies ist z.B. für den Einsatz von Jenkins nötig.


Thumbnails
==========

Thumbnails müssen so auf dem Server abgelegt werden, dass sie direkt mittels einer URL erreichbar sind.
Beispielsweise 'http://www.fluketown.ch/marks-images/123-thumb.jpg'.
Falls der physische Ablageort des Thumbnail-Verzeichnisses nicht im Document-Root ist, so kann ein Symlink
erstellt werden.

Sowohl der physiche Ablageort, als auch die zu verwendende URL für den Zugriff, werden durch die Config
'images#path' und 'images#url' in 'my.php' definiert. Diese werden durch den Maven-Build gefiltert.

