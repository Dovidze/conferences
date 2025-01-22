
# Konferencijų registracijos sistema
Baigiamasis darbas

Šis projektas yra internetinė sistema, skirta konferencijų registracijai ir konferencijų duomenų valdymui. Sistema apima skirtingus naudotojų vaidmenis, kuriems suteikiami skirtingi prieigos lygiai.

# Naudotojų vaidmenys
#### Klientas 
- Gali peržiūrėti būsimąsias konferencijas ir užsiregistruoti į jas.
#### Darbuotojas
- Gali matyti visas įvykusias ir būsimąsias konferencijas, matyti užsiregistravusius klientus į konkrečią konferenciją. Darbuotojas negali atlikti jokių veiksmų su įrašais.
#### Administratorius
- Turi pilną prieigą kurti, redaguoti ir šalinti konferencijų duomenis, taip pat redaguoti naudotojų informaciją (vardą, pavardę).

# Funkcijos
#### Registracija
- Klientai gali registruotis į konferencijas.
#### Konferencijų valdymas
- Administratoriai gali kurti, redaguoti ir šalinti konferencijas.
#### Prieigos valdymas pagal vaidmenis
- Sistemos funkcionalumas yra ribojamas pagal naudotojo vaidmenį naudojant Blade direktyvas ir Middleware.
#### Duomenų validacija
- Naudotojo ir konferencijų duomenys yra tikrinami siekiant užtikrinti nuoseklumą.

#### Techninės specifikacijos
- Backend'as: PHP ir Laravel.
- Laravel Mix naudojamas JavaScript ir CSS failų kompiliavimui.
- Duomenų bazė: SQlite.
- Frontend'as: Bootstrap (CSS), Axios (HTTP užklausoms).
- SweetAlert2 pranešimams sukurti.

#### Technologijų rinkinys
- Laravel (PHP framework)
- SQlite (duomenų bazė)
- Bootstrap (CSS framework)
- Axios (HTTP klientas)
- SweetAlert2 (UI pranešimai)
- Laravel Mix (kompiliavimas)

# Projekto vaizdai
#### 1. Pagrindinis puslapis
![PradinisPuslapis](https://github.com/user-attachments/assets/620bf4da-06fa-4f77-adab-2ceea5d49433)

#### 2. Konferencijų valdymas (LT)
![KonferencijuValdymasLT](https://github.com/user-attachments/assets/fd33e201-3143-4373-8b03-6c7198c81234)

#### 3. Konferencijų valdymas (EN)
![KonferencijųValdymasEN](https://github.com/user-attachments/assets/58ec9a99-a2b1-4f62-8a6e-648141a0cb34)

#### 4. Vartotojų valdymas
![VartotojuValdymas](https://github.com/user-attachments/assets/b9dad132-e410-44fd-8fd7-f346a9cbc98b)

# Įdiegimas
#### 1. Priklausomybės
``` bash 
cd <project_directory>
composer install
npm install
```
#### 2. Duom. bazės migracijos
``` bash 
php artisan migrate
```
#### 3. Kompiliavimas ir paleidimas
``` bash
npm run dev
php artisan serve
```
#### 4. Papildoma
Atsidarius projektą naršyklėje, norint pasiekti Administratoriaus panelę, reikia užregistruoti nauja vartotoją. Jau po registracijos, terminale :
*Naudojant tinker*
``` bash
php artisan tinker
```
``` php
$user = App\Models\User::where('name', 'jusu_name')->first();
$user->role_id = 3;
$user->save();
exit
```
# Autorius
**Dovydas**
- [GitHub](https://github.com/Dovidze)
