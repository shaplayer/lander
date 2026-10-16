---
name: lander-generator
description: Create a new landing page in the shaplayer/lander repo from a template and deploy it by pushing to main. Use when the user asks to create, add, scaffold or launch a lander or landing page, or asks which subdomain a lander will be live on.
---

# Lander Generator

Creates, templates and deploys landing pages in the `shaplayer/lander` repository.

## Architecture & routing rules

1. **Repository structure**: each lander is a top-level directory at the repo root.
2. **Wildcard subdomain mapping**: on the server the repo is checked out at `/var/www/landers/`, and every top-level folder there maps to a subdomain of `*.stockstobuy.io`.
   - `promo/` → `https://promo.stockstobuy.io`
   - `vsl1/` → `https://vsl1.stockstobuy.io`
3. **Deployment flow**: any push to `main` triggers the GitHub webhook on the server (`deploy.php`), which runs `git pull` and makes the new lander live on its subdomain immediately.

The steps below run from the root of a checkout of the repo: the local clone, or `/var/www/landers` when working on the server itself.

## Instructions

### Step 1: Pull the latest repository state

```bash
git checkout main
git pull origin main
```

### Step 2: Generate the lander from a template

Pick the lander slug (`LANDER_NAME`) and source template (`TEMPLATE_NAME`). The slug becomes the subdomain, so it must be a valid hostname label: lowercase letters, digits and hyphens only, not starting or ending with a hyphen. Don't reuse a slug that already exists as a directory.

```bash
LANDER_NAME="my-new-lander"
TEMPLATE_NAME="default"

if [ -e "$LANDER_NAME" ]; then
    echo "Error: '$LANDER_NAME' already exists"
    exit 1
elif [ -d "_templates/$TEMPLATE_NAME" ]; then
    cp -r "_templates/$TEMPLATE_NAME" "$LANDER_NAME"
    echo "Created lander '$LANDER_NAME' from template '$TEMPLATE_NAME'"
else
    echo "Error: template '$TEMPLATE_NAME' not found in _templates/"
    ls _templates/ 2>/dev/null
    exit 1
fi
```

If `_templates/` doesn't exist yet or the requested template is missing, tell the user and ask whether to create the template first, rather than inventing one silently.

### Step 3: Customize content

Edit `index.html` (or `index.php`) and assets inside `$LANDER_NAME/`:
- Update page titles, copy, call-to-action links and images.
- Make CSS, JS and image references relative (`assets/style.css`, not `/assets/style.css` or an absolute URL to another lander) so they resolve on the subdomain root.

### Step 4: Commit and push to deploy

Pushing to `main` triggers the deployment webhook. Confirm with the user before pushing, since the push makes the page public.

```bash
git add "$LANDER_NAME"
git commit -m "feat(lander): add $LANDER_NAME using $TEMPLATE_NAME template"
git push origin main
```

Then tell the user the lander is live at `https://$LANDER_NAME.stockstobuy.io`.

## Template directory structure

```text
/var/www/landers/
├── _templates/
│   ├── default/
│   │   ├── index.html
│   │   └── assets/
│   ├── lead-gen/
│   └── vsl/
├── deploy.php
├── deploy.log
└── [lander-subdomain-folders]/
```
