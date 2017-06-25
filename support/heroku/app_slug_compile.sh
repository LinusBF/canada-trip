#!/bin/bash

# Check if we have DYNO_RAM... only "herokuish" should have it.
if [ -z "$DYNO_RAM" ]; then
    echo "[Heroku] Running app_slug_compile.sh"
    npm rebuild node-sass
    yarn run production
fi