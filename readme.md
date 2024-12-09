# Documentació Pràctica 05

El projecte es pot testejar en aquest [link](https://xampp.garc.pro/www/practiques/UF1/Practica%204/Controlador)

Login per fer proves:

- `Usuari`: profe@sapalomera.cat
- `Password`: Profe123@

## Estructura del Projecte

El projecte està organitzat en les següents carpetes principals:

- `Controlador/`: Conté els fitxers PHP que gestionen la lògica de l'aplicació.
- `Model/`: Inclou els fitxers PHP que interactuen amb la base de dades.
- `Vistes/`: Conté les vistes HTML/PHP que es mostren a l'usuari.
- `Estils/`: Emmagatzema els fitxers CSS per al disseny de l'aplicació.

## Funcionalitats Principals

### 1. Gestió d'Usuaris

#### Registre d'Usuaris (`signup.php`)
- Permet als usuaris crear un nou compte.
- Valida l'entrada de l'usuari (nom, email, contrasenya).
- Emmagatzema la informació de l'usuari a la base de dades.

#### Inici de Sessió (`login.php`)
- Autentica als usuaris existents.
- Crea una sessió per a l'usuari autenticat.

#### Tancament de Sessió (`logout.php`)
- Tanca la sessió de l'usuari actual.

### 2. Gestió d'Articles

#### Mostrar Articles (`mostrar.php`)
- Mostra una llista paginada d'articles.
- Diferencia entre usuaris autenticats i anònims.

#### Inserir Articles (`inserir.php`)
- Permet als usuaris autenticats crear nous articles.

#### Modificar Articles (`modificar.php`)
- Permet als usuaris autenticats editar els seus propis articles.

#### Eliminar Articles (`eliminar.php`)
- Permet als usuaris autenticats eliminar els seus propis articles.

## Models de Dades

### Usuaris (`usuaris.php`)
- Funcions per a inserir i obtenir informació dels usuaris.

### Articles (`articles.php`)
- Funcions per a inserir, modificar, eliminar i consultar articles.
- Inclou funcions per a la paginació d'articles.

## Vistes

- `index.view.php`: Pàgina principal que mostra la llista d'articles.
- `login.view.php`: Formulari d'inici de sessió.
- `signup.view.php`: Formulari de registre d'usuaris.
- `inserir.view.php`: Formulari per a crear nous articles.
- `modificar.view.php`: Formulari per a editar articles existents.

## Seguretat

- Ús de `htmlspecialchars()` per a prevenir injecció de codi XSS.
- Contrasenyes hashades usant `password_hash()` i `password_verify()`.
- Validació d'entrada d'usuari al costat del servidor.

## Base de Dades

- Utilitza MySQL/MariaDB.
- Taules principals: `usuaris` i `articles`.

## Característiques Addicionals

- Paginació d'articles per a millorar el rendiment i l'experiència de l'usuari.
- Sistema de missatges per a mostrar errors i confirmacions a l'usuari.
- Disseny responsiu utilitzant Bootstrap.