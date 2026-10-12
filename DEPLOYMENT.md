# Deploying the Ayurveda app

This is a Laravel application, so it must run on a PHP server connected to a MySQL database. It cannot be hosted as a static site.

## Deploy with Railway

1. Push the current project to the existing GitHub repository: `https://github.com/sangeerth-v/ayurveda_app`.
2. In Railway, create a new project from that GitHub repository. Railway detects the included `Dockerfile`.
3. Add a MySQL database service to the same Railway project.
4. In the web service's variables, add the following values. Copy the matching MySQL host, port, database, username and password from the Railway MySQL service.

   ```text
   APP_NAME=Ayurveda App
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=<generate locally with: php artisan key:generate --show>
   APP_URL=https://<your-railway-domain>
   LOG_CHANNEL=stderr
   DB_CONNECTION=mysql
   DB_HOST=<mysql-host>
   DB_PORT=<mysql-port>
   DB_DATABASE=<mysql-database>
   DB_USERNAME=<mysql-user>
   DB_PASSWORD=<mysql-password>
   SESSION_DRIVER=file
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   FILESYSTEM_DISK=public
   ```

5. Generate a public domain from the web service's Networking settings, then replace `APP_URL` with that exact HTTPS address and redeploy.
6. The container runs database migrations during deployment. To create the sample accounts and directory data, run this once in the Railway service shell:

   ```sh
   php artisan db:seed --force
   ```

## Before sharing the link

- Set production credentials for any SMS, WhatsApp, mail, payment, or video-call features you plan to enable.
- Uploads stored on the server filesystem are not durable on most managed hosts. Configure cloud storage (such as S3) before relying on uploaded photos in production.
- Keep `.env` private. It is intentionally excluded from Git and Docker builds.
