#!/bin/bash

rm *.php src/*.php app/src/*.php

cd ump
rm *.php src/*.php

java -jar ./umple.jar mainPHP.ump

cat traits.ump  classes.ump  attributes.ump  asociations.ump  methods.php.ump business-logic.ump > php.ump


mkdir ../src
mv *.php ../src/
cd ../
rmdir app/src
mv src app/

