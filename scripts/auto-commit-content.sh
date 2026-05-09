#!/usr/bin/env bash
# Cron job (every 15 min). Detects content edits made via /cp
# and pushes them to GitHub master. Skips silently if a deploy is running.
set -euo pipefail

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
REPO_DIR="$( cd "$SCRIPT_DIR/.." && pwd )"
cd "$REPO_DIR"

exec 200>".deploy.lock"
flock -n 200 || exit 0

GIT_AUTHOR=(-c "user.email=deploy@placeholder.fr" -c "user.name=Deploy Bot")
WATCH_PATHS=(content resources/blueprints resources/fieldsets)

# git add fails atomically on missing paths — keep only the ones that exist.
EXISTING_PATHS=()
for path in "${WATCH_PATHS[@]}"; do
    [ -e "$path" ] && EXISTING_PATHS+=("$path")
done

if [ ${#EXISTING_PATHS[@]} -eq 0 ]; then
    exit 0
fi

git add -- "${EXISTING_PATHS[@]}"

if git diff --staged --quiet; then
    exit 0
fi

git "${GIT_AUTHOR[@]}" commit -m "Auto: content update"

git fetch origin master
if ! git "${GIT_AUTHOR[@]}" rebase origin/master; then
    echo "[$(date '+%F %T')] [ERROR] Rebase conflict — manual fix required" >&2
    git rebase --abort || true
    exit 1
fi

git push origin master
echo "[$(date '+%F %T')] Pushed content update"
