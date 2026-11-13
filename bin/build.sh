#!/usr/bin/env bash
# Build dist/da-gutenberg-blocks.zip (unpacks to da-gutenberg-blocks/), the file sites install and update from.
set -euo pipefail
cd "$(dirname "$0")/.."
rm -rf dist && mkdir -p dist/da-gutenberg-blocks
# Copy everything except repo-only files.
tar -cf - --exclude=./.git --exclude=./.github --exclude=./.gitignore --exclude=./.gitattributes \
  --exclude=./bin --exclude=./dist --exclude=.DS_Store --exclude=./CLAUDE.md . | tar -xf - -C dist/da-gutenberg-blocks
(cd dist && zip -rqX da-gutenberg-blocks.zip da-gutenberg-blocks)
echo "Built dist/da-gutenberg-blocks.zip"
