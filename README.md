e-porto
=======

Amazon seller central => efiliale
---------------------------------

e-porto erstellt, aus den einkommenden Bestellungen, eine csv Datei mit der Lieferadresse.
Diese csv Datei kann verwendet werden, um das Porto, auf www.efiliale.de, zu drucken.

Installation:
------------
Die Installation kann einige Zeit in Anspruch nehmen.

Als erstes muss ein MWS account bei Amazon angelegt werden, der den Zugriff auf das "amazon seller central" gewährt.

https://developer.amazonservices.de/

Man erhält folgende Zugangsschlüssel:

* AWS_ACCESS_KEY_ID
* AWS_SECRET_ACCESS_KEY
* MERCHANT_ID
* MARKETPLACE_ID

Man sollte sich diese Schlüssel zur Sicherheit einmal ausdrucken!

#Abhängigkeiten:

e-porto benötigt die Amazon Client Library - PHP - Version für Orders:

https://developer.amazonservices.com/doc/orders/orders/v20130901/php.html/189-6264670-1326325

Abhängigkeiten der Bibliothek:

* PHP > 5.2.8 
* cURL > 7.18.0

#Windows:

cURL kommt mit PHP für Windows. Eine Zip für beides:

http://windows.php.net/download/

PHP für Windows entpacken und an einem geeigneten Ort legen: Z.B. `C:\php\`

`phpproductive.ini` umbenennen in `php.ini`

Editieren der php.ini:

Um cURL zu aktivieren folgenden Eintrag auskommentieren:

```
;extension=php_curl.dll
```

und ergänzen des Pfades zu den Zertifikaten:

```
curl.cainfo = "C:\php\ssl\cacert.pem"
```

Die Zertifikate für curl gibt es hier:

http://curl.haxx.se/docs/caextract.html

Damit php gefunden wird, sollte noch die Umgebungsvariable(PATH) gesetzt werden:
In unserem Beispiel `C:\php\`.

http://lmgtfy.com/?q=PATH+setzen

#Linux:

```bash
apt-get install php5-cli
apt-get install php5-curl
```

Installieren der Amazon Client Library - PHP - Version für Orders.
https://developer.amazonservices.com/doc/orders/orders/v20130901/php.html/182-8535534-3394018

#Konfiguration von e-porto:

Editieren der `config.inc.php`:

Folgende Werte sollten angepasst werden:

* Die Reply Adresse,
* Die Amazon Schlüssel,
* set_include_path: Hier sollte der relative Pfaad zu der Amazon Bibliothek gesetzt werden.

```php
/* Reply Address */
define('COMPANY', 'Meine Firma');
define('STREET', 'Musterstr.');
define('NUMBER', '23');
define('PLZ', '12345');
define('CITY', 'Musterhausen');
define('LAND', 'DE');

/* Get this from Amazon */
define('AWS_ACCESS_KEY_ID', 'MY_AWS_ACCESS_KEY_ID');
define('AWS_SECRET_ACCESS_KEY', 'MY_AWS_SECRET_ACCESS_KEY');
define ('MERCHANT_ID', 'MY_MERCHANT_ID');
define ('MARKETPLACE_ID', 'MY_MARKETPLACE_ID');

/* Filename of csv file */
define('FILENAME', 'e-porto.csv');

/* Max time to go back in time . Orders older then MAX wont be considered  */
define('MAX', 96);

/* Set include path to root of library, relative to e-porto directory. Not needed if path is set.*/
set_include_path(get_include_path() . PATH_SEPARATOR . '../src/.');
```
