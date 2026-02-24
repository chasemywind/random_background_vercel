
[![Platform](https://img.shields.io/badge/platform-Vercel-black?logo=vercel)](https://vercel.com)
[![Language](https://img.shields.io/badge/language-PHP-blue?logo=php)](https://www.php.net)
[![License](https://img.shields.io/badge/license-See_LICENSE-lightgrey)](LICENSE)

# Random Background Redirect

选择语言 / Choose language

- 🇨🇳 [中文（简体）](README.zh-CN.md)
- 🇺🇸 [English](README.en.md)

此页面为语言选择页；请点击上方链接查看对应语言的完整说明文档。
- API 仅返回重定向，不进行图片代理或缓存。

License & Thanks:
- 项目遵循仓库中的 LICENSE 文件许可。

---

Project (English)

This is a simple "random image redirect" service adapted for Vercel. Each request to the API returns a 302 redirect to a randomly chosen image URL from the list.

Important: This project is tailored for Vercel's runtime and directory layout and may not work identically in all local PHP setups (see "Running locally").

Files:
- `api/index.php`: API entry — reads the images list and performs a random redirect (see [api/index.php](api/index.php)).
- `file/images.txt`: List of image URLs, one per line; lines starting with `#` are comments (see [file/images.txt](file/images.txt)).
- `vercel.json`: Vercel configuration (see [vercel.json](vercel.json)).

Usage & examples:

- Add image URLs to `file/images.txt`, one per line:

```
https://example.com/image1.jpg
https://example.com/image2.png
# comment line
```

- After deployment, request the API:

```
https://<YOUR_DEPLOYMENT>.vercel.app/api/
```

Example using curl:

```
curl -I https://<YOUR_DEPLOYMENT>.vercel.app/api/
```

To download the image (follow redirects):

```
curl -L https://<YOUR_DEPLOYMENT>.vercel.app/api/ -o random.jpg
```

Running locally (may be limited):

1. `api/index.php` uses `$_SERVER['DOCUMENT_ROOT'] . '/file/images.txt'` to locate the list; this works reliably in Vercel but can differ locally.
2. If you run a local PHP server, start it from the project root so paths resolve correctly:

```bash
php -S localhost:8000
```

3. If you see errors about missing files, check `$_SERVER['DOCUMENT_ROOT']` and adjust the path or start the server from the repo root.

Deploying to Vercel:

Use the Vercel dashboard to import the repo or the Vercel CLI:

```bash
npm i -g vercel
vercel
```

Notes:
- Use full, directly accessible URLs in `file/images.txt` (http(s)://...).
- `file/images.txt` supports comments and blank lines.
- The API only issues redirects; it does not proxy or cache images.