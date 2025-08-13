# 🌐 HYIP MAX

## About
HYIP MAX is an advanced, multilingual, and stable HYIP Investment Management Platform. It comes with features like deposits, withdrawals, investment plans, and referral commissions, and is fit for all kinds of devices. 📈💰📱

## 🚀 Features

- **Deposits**: Easily manage your investment deposits.
- **Withdrawals**: Secure and quick withdrawal options.
- **Investment Plans**: Flexible plans to suit your investment goals.
- **Referral Commissions**: Earn by referring others.

## 📂 Project Structure

### Documentation/images
- **abc**
  - `install`
    - `001.png`
    - `0010.png`
    - `002.png`
    - `003.png`
    - `10.jpg`
    - `11.jpg`
    - `11.png`
    - `12.jpg`
    - `12.png`
    - `13.png`
    - `14.jpg`
    - `14.png`
    - `15.png`
    - `16.png`
    - `2.jpg`
    - `4.jpg`
    - `8.jpg`
    - `80.png`
    - `9.jpg`
- `Frontend.png`
- `General_Settings.png`
- `Manage_Language.png`
- `Manage_Plan.png`
- `Manage_Referral.png`
- `Manage_Time.png`
- `Manage_Time.png.png`
- `Manage_Users.png`
- `Manage_Withdraw.png`
- `Manual_Payments.png`
- `Newsletter_Subscriber.png`
- `Payment_Gateway.png`
- `Report.png`
- `Ticket.png`
- `User_Interest_Log.png`
- `agree.png`
- `boom.png`
- `cronjob.png`
- `deposit.png`
- `depositt.png`
- `email.png`
- `env.png`
- `ftp_1.png`
- `ftp_10.png`
- `ftp_11.png`
- `ftp_2.png`
- `ftp_3.png`
- `ftp_4.png`
- `ftp_5.png`
- `ftp_6.png`
- `ftp_7.png`
- `ftp_8.png`
- `ftp_9.png`
- `installer-overview.jpg`
- `jobs.png`
- `logo.png`
- `projectandtask.JPG`
- `propertyplan.png`
- `server1.png`
- `server2.png`
- `server3.png`
- `server4.png`
- `server5.png`
- `server6.png`
- `server7.png`
- `start.jpg`
- `start.png`
- `structure.png`
- `theme.png`

### Scripts
- `asset`
- `core`
- `install/src`

### LICENSE
- The license information for the project.

### README.md
- Provides an overview and instructions for the project.

## 🛠 Setup

1. **Clone the repository**:
    ```sh
    git clone https://github.com/nectariferous/hyip-investment-platform.git
    cd hyip-investment-platform
    ```

2. **Follow the installation instructions in the `Documentation/install` directory.**

## 📝 License

This project is licensed under the MIT License. See the `LICENSE` file for details.

## 💬 Feedback

For feedback and questions, please open an issue or contact [nectariferous](https://github.com/nectariferous).

---

## 🚀 Déploiement sur Render (PHP + PostgreSQL)

Voici un guide rapide pour déployer l’application sur Render en production avec PostgreSQL.

### Prérequis
- Un compte Render (https://render.com)
- Un fork ou accès à ce dépôt GitHub

### Structure du projet
- Le code Laravel est sous `core/`
- Le point d’entrée web est `core/public/index.php`
- La configuration base de données PostgreSQL est dans `core/config/database.php`

### Fichier blueprint Render
- Le dépôt inclut `render.yaml`, qui définit:
  - Un service Web PHP
  - Une base de données managée PostgreSQL
  - Les commandes de build et de démarrage adaptées à Laravel

### Étapes de déploiement
1. Sur Render, cliquez sur “New +” → “Blueprint” et sélectionnez ce repo.
2. Render détectera `render.yaml` et provisionnera:
   - Un service Web: build dans `core/` (composer install, caches artisan, etc.)
   - Une base PostgreSQL (plan gratuit par défaut)
3. Après création, ouvrez la ressource Base de données et notez les variables:
   - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
4. Allez au service Web et ajoutez ces variables d’environnement:
   - `DB_CONNECTION=pgsql`
   - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
   - `DB_SSLMODE=require` (par défaut dans `render.yaml`)
   - `DB_SCHEMA=public` (par défaut)
   - Optionnel: `APP_URL=https://<votre-domaine>`
5. Redéployez si nécessaire. La clé applicative `APP_KEY` est générée en build (`php artisan key:generate --force`).

### Notes importantes
- Ne commitez pas `core/vendor/` ni `core/.env` (déjà gérés dans `.gitignore`).
- Si des migrations applicatives sont absentes, vous devrez:
  - Utiliser l’installateur initial si prévu par le projet, ou
  - Me demander de générer/adapter des migrations compatibles PostgreSQL.
- Le module de paiement crypto existant est désactivé; une intégration Fusion Pay sera faite ultérieurement.

### Dépannage
- Erreurs PDO/pgSQL: vérifiez les variables `DB_*` et que `DB_SSLMODE=require` est compatible avec votre instance.
- 404/500 au démarrage: assurez-vous que le service démarre avec `-t core/public` et que `core/bootstrap/app.php` existe.
- Problèmes de cache: re-déployez ou exécutez `php artisan config:clear && php artisan route:clear && php artisan view:clear` dans le build.

Happy investing! 🎉
