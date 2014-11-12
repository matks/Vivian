#!/bin/bash

yellow_bold='\033[33m\033[1m'
reset='\033[0m'

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

for file in $DIR/test-*.php
do
    echo -e "${yellow_bold}$file${reset}${reset}"
    if [[ -f $file ]]; then
        php $file
    fi
    echo ""
done