Frogsystem-2-Installer
======================

Repository for development of the installer for Frogsystem 2. See https://github.com/Sweil/Frogsystem-2 for the official Frogsystem 2 repository.


Konzept
=======
Es wird ein generischer Ansatz gewählt. Der Großteil nötigen Operationen soll in einfachen Dateien (Text, XML, SQL, etc.) festgehalten werden und von Scripten automatisiert durchgeführt werden. Im Vorfeld sollen Voraussetzungen und Abhänigkeiten überprüft werden können. Auf Basis dieser sollen auch unterschiedliche Aktionen durchgeführt werden können.

Runner
------
Ein Runner ist eine Klasse, die eine Liste von Anweisungen bekommt (z.B. aus einer Datei) und diese ausführt. Erweiterungen sind IncrementalRunner die dann einfache mehrere Sets hintereinander ausführen. Für uns am relevantesten ist der Spzeialfall eines IncrementalRunners auf Basis von Dateinamen à la "from-alix4-to-alix6.sql" um so von jeder beliebigen Version auf jede beliebige Version updaten zu können.

Checker
-------
Ein Checker sichert bestimmte Voraussetzungen und bricht die Operation im Notfall ab oder verzweigt sie nach Bedarf. Z.B. kann im Updater überprüft werden ob schon SQL-/FTP-Zugangsdaten gespeichert wurden, dann muss das entsprechende Forumlar gar nicht mehr auftauchen.

InstallerPage
-------------
Stellt eine einfache Seite dar, wartet auf eine Benutzereingabe und führt dann etwas aus (i.d.R. einen Checker oder einen Runner). Ein Spezialfall werden hier die selbst aktualisierenden Seiten sein, die sich nach einer bestimmten Menge von Answeisungen selbst erneut aufrufen und an die bearbeitung an der entsprechenden Stelle fortführen. So können auch viele Aufgaben hintereinander durchgeführt werden ohne mit der PHP max_execution_time in Konflikt zu geraten.

Design
======
Das neue Design soll klar und simple sein. Insbesondere im Standalone-Installer/Updater kann auf den ganzen grafischen Schnickschnack verzichtet werden.

Benutzerführung
---------------
Also Grunprinzip soll gelten: Eine einfache Frage/Aufgabe pro Seite, evtl. eine Aktion auf der Seite danach. Konkret also in etwa so:
- Info Seite => Installation starten
- Voraussetungen => Voraussetungen überprüfen
- FTP-Verbindung eingeben => speichern
- SQL-Verbindung eingeben => speichern
- SQL-Befehle auflisten => ausführen => bestätigen
- Datei-Befehle auflisten & Frage nach Delete, Move, Chmod => starten & ausführen => bestätigen
- Formular für Hauptbenutzer anzeigen => speichern
- Formular für die absolut unbedingt notwendigsten Einstellungen anzeigen => speichern
- Finale Infos anzeigen => zur Seite wechseln

Zukunft
=======
Folgende Punkte sind für die zukunft angedacht:
- Updater/Installer auch für PlugIns nutzen, welche nur noch entsprechende Files nach dem selben Schema mitliefern müssen
- Deinstallierer für PlugIns (wobei da im Prinzip auch nur die ensprechenden Deinstallations-Files erstellt werden müssen)
- Integration in das Admin-CP, Updates aus dem Admin-CP heraus, Updates nur für Admin-Accounts erlauben
- Installation wird wohl Standalone bleiben
