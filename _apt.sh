
#php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
#php composer-setup.php
#php -r "unlink('composer-setup.php');"


#sudo mv composer.phar /usr/local/bin/composer


#composer require kornrunner/keccak

#sudo add-apt-repository ppa:ethereum/ethereum
#sudo apt-get update
#sudo apt-get install solc

#npm i generate-license
#npm install --global generate generate-license


#apt-get install php8.1
#composer require web3p/web3.php dev-master
#composer require web3-php/web3 dev-master

composer require kornrunner/ethereum-offline-raw-tx

#composer require digitaldonkey/ethereum-php