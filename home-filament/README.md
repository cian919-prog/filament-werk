# Laravel + Tailwind + Blade + Filament starter

Een kant-en-klaar Laravel-project met:

- Laravel 13
- Filament 5
- Tailwind CSS 4
- Blade layout voor de normale applicatiepagina's
- Nederlands als standaardtaal, plus Engels
- Login via het Filament-panel
- Linker navigatie met submenu
- Taalkeuze in de header
- Gebruikersmenu met profiel/instellingen en logout
- Profielpagina in Blade
- Filament gebruikersbeheer op `/admin/users`
- Gebruiker aanmaken via een Filament modal action
- Wijzigen en verwijderen van gebruikers
- Per-kolom zoeken
- Kolommen tonen/verbergen via de Filament column manager
- Kolommen verslepen/reorderen
- Geavanceerde Query Builder filters

## Belangrijke routes

- `/dashboard` — Blade dashboard
- `/profile` — profiel/instellingen
- `/admin/login` — Filament login
- `/admin/users` — Filament gebruikersbeheer

## Demo-account

De database seeder bevat:

- E-mail: `admin@example.com`
- Wachtwoord: `password`

Wijzig dit direct voor een echte omgeving.

## Technische notities

De Blade layout staat in `resources/views/layouts/app.blade.php`. De layout gebruikt Alpine voor de dropdowns en Tailwind via Vite.

De individuele kolomzoekvelden gebruiken Filament's `searchable(isIndividual: true, isGlobal: false)`. De kolommen kunnen met `toggleable()` worden verborgen/getoond en de hele tabel gebruikt `reorderableColumns()`.

Het geavanceerde filter gebruikt Filament 5's `QueryBuilder` met tekst-, boolean- en datumconstraints.

De Filament gebruikerslijst gebruikt een `CreateAction` in de toolbar zodat het aanmaken in een modal gebeurt en geen aparte create-pagina nodig heeft.

Bronnen:
- Laravel Blade: https://laravel.com/docs/13.x/blade
- Laravel authentication: https://laravel.com/docs/13.x/authentication
- Filament 5 installation: https://filamentphp.com/docs/5.x/introduction/installation
- Filament 5 resources: https://filamentphp.com/docs/5.x/resources
- Filament 5 table columns: https://filamentphp.com/docs/5.x/tables/columns
- Filament 5 Query Builder: https://filamentphp.com/docs/5.x/tables/filters/query-builder
- Filament 5 create actions: https://filamentphp.com/docs/5.x/actions/create
