[![Platform](https://img.shields.io/badge/platform-Vercel-black?logo=vercel)](https://vercel.com) [![Language](https://img.shields.io/badge/language-PHP-blue?logo=php)](https://www.php.net) [![License](https://img.shields.io/badge/license-See_LICENSE-lightgrey)](LICENSE)

# 随机背景图片重定向（Vercel 适配）

🔗 切换到：🇺🇸 [English](README.en.md)

## 目录
- [简介](#简介)
- [快速示例](#快速示例)
- [文件说明](#文件说明)
- [部署（推荐：Vercel）](#部署推荐vercel)
- [本地测试与限制](#本地测试与限制)
- [注意事项](#注意事项)
- [许可](#许可)

## 简介

这是一个为 Vercel 平台优化的轻量级服务：每次访问 API 时，从 `file/images.txt` 中随机选择一条图片链接并返回 302 重定向到该图片。

> 重要：项目按照 Vercel 的目录和运行机制适配，可能无法在某些本地 PHP 环境中按原样工作（见“本地测试与限制”）。

## 快速示例

请求 API（部署后）：

```
https://<YOUR_DEPLOYMENT>.vercel.app/api/
```

使用 curl 查看响应头（重定向信息）：

```
curl -I https://<YOUR_DEPLOYMENT>.vercel.app/api/
```

跟随重定向并下载图片：

```
curl -L https://<YOUR_DEPLOYMENT>.vercel.app/api/ -o random.jpg
```

## 文件说明

- `api/index.php`：API 入口，读取 `file/images.txt` 并随机选择一条重定向（见 [api/index.php](api/index.php)）。
- `file/images.txt`：图片链接列表，支持注释（以 `#` 开头）和空行（见 [file/images.txt](file/images.txt)）。
- `vercel.json`：Vercel 部署配置（若存在）。

图片示例格式（`file/images.txt`）：

```
https://example.com/image1.jpg
https://example.com/image2.png
# 这是注释行
```

## 部署（推荐：Vercel）

1. 将仓库推送到 GitHub（或其他受支持的 Git 服务）。
2. 在 Vercel 控制台导入仓库并部署，或使用 Vercel CLI：

```bash
npm i -g vercel
cd /path/to/project
vercel
```

部署完成后访问 `https://<YOUR_DEPLOYMENT>.vercel.app/api/`。

## 本地测试与限制

1. `api/index.php` 使用 `$_SERVER['DOCUMENT_ROOT'] . '/file/images.txt'` 来定位图片列表，Vercel 的运行环境通常能正确解析此路径。
2. 在本地运行时，`DOCUMENT_ROOT` 的值可能与期望不同，导致找不到 `file/images.txt`。若发生此类错误：

- 确保从项目根目录启动 PHP 内置服务器：

```bash
php -S localhost:8000
```

- 或者在 `api/index.php` 中临时改用相对路径或 `__DIR__` 调整路径以便本地调试。

3. 因此强烈建议将此项目部署到 Vercel 以获得最少配置的运行体验。

## 注意事项

- 请在 `file/images.txt` 中使用可直接访问的完整图片 URL（以 `http://` 或 `https://` 开头）。
- 本服务仅返回 302 重定向，不会代理或缓存图片内容。
- 请注意图片版权与来源，确保有权使用和分发所列图片。

## 许可

详见项目根目录的 `LICENSE` 文件。