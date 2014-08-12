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

https://developer.amazonservices.com/

Man erhält folgende Zugangsschlüssel:

* AWS_ACCESS_KEY_ID
* AWS_SECRET_ACCESS_KEY
* MERCHANT_ID
* MARKETPLACE_ID

Man sollte sich diese Schlüssel zur Sicherheit einmal ausdrucken!

Als nächstes sollte PHP, curl und die Amazon lib installiert werden:

Windows:
--------

* PHP installieren
* libcurl installieren

Installieren der Amazon Client Library - PHP - Version für Orders.
https://developer.amazonservices.com/doc/orders/orders/v20130901/php.html/182-8535534-3394018

Linux:
------

```bash
apt-get install php5-cli
apt-get install php5-curl
```

Installieren der Amazon Client Library - PHP - Version für Orders.
https://developer.amazonservices.com/doc/orders/orders/v20130901/php.html/182-8535534-3394018

