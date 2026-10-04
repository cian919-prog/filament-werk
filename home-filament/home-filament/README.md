# Laravel + Tailwind + Blade + Filament starter

Laravel 13, Filament 5, Tailwind CSS 4, Blade + Alpine. Nederlands (standaard) en Engels.

## Installeren (ook op een andere pc)

Vereist: **PHP 8.3+** (Laravel 13), Composer, Node.js + npm. SQLite wordt gebruikt (geen database-server nodig).

```bash
git clone https://github.com/cian919-prog/filament-werk.git
cd filament-werk
composer setup
composer dev        # start php artisan serve + vite
```

`composer setup` doet: `composer install` -> `.env` aanmaken -> app key genereren -> leeg `database/database.sqlite` maken ->
`php artisan migrate --seed` -> `npm install` -> `npm run build`.
Voer het **één keer** uit (het genereert een nieuwe app key).

Open daarna http://127.0.0.1:8000 en log in met `admin@example.com` / `password` (**wijzig dit voor een echte omgeving**).

> `npm run build` is verplicht: zonder gebouwde CSS geeft zowel de Blade-layout als het Filament-paneel een "Vite manifest not found"-fout.
> Tijdens het ontwikkelen kun je `npm run dev` laten draaien (zit in `composer dev`).

## Routes

| URL | Wat |
|---|---|
| `/dashboard` | Blade dashboard |
| `/profile` | Blade profielpagina (naam, e-mail, wachtwoord) |
| `/admin/login` | Filament login |
| `/admin/users` | Filament gebruikersbeheer |
| `/locale/{nl\|en}` | taal wisselen |

## Hoe het in elkaar zit

**Twee "werelden" met dezelfde look**
- Gewone pagina's (dashboard, profiel) zijn Blade en gebruiken `resources/views/layouts/app.blade.php`: linker navigatie met submenu, header met taalkeuze en gebruikersmenu.
- Beheerschermen (`/admin/...`) zijn Filament. Filament tekent zijn eigen kader, dus dat kader is zo ingesteld dat het hetzelfde oogt en dezelfde onderdelen heeft (zie `app/Providers/Filament/AdminPanelProvider.php`): zelfde navigatie (Dashboard + Beheer > Gebruikers), zelfde taalkeuze (de partial `resources/views/partials/language-switcher.blade.php` wordt in beide gebruikt), "Instellingen" in het gebruikersmenu, geen dark mode.

**Taalkeuze (persistent)** — `SetLocale` middleware + `LocaleController`
- Bij een klik op de taalkeuze wordt de taal opgeslagen in (1) een cookie (5 jaar) en (2) `users.locale` als je ingelogd bent.
- Bij elk request kiest `SetLocale` de taal: gebruiker in database -> cookie -> `APP_LOCALE`.
- De middleware staat zowel in de `web`-groep (`bootstrap/app.php`; geldt ook voor Livewire-requests) als in het Filament-paneel (Filament gebruikt de `web`-groep niet).
- Nieuwe taal toevoegen: regel in `config/app.php` (`locales`) + map `lang/<code>/messages.php`.

**Gebruikersbeheer** — `app/Filament/Resources/Users/`
- Eén pagina (`ManageUsers`); aanmaken, wijzigen en verwijderen gebeuren in modals (een "simple resource").
- `UserForm.php`: formulier. Wachtwoord is verplicht bij aanmaken en optioneel bij wijzigen; hashen gebeurt door de `hashed` cast in `User`.
- `UsersTable.php`: tabel met
  - zoekveld **per kolom**: `searchable(isIndividual: true, isGlobal: false)`
  - kolommen tonen/verbergen: `toggleable()`
  - kolommen verslepen: `reorderableColumns()` (in de kolombeheer-knop)
  - **geavanceerd filter**: `QueryBuilder` met tekst- en datumregels, EN/OF-groepen

## Tests

```bash
php artisan test
```

## Na een Filament-update

`php artisan filament:assets` (de gepubliceerde bestanden in `public/js|css|fonts/filament` staan in git).

## Bronnen

- Filament resources: https://filamentphp.com/docs/5.x/resources
- Filament table columns: https://filamentphp.com/docs/5.x/tables/columns
- Filament Query Builder: https://filamentphp.com/docs/5.x/tables/filters/query-builder
- Laravel localization: https://laravel.com/docs/13.x/localization
