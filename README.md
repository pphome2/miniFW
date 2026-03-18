# MiniFW

## Programcsomag webes alkalmazások készítéséhez

appfw: oop egyszerű keretrendszer
wpfw: Wordpress plugin
minifw: php keretrendszer

---

Egyszerű alkalmazások gyors készítését segíti.


### Telepítés

- felmásolni az összes fájlt a webserver megfelelő könyvtárába
- `config` könyvtár `config.php` fájl átnézése, a beállítások itt taláhatók
- a beállított `content` könyvtár tartalmazza az alkalmazást
- a `content\config.php` felülírja a rendszer beéllításait, menük, betöltendő fájlok beállításai
- `config` könyvtárban találhatók a nyelvi fájlok, ha szükséges a módosítható, de inkább a `content` könyvtár tartalmazzon saját nyelvi fájlt
- a `content` könyvtár demo alkalmazást tartalmaz, megmutatja a használatot

### Indítás

A főkönyvtár `start.php` indítja az alkalmazást.


### Működés


