#!/usr/bin/env bash
# Triggered by GitHub Actions on push to master.
# Pulls latest code, rebuilds assets, clears caches, warms Statamic.
set -euo pipefail

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
REPO_DIR="$( cd "$SCRIPT_DIR/.." && pwd )"
cd "$REPO_DIR"

# Wait for any running content auto-commit to finish before touching git.
exec 200>".deploy.lock"
flock 200

# Cron PATH is minimal — ensure php and composer are reachable.
export PATH="/usr/local/bin:$PATH"

# Non-interactive SSH shells skip .bashrc, so source NVM explicitly.
export NVM_DIR="$HOME/.nvm"
# shellcheck disable=SC1091
[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"

GIT_AUTHOR=(-c "user.email=deploy@placeholder.fr" -c "user.name=Deploy Bot")
WATCH_PATHS=(content resources/blueprints resources/fieldsets)

# git add fails atomically on missing paths — keep only the ones that exist.
EXISTING_PATHS=()
for path in "${WATCH_PATHS[@]}"; do
    [ -e "$path" ] && EXISTING_PATHS+=("$path")
done

echo "==> [$(date '+%F %T')] Capture pending CMS edits"
if [ ${#EXISTING_PATHS[@]} -gt 0 ]; then
    git add -- "${EXISTING_PATHS[@]}"
    if ! git diff --staged --quiet; then
        git "${GIT_AUTHOR[@]}" commit -m "Auto: content update (pre-deploy)"
        git fetch origin master
        git "${GIT_AUTHOR[@]}" rebase origin/master
        git push origin master
    fi
fi

echo "==> Sync with origin/master"
git fetch origin master
git reset --hard origin/master

echo "==> Composer install"
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "==> NPM build"
npm ci
npm run build

echo "==> Storage link"
php artisan storage:link --force || true

echo "==> Clear caches"
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php please stache:clear
php please static:clear
php please glide:clear

echo "==> Re-cache for production"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php please stache:warm

echo "==> Permissions"
chmod -R u+rwX,g+rX storage bootstrap/cache content

echo "==> [$(date '+%F %T')] Deploy completed"
