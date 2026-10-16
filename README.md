# Landers

Every top-level directory in this repo is a landing page. Push it to `main` and it goes live.

## How it works

1. You push a commit to `main`.
2. GitHub sends a push webhook to `deploy.php` on the web server.
3. `deploy.php` checks the webhook signature, confirms the push was to `refs/heads/main`, and runs `git pull origin main` in `/var/www/landers`.
4. The web server maps every top-level folder in `/var/www/landers` to a wildcard subdomain of `stockstobuy.io`:

   | Directory in repo | Live at |
   | --- | --- |
   | `test/index.php` | `https://test.stockstobuy.io` |
   | `test2/index.php` | `https://test2.stockstobuy.io` |

Pushes to any other branch are ignored. The webhook replies `Ignored branch.` and nothing is deployed.

## Adding a new lander

```bash
mkdir my-offer
echo "Hello Landers" > my-offer/index.php
git add my-offer
git commit -m "Add my-offer lander"
git push origin main
```

A few seconds later the page is live at `https://my-offer.stockstobuy.io`.

In Claude Code, the `lander-generator` skill (`.claude/skills/lander-generator/SKILL.md`) does this from a template in `_templates/`.

To take a lander down, delete its directory and push to `main`.

## Notes

- The directory name becomes the subdomain, so use lowercase letters, digits and hyphens only.
- Give each lander an `index.php` or `index.html` so the subdomain root loads it.
- Use relative asset paths so they resolve on the subdomain root.
- Work on a branch and merge into `main` when the page is ready. Merging is the deploy.
- `deploy.php` is itself served from the web root, so it's publicly reachable. The signature check stops anyone without the secret from triggering a pull.
