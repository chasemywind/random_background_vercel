[![Platform](https://img.shields.io/badge/platform-Vercel-black?logo=vercel)](https://vercel.com) [![Language](https://img.shields.io/badge/language-PHP-blue?logo=php)](https://www.php.net) [![License](https://img.shields.io/badge/license-See_LICENSE-lightgrey)](LICENSE)

# Random Background Redirect (Vercel-adapted)

🔗 Switch to: 🇨🇳 [中文（简体）](README.zh-CN.md)

## Table of Contents
- [Overview](#overview)
- [Quick example](#quick-example)
- [Files](#files)
- [Deploy (recommended: Vercel)](#deploy-recommended-vercel)
- [Running locally & limitations](#running-locally--limitations)
- [Notes](#notes)
- [License](#license)

## Overview

This is a lightweight "random image redirect" service adapted for Vercel. Each request to the API randomly selects an image URL from `file/images.txt` and returns a 302 redirect to that image.

Important: This project is tailored to Vercel's directory layout and runtime; it may not behave identically across all local PHP setups (see "Running locally & limitations").

## Quick example

Request the API after deployment:

```
https://<YOUR_DEPLOYMENT>.vercel.app/api/
```

Check response headers (redirect Location):

```
curl -I https://<YOUR_DEPLOYMENT>.vercel.app/api/
```

Follow redirect and download the image:

```
curl -L https://<YOUR_DEPLOYMENT>.vercel.app/api/ -o random.jpg
```

## Files

- `api/index.php`: API entry — reads `file/images.txt` and performs a random redirect (see [api/index.php](api/index.php)).
- `file/images.txt`: image URL list, supports comments (lines starting with `#`) and blank lines (see [file/images.txt](file/images.txt)).
- `vercel.json`: Vercel configuration (if present).

Example `file/images.txt` format:

```
https://example.com/image1.jpg
https://example.com/image2.png
# comment line
```

## Deploy (recommended: Vercel)

1. Push repo to GitHub (or another supported Git host).
2. Import the repository in the Vercel dashboard and deploy, or use the Vercel CLI:

```bash
npm i -g vercel
cd /path/to/project
vercel
```

After deployment, visit `https://<YOUR_DEPLOYMENT>.vercel.app/api/`.

## Running locally & limitations

1. `api/index.php` uses `$_SERVER['DOCUMENT_ROOT'] . '/file/images.txt'` to locate the list; this usually works in Vercel but can differ locally.
2. If running locally, start the PHP built-in server from the project root so paths resolve correctly:

```bash
php -S localhost:8000
```

3. If you encounter missing file errors, check `$_SERVER['DOCUMENT_ROOT']` and adjust paths or use `__DIR__`/relative paths for local debugging.

Therefore, deploying to Vercel is recommended for minimal configuration.

## Notes

- Use full, directly accessible URLs in `file/images.txt` (http(s)://...).
- `file/images.txt` supports comments and blank lines.
- The API only issues redirects; it does not proxy or cache images.
- Be mindful of image copyrights and sources.

## License

See the `LICENSE` file in the project root.