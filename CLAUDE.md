# PLACEHOLDER — Boilerplate Cairn Web

Ce dépôt est un **boilerplate** prêt à l'emploi pour démarrer un projet client Cairn Web (Laravel + Statamic + Tailwind v4 + GSAP + Lenis). Il fournit un site fonctionnel (hero + 4 sections génériques + contact + footer + pages légales + pages d'erreur), un CMS Statamic 100% configuré, le SEO et l'accessibilité prêts.

> Tout ce qui est marqué **🔧 À CUSTOMISER** ci-dessous doit être ajusté lors du démarrage d'un projet client. Le reste (architecture, conventions, fonctionnalités) doit être préservé tel quel sauf besoin métier explicite.

---

## 🚀 Première utilisation du boilerplate

Checklist de démarrage d'un nouveau projet client :

1. **Cloner et installer**
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   npm install
   npm run build
   ```
2. **Renommer les références `PLACEHOLDER` / `John Doe` / `john.doe@mail.fr` / `0102030405` / `10 Rue de la Paix, 75000 Paris`** par les vraies données client (cf. **Recherche globale** plus bas).
3. **Adapter le contexte business** dans la section *Contexte du projet* de ce CLAUDE.md.
4. **Adapter les design tokens** (`resources/css/tokens/colors.css` et `resources/css/tokens/typography.css`) pour matcher la charte client.
5. **Ajouter les favicons du client** — le boilerplate n'en contient pas.
   - Uploader les 4 fichiers via le CP Statamic (Site > Favicons) : `favicon.ico`, `favicon-32x32.png`, `favicon-16x16.png`, `apple-touch-icon.png`. Tant que ces champs sont vides, le partial `favicons.blade.php` ne génère aucun `<link>`.
   - **Important :** copier aussi `favicon.ico` dans `public/favicon.ico` **et** `apple-touch-icon.png` dans `public/apple-touch-icon.png`. Les navigateurs (et iOS pour l'apple-touch-icon) font des requêtes automatiques à ces URLs racines indépendamment des `<link>` de la page — sans ces fichiers physiques, chaque visite génère un 404 dans les logs.
6. **Remplacer le contenu placeholder du CMS** : éditer `content/globals/default/*.yaml` ou passer par le CP Statamic (`/cp`) pour saisir le vrai contenu (hero, 4 sections, contact, site, ui).
7. **Adapter les pages légales** (`content/collections/pages/mentions-legales.md` et `politique-confidentialite.md`) avec les mentions réelles (raison sociale, hébergeur, RCS, etc.).
8. **Configurer Plausible Analytics** si besoin : remplir `PLAUSIBLE_SCRIPT_URL` dans `.env`. Sinon laisser vide pour désactiver.
9. **⚠️ Remplacer le user Statamic par défaut.** Le boilerplate fournit un super-admin par défaut pour pouvoir se connecter immédiatement à `/cp` :
   - **Email :** `admin@mail.fr`
   - **Mot de passe :** `password`
   - Fichier : `users/admin@mail.fr.yaml`

   **Avant la mise en prod**, créer un vrai compte (`php please make:user`) puis supprimer `users/admin@mail.fr.yaml`. Ne jamais déployer ce user en production.
10. **Adapter les scripts de déploiement** (`scripts/deploy.sh`, `scripts/auto-commit-content.sh`) côté `GIT_AUTHOR` (email/nom du bot) et configurer les crons sur le serveur cible.

### Recherche globale à exécuter (sed safe)

```bash
# Vérifier qu'il ne reste plus de placeholders dans le code/contenu
grep -r "PLACEHOLDER\|John Doe\|john\.doe@mail\.fr\|0102030405\|10 Rue de la Paix" \
  --include='*.yaml' --include='*.md' --include='*.php' --include='*.blade.php' \
  --exclude-dir=node_modules --exclude-dir=vendor --exclude-dir=.git .
```

---

## Contexte du projet

> **🔧 À CUSTOMISER** — Décrire ici le projet client : qui, quoi, pour qui, stratégie SEO, particularités métier.

**Pour qui / quoi :** *(Description du projet client : type de site — vitrine, e-commerce, application —, secteur d'activité, objectif business principal.)*

**Cible :** *(Profil-type des visiteurs : type d'entreprise, géographie, niveau technique, attentes principales.)*

**Stratégie SEO :** *(Mots-clés ciblés, géographie, longue traîne, contenus éditoriaux exploités.)*

---

## Stack technique

| Couche        | Techno                             | Version |
|---------------|------------------------------------|---------|
| Framework     | Laravel                            | 12      |
| CMS           | Statamic (flat-file)               | 6       |
| CSS           | Tailwind CSS + `@tailwindcss/vite` | 4       |
| Animations    | GSAP (ScrollTrigger)               | 3       |
| Smooth scroll | Lenis                              | —       |
| Build         | Vite                               | 7       |
| PHP           | 8.4+                               | —       |

---

## Design

> **🔧 À CUSTOMISER** — Les tokens ci-dessous sont les valeurs par défaut héritées du site vitrine Cairn Web. Les remplacer par la charte du projet client dans `resources/css/tokens/colors.css` et `resources/css/tokens/typography.css`.

Tous les tokens sont définis dans `resources/css/tokens/` et doivent être consommés via `var()` ou via Tailwind. **Jamais de valeurs hardcodées** dans les composants (couleurs, tailles, espacements, transitions).

### Couleurs (valeurs par défaut — palette neutre)

Les couleurs du boilerplate sont neutres (grays + un bleu basique en accent) pour rester sans identité visuelle marquée. Les remplacer par la charte du projet client.

**Sections sombres**

| Rôle               | Token                  | Valeur     |
|--------------------|------------------------|------------|
| Background         | `--color-dark-bg`      | `#1F2937`  |
| Surface/cards      | `--color-dark-surface` | `#374151`  |
| Borders            | `--color-dark-border`  | `#4B5563`  |
| Texte              | `--color-dark-text`    | `#F9FAFB`  |
| Texte secondaire   | `--color-dark-muted`   | `#9CA3AF`  |

**Footer — bien plus sombre que les sections dark (pour ressortir)**

| Rôle       | Token                    | Valeur     |
|------------|--------------------------|------------|
| Background | `--color-footer-bg`      | `#030712`  |
| Borders    | `--color-footer-border`  | `#1F2937`  |

**Sections claires**

| Rôle               | Token                   | Valeur     |
|--------------------|-------------------------|------------|
| Background         | `--color-light-bg`      | `#FFFFFF`  |
| Surface/cards      | `--color-light-surface` | `#F9FAFB`  |
| Borders            | `--color-light-border`  | `#E5E7EB`  |
| Texte              | `--color-light-text`    | `#111827`  |
| Texte secondaire   | `--color-light-muted`   | `#6B7280`  |

**Accent (à remplacer par la couleur de marque)**

| Rôle         | Token                  | Valeur     |
|--------------|------------------------|------------|
| Accent       | `--color-accent`       | `#2563EB`  |
| Accent hover | `--color-accent-hover` | `#1D4ED8`  |
| Success      | `--color-success`      | `#16A34A`  |
| Error        | `--color-error`        | `#DC2626`  |

### Typographies (valeurs par défaut)

- **Titres :** Satoshi (Bold 700, Black 900) — fichiers locaux dans `public/fonts/satoshi/`
- **Body :** DM Sans (variable 400–600) — fichiers locaux dans `public/fonts/dm-sans/`
- Tailles fluides via `clamp()` (cf. `tokens/typography.css`)
- Surtitres : 14px, uppercase, letter-spacing 0.1em, semibold

> Pour changer de police : remplacer les fichiers dans `public/fonts/`, mettre à jour les `@font-face` dans `resources/css/tokens/typography.css`, puis ajuster `--font-heading` et `--font-body`.

### Breakpoints

Breakpoints Tailwind v4 par défaut (`sm` 640px, `md` 768px, `lg` 1024px, `xl` 1280px, `2xl` 1536px). **Mobile-first obligatoire** — coder pour 320px puis enrichir avec les préfixes responsive. Le site doit fonctionner de 320px à 1920px+.

### Animations

- Lenis pour le smooth scroll global
- GSAP ScrollTrigger pour les fade-up et stagger au scroll
- GSAP timeline pour l'animation d'entrée du hero
- Navbar : transition d'opacité + border-bottom au scroll (gérée par `resources/js/modules/navbar.js`)
- Toutes les animations doivent respecter `prefers-reduced-motion`

### Structure visuelle de la home

- **Hero** (thème *dark*, navbar même couleur que le hero, aurora blobs animés)
- **4 sections génériques** (alternance *light* → *dark* → *light* → *dark*)
- **Contact** (prend le thème opposé à la dernière section, soit *light* dans la config par défaut)
- **Footer** (thème *dark* renforcé via `--color-footer-bg`, plus sombre que les sections dark)

L'alternance des thèmes est calculée automatiquement par `resources/views/pages/home.blade.php` à partir de l'index des 4 globals `section_1` à `section_4`.

---

## Approche CMS

**Tout le contenu textuel est éditable dans Statamic. Aucun contenu en dur dans les templates.**

Cela inclut, sans exception :
- Tous les titres, paragraphes, libellés de boutons, textes de CTA
- Les `alt` d'images et libellés ARIA
- Les meta titles, meta descriptions, données structurées
- Les coordonnées (téléphone, email, adresse, horaires)
- Les libellés des champs de formulaire et messages d'erreur

**Règles de synchronisation :**
- Le projet doit toujours être synchronisé avec Statamic — aucun code mort côté CMS (blueprint/global/champ inutilisé), aucun champ référencé dans une vue sans existence côté blueprint.
- Toute suppression d'un usage côté template doit s'accompagner du nettoyage du blueprint et du global associé.
- La structure CMS doit rester **claire, simple et efficace**, utilisable par un novice qui n'a jamais touché à un CMS : libellés français explicites, regroupements logiques, pas de duplication, instructions de champ quand utile.

**Organisation Statamic du boilerplate :**
- **GlobalSets** (`content/globals/`) — 8 GlobalSets fournis :
  - `site` : infos transverses (nom de marque, contact, navigation, footer, SEO meta, données structurées, favicons, pages d'erreur).
  - `hero` : contenu du bloc hero (overtitle, titre, accent, sous-titre, CTA).
  - `section_1`, `section_2`, `section_3`, `section_4` : un global dédié par section générique (titre H2 + contenu). Volontairement séparés en globals distincts pour faciliter l'édition côté CP. L'alternance light/dark est gérée par le template (index pair → light, impair → dark).
  - `contact` : contenu du bloc contact (titre, libellés/placeholders du form, messages succès/erreur, validation).
  - `ui` : micro-textes (skip link, ARIA labels nav/footer, breadcrumb).
- **Collections** (`content/collections/`) :
  - `pages` : home + pages légales (mentions-legales, politique-confidentialite). Le boilerplate fournit ces 3 entrées avec contenu placeholder.
- **Blueprints** : définitions de champs dans `resources/blueprints/globals/` et `resources/blueprints/collections/pages/`.

**Image processing :**
- Glide gère le redimensionnement et le `srcset` à la volée. La conversion **WebP** est servie automatiquement par Glide via négociation HTTP `Accept` (le navigateur reçoit du WebP s'il l'annonce, sinon le format d'origine) — pas besoin de forcer `format=webp` côté template. Toujours passer par Glide et par le composant `<x-responsive-image />` — jamais d'`<img>` brut sur un asset Statamic.

**Injection des données dans les templates :**

```blade
@php
    $heroGlobal = \Statamic\Facades\GlobalSet::findByHandle('hero')?->inCurrentSite();
@endphp

{{ $heroGlobal->get('title') }}
{{ $heroGlobal->get('subtitle') }}
```

- Toujours via `GlobalSet::findByHandle('handle')?->inCurrentSite()` (null-safe).
- Stocker dans une variable `$xxxGlobal` quand le global est utilisé plusieurs fois dans la même vue.
- `->get('field')` pour les valeurs simples (texte, toggle, integer…).
- `->augmentedValue('field')->value()` pour les champs augmentés (assets Statamic, relations) — c'est la valeur augmentée qui expose les méthodes Glide / l'objet `Asset`.
- Pour les champs `array`/`grid` (ex. `nav_items`, `site.errors`), `->get('field')` retourne directement un tableau itérable avec `@foreach`.
- La résolution d'ancres `#section` depuis une sous-page passe par `\App\Support\Url::anchor($href)` ou la directive Blade `@anchor($href)`.

---

## Conventions de code

- **Anglais uniquement** pour le code (variables, fonctions, classes, fichiers, commits techniques). Le contenu utilisateur reste en français côté CMS.
- **Pas de commentaires** sauf quand ils expliquent un choix non évident. Pas de comment décoratif, pas de redite de ce que fait le code.
- **Pas de commit automatique** — jamais de `git commit` sans demande explicite. Format quand demandé : `[Type] Short description` en français, sans `Co-Authored-By`.
- **Design tokens obligatoires** — interdit de hardcoder une couleur, taille de police, espacement ou transition dans un composant. Toujours via `var(--token)` ou la classe Tailwind correspondante.
- **Tout CSS custom dans `@layer components`** — composants et pages CSS doivent être enveloppés dans `@layer components { … }`. Sans layer, le CSS custom passe au-dessus du layer `utilities` de Tailwind dans la cascade et empêche les utilitaires (ex : `.hidden` toggleée par JS) de gagner. Exemples : `forms.css`, `buttons.css`, `pages/home/contact.css`.
- **Pas de SVG brut dans les templates** — toujours un composant Blade (`<x-icons.* />`).
- **Factorisation systématique** — dès qu'un pattern se répète (bouton, input, carte, surtitre, section…), créer un composant Blade dans `resources/views/components/` plutôt que dupliquer.

---

## Structure du projet

### Code applicatif

```
app/
├── Http/
│   ├── Controllers/        # ContactController (POST /contact), SitemapController (GET /sitemap.xml)
│   ├── Middleware/         # SecurityHeaders (CSP + headers de sécurité)
│   └── Requests/           # FormRequest validés (contact)
├── Mail/                   # Mailables (notification de leads)
├── Support/                # Helpers transverses (Url::anchor)
└── Providers/              # Service providers Laravel/Statamic

routes/
├── web.php                 # Routes publiques + endpoint contact + sitemap + robots
└── console.php             # Commandes artisan custom
```

### Front (compilé par Vite)

```
resources/
├── css/
│   ├── app.css             # Entrée principale, importe tout dans l'ordre
│   ├── tokens/             # colors.css, typography.css (incl. @font-face), spacing.css
│   ├── base/               # reset.css, typography.css (styles de base)
│   ├── components/         # sections, buttons, forms, nav, footer, logo
│   ├── effects/            # grain.css, animations.css
│   └── pages/              # error.css, legal.css + home/ (hero.css, sections.css, contact.css)
│
├── js/
│   ├── app.js              # Entrée principale
│   ├── animations/         # smooth-scroll (Lenis), scroll-reveals (GSAP), hero-animation
│   ├── modules/            # navbar, contact-form (logique interactive)
│   └── utils/              # dom.js (helpers DOM)
│
└── views/
    ├── layouts/            # default.blade.php (layout unique du site)
    ├── pages/              # home.blade.php, legal.blade.php
    ├── errors/             # minimal.blade.php + 403/404/419/429/500/503 (one-liners)
    ├── partials/           # seo-meta, structured-data, favicons
    ├── emails/             # contact.blade.php (template plain-text)
    └── components/
        ├── icons/          # composants SVG (arrow-right, check, clock, mail, map-pin, phone)
        ├── contact/        # sous-composants du formulaire (success-state, error-banner)
        ├── button.blade.php, nav.blade.php, footer.blade.php,
        └── overtitle.blade.php, section.blade.php, responsive-image.blade.php, ...
```

### Statamic (contenu et schémas)

```
content/                              # Contenu, versionné en Git
├── globals/                          # GlobalSets — site, hero, section_1..4, contact, ui
│   ├── site.yaml, hero.yaml, contact.yaml, ui.yaml
│   ├── section_1.yaml, section_2.yaml, section_3.yaml, section_4.yaml
│   └── default/                      # données réelles (sites Statamic multi-sites)
├── collections/
│   └── pages/                        # home.md + pages légales (mentions, confidentialité)
├── assets/                           # Médias uploadés via le CP
└── trees/                            # Arbres de navigation

resources/blueprints/                 # Schémas (champs, validations, libellés FR)
├── globals/                          # 1 yaml par GlobalSet ci-dessus
└── collections/pages/                # blueprint des entrées de la collection pages

users/                                # Comptes Statamic CP (flat-file). Contient un user par défaut admin@mail.fr / password à remplacer avant prod.
```

**Pourquoi cette structure :** Statamic en flat-file → tout le contenu est versionné dans Git (rollback granulaire, pas de dump SQL). Les blueprints décrivent les champs visibles dans le panneau d'admin (libellés français). Les fichiers `.yaml` de `content/globals/default/` sont l'image rendue par les éditeurs côté CP.

---

## Standards qualité

### SEO (priorité maximale)

Le SEO est un **objectif business**, pas une option. À respecter systématiquement :

- HTML sémantique strict (`header`, `nav`, `main`, `section`, `article`, `footer`) — un seul `<h1>` par page, hiérarchie de titres cohérente.
- `<title>`, meta description, canonical, balises Open Graph et Twitter Card éditables depuis le CMS (cf. `partials/seo-meta.blade.php`).
- Données structurées JSON-LD (`partials/structured-data.blade.php`) — Organization / ProfessionalService, BreadcrumbList, WebPage selon le contexte.
- URLs propres, slugs explicites, pas de paramètres parasites.
- `sitemap.xml` (servi par `SitemapController`) et `robots.txt` (route inline dans `routes/web.php`) cohérents.
- Optimisation images : `alt` descriptifs (depuis le CMS), WebP servi par Glide via négociation HTTP `Accept`, dimensions explicites pour éviter le CLS.

> **🔧 À CUSTOMISER** — Adapter les `schema_*` du global `site` (description, SIREN, TVA, founder, sameAs, opening hours, price range, service types, areas served) au business client.

### Accessibilité

- Libellés ARIA sur tous les éléments interactifs (sourcés depuis le CMS, global `ui`).
- Navigation clavier complète, focus states visibles et cohérents.
- Skip link `#content` (visible au focus clavier) au sommet de chaque page.
- Respect de `prefers-reduced-motion` (désactivation des animations via `app.js`).
- Contraste suffisant — la palette est conçue pour, ne pas la dégrader lors du customising.
- Labels et messages d'erreur explicites sur les formulaires (sourcés depuis `contact.validation_messages`).
- Tailles de cible tactile ≥ 44px (`--touch-target`).

### Performance

- Pas de dépendance superflue (auditer `package.json` avant tout ajout).
- Polices : `font-display: swap`, preload des fichiers critiques, sous-ensembles `unicode-range`.
- Lazy loading sur tout ce qui est sous la ligne de flottaison.
- Images servies par Glide via `<x-responsive-image />` — `srcset` multi-tailles + WebP négocié automatiquement (HTTP `Accept`).
- JS minimal, pas d'animation bloquante au load (smooth-scroll et reveals lazy-loaded).

---

## Fonctionnalités backend

### Formulaire de contact & envoi d'emails

- **Route :** `POST /contact` (`routes/web.php`), throttled à **3 req/min** par IP, nommée `contact.store`.
- **Validation :** `App\Http\Requests\ContactRequest` (FormRequest Laravel) — règles strictes (longueurs min/max, regex téléphone FR). Tous les champs (prénom, nom, email, téléphone, message) sont **`required` inconditionnellement** dans le boilerplate. Messages d'erreur en français sourcés depuis le CMS (`contact.validation_messages`) via la méthode `messages()`.
- **Anti-spam (silencieux côté UX) :**
  - **Honeypot** : champ caché `website` validé `prohibited` (un humain ne le remplit pas, un bot oui).
  - **Timestamp guard** : champ `form_loaded_at` injecté côté client (la page est statiquement cachée) — toute soumission < 2 secondes après chargement est rejetée.
- **Envoi :**
  - `App\Mail\ContactMessage` (Mailable) — destinataire = `site.email` du CMS, sujet = `{email_subject_prefix} - {prénom nom}` (préfixe CMS).
  - `Reply-To` défini sur l'email du contact dès qu'il est renseigné (toujours, puisque l'email est requis).
  - Template **plain text** (`resources/views/emails/contact.blade.php`) — labels et titre du mail entièrement sourcés depuis le CMS (`contact` global).
- **Réponses :**
  - Requête AJAX (`X-Requested-With: XMLHttpRequest`) → JSON (`200`, `422` validation, `429` throttle, `503` mail failure).
  - Soumission classique (no-JS) → redirect `/#contact` avec flash session `contact_success` ou `contact_error` (state rendu côté Blade).
- **UX succès / erreur (composants `resources/views/components/contact/`) :**
  - `<x-contact.success-state>` — remplace entièrement le formulaire après envoi : icône check, titre (`success_title`), message (`success_message`) et fallback contact direct (téléphone + email tirés du global `site`, intro `success_contact_intro`). Affiché côté SSR sur `session('contact_success')`, ou côté JS via toggle `[data-contact-body].hidden` + `[data-contact-success]:not(.hidden)`.
  - `<x-contact.error-banner>` — bandeau d'erreur global (display: none par défaut, classe `.is-visible` pour afficher). Rendu une seule fois dans le formulaire avec l'attribut `data-contact-error-banner` ; rempli côté SSR si `session('contact_error')`, et côté AJAX par le module `contact-form.js` pour les erreurs `429`, `503` ou de réseau.
- **Logs :** échec d'envoi mail loggé via `Log::error` (jamais le contenu du message — seulement l'exception).

### Sitemap

- **Route :** `GET /sitemap.xml` (`routes/web.php`) → `SitemapController` (single-action `__invoke`).
- Génère le XML à la volée (pas de fichier statique) :
  - Homepage (`changefreq: weekly`, `priority: 1.0`).
  - Toutes les entrées de la collection `pages` **sauf** celles avec `template === 'pages/home'` (priorité `0.3`, `changefreq: yearly`).
  - `lastmod` calculé depuis `Entry::lastModified()`.
- Réponse `Content-Type: application/xml`.
- Référencé dans la route `GET /robots.txt` (servie dynamiquement par `routes/web.php`, pas un fichier statique).

### Pages d'erreur

- **Template unique** `resources/views/errors/minimal.blade.php` — utilise le layout principal et lit le contenu depuis le CMS.
- **Fichiers par code HTTP** (`403`, `404`, `419`, `429`, `500`, `503`) dans `resources/views/errors/{code}.blade.php` : chacun est un one-liner `@include('errors.minimal', ['code' => XXX])` qui sert de point d'entrée Laravel pour le code correspondant.
- **Contenu CMS** dans `site.errors` (grid Statamic, une ligne par code HTTP) avec `meta_title`, `heading`, `message`. Le libellé du bouton de retour est partagé via `site.error_button_text`.
- **Layout** : `body.is-error-page` active un sticky footer (la page remplit le viewport entre la navbar et le footer). CSS dédié dans `resources/css/pages/error.css`.
- **SEO** : `meta_robots` forcé à `noindex, follow` pour ne pas indexer ces pages.
- **Ajouter un nouveau code HTTP** : créer `resources/views/errors/{code}.blade.php` (one-liner), puis ajouter une entrée dans `site.errors` via le CP. Aucun code applicatif à toucher.

### Analytics — Plausible (optionnel)

- Script chargé **uniquement en production** (`@production` Blade) via `<script async>` dans `layouts/default.blade.php`.
- Activable en remplissant `PLAUSIBLE_SCRIPT_URL` dans `.env` (URL fournie par Plausible Cloud lors de la création du site). Vide = désactivé.
- RGPD-compliant : sans cookies, sans IP stockée — pas de bandeau de consentement nécessaire.
- **Événements custom** déclenchés via `window.plausible('Event Name')` :
  - `Contact Form Submit` — émis dans `home.blade.php` après le redirect post-succès du formulaire (state no-JS).
- CSP autorise `https://plausible.io` côté `script-src` et `connect-src` (cf. `SecurityHeaders` middleware) — adapter si Plausible est hébergé sur un autre domaine.

### Sécurité (en bref)

- `App\Http\Middleware\SecurityHeaders` ajoute CSP strict, HSTS (production), `X-Frame-Options DENY`, `X-Content-Type-Options nosniff`, `Referrer-Policy strict-origin-when-cross-origin` et une `Permissions-Policy` restrictive.
- CSP désactivée sur les routes `/cp*` (Statamic Control Panel — incompatible avec script `data:` + eval).

---

## Scripts & déploiement

### Scripts NPM

```bash
npm run dev      # Vite en watch (HMR)
npm run build    # Build de production
```

### Composer

```bash
composer dev     # Lance php artisan serve + npm run dev en parallèle
composer setup   # Install + key:generate + npm install + build (premier setup)
```

### Commandes Statamic / Laravel utiles

```bash
php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan route:clear
php please stache:clear && php please static:clear && php please glide:clear
php please stache:warm
```

Après chaque édition de blueprint ou de contenu, **vider tous les caches** (Laravel + Statamic stache/static/glide).

### Pipeline de déploiement

3 scripts dans `scripts/`, à lancer par cron sur le serveur de production :

| Script                     | Fréquence | Rôle                                                                                  |
|----------------------------|-----------|----------------------------------------------------------------------------------------|
| `auto-commit-content.sh`   | 15 min    | Détecte les éditions CP (`content/`, `resources/blueprints/`), commit + push sur master. |
| `check-and-deploy.sh`      | 5 min     | Compare `HEAD` local et `origin/master`. Si divergence → déclenche `deploy.sh`.       |
| `deploy.sh`                | sur trigger | Capture les éditions CMS pendantes, pull, `composer install`, `npm ci && npm run build`, vide et reconstruit tous les caches Laravel + Statamic, relink storage, ajuste les permissions. |

Un lock fichier (`.deploy.lock`) garantit qu'auto-commit et deploy ne tournent jamais en parallèle.

> **🔧 À CUSTOMISER** — Adapter `GIT_AUTHOR` (email/nom du bot de déploiement) dans `scripts/deploy.sh` et `scripts/auto-commit-content.sh`. Choisir la branche de production (master par défaut) et configurer les crons côté serveur.
