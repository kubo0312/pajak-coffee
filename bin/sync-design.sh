#!/usr/bin/env bash
# Sinkron design dari mockup statis ke app Laravel.
# Sumber utama: resources/css/site.css (dipakai Vite).
# Salinannya di public/css/ hanya untuk fallback kalau Vite mati dan belum ada build.
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
MOCKUP="$ROOT/../pajak-coffee-ui"

if [ ! -f "$MOCKUP/index.html" ]; then
  echo "mockup tidak ditemukan: $MOCKUP/index.html" >&2
  exit 1
fi

mkdir -p "$ROOT/resources/css" "$ROOT/public/css"

# 1. CSS: ambil isi <style> ... </style> apa adanya
sed -n '/^<style>/,/^<\/style>/p' "$MOCKUP/index.html" | sed '1d;$d' > "$ROOT/resources/css/site.css"
echo "css  -> resources/css/site.css ($(wc -l < "$ROOT/resources/css/site.css") baris)"

# 2. Salinan fallback (dibuat otomatis, jangan diedit tangan)
cp "$ROOT/resources/css/site.css" "$ROOT/public/css/site.css"
cp "$ROOT/resources/css/app-extras.css" "$ROOT/public/css/app-extras.css"
echo "css  -> public/css/ (fallback, disalin dari resources/css)"

# 3. Foto
if [ -d "$MOCKUP/assets" ]; then
  rm -rf "$ROOT/public/assets"
  cp -r "$MOCKUP/assets" "$ROOT/public/assets"
  echo "aset -> public/assets ($(ls "$ROOT/public/assets" | wc -l) file)"
fi

echo "selesai. Vite akan reload sendiri; kalau pakai build: npm run build"