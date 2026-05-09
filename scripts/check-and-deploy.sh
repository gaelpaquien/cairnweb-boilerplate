#!/usr/bin/env bash
# Cron job (every 5 min). Detects new commits on origin/master
# and triggers deploy.sh. Exits silently if already up-to-date.
set -euo pipefail

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
REPO_DIR="$( cd "$SCRIPT_DIR/.." && pwd )"
cd "$REPO_DIR"

git fetch origin master --quiet

LOCAL=$(git rev-parse HEAD)
REMOTE=$(git rev-parse origin/master)

if [ "$LOCAL" = "$REMOTE" ]; then
    exit 0
fi

echo "[$(date '+%F %T')] New commits detected on master — triggering deploy"
exec bash "$SCRIPT_DIR/deploy.sh"
