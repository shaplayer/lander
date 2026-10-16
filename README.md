# Landers

Every top-level directory in this repo is a landing page. Push it to `main` and it goes live.

## How it works

1. You push a commit to `main`.
2. GitHub sends a push webhook to `deploy.php` on the web server.
3. `deploy.php` checks the webhook signature, confirms the push was to `refs/heads/main`, and runs `git pull origin main` in `/var/www/landers`.
4. The web server serves `/var/www/landers`, so each directory becomes its own path:

   | Directory in repo | Live at |
   | --- | --- |
   | `test/index.php` | `https://<your-domain>/test/` |
   | `test2/index.php` | `https://<your-domain>/test2/` |

Pushes to any other branch are ignored. The webhook replies `Ignored branch.` and nothing is deployed.

## Adding a new lander

```bash
mkdir my-offer
echo "Hello Landers" > my-offer/index.php
git add my-offer
git commit -m "Add my-offer lander"
git push origin main
```

A few seconds later the page is live at `https://<your-domain>/my-offer/`.

To take a lander down, delete its directory and push to `main`.

## Notes

- Use a URL-safe directory name (lowercase, hyphens, no spaces), because the name becomes the URL path.
- Give each lander an `index.php` or `index.html` so the bare directory URL loads it.
- Work on a branch and merge into `main` when the page is ready. Merging is the deploy.
- `deploy.php` is itself served from the web root, so it's publicly reachable. The signature check stops anyone without the secret from triggering a pull.
