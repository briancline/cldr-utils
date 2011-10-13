#!/bin/bash

DATA_DIR="$PWD/data"

CORE_ZIP="core.zip"
POSIX_ZIP="posix.zip"
TOOLS_ZIP="tools.zip"

CLDR_LATEST="http://www.unicode.org/Public/cldr/latest"
CLDR_CORE="${CLDR_LATEST}/${CORE_ZIP}"
CLDR_POSIX="${CLDR_LATEST}/${POSIX_ZIP}"
CLDR_TOOLS="${CLDR_LATEST}/${TOOLS_ZIP}"

curl -L ${CLDR_CORE} > ${DATA_DIR}/${CORE_ZIP}
unzip ${DATA_DIR}/${CORE_ZIP} -d ${DATA_DIR}
