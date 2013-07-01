DELETE -R ./copy/version
MOVE  ./copy/version "./copy/version2"
IS_WRITABLE  "./copy/version/*"
COPY -R ./copy/version ~/
DELETE -R ./copy/version
MOVE -OR ./copy/version "./copy/version2"
IS_WRITABLE  "./copy/version/*"
COPY  ./copy/version ~/
DELETE -R ./copy/version
MOVE -O ./copy/version "./copy/version2"
IS_WRITABLE  -R "./copy/version/*"

