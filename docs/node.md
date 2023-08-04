[Back](../INSTALL.md)

## Install Node

Installing Node.js with Apt Using a NodeSource PPA
https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-18-04

After I restored this project from my archive, Node was version 9.x. After updating node dependencies I managed to run only with version 12.

For this time, Node 12 worked. I don't want update it to a recent version, because recent versions could have more dependencies than version 12. I prefer to update Laravel versions first where possible. So, let's follow instructions for Node 12.x installation.

```bash
npm cache clean --force

sudo apt remove nodejs 

cd ~/Downloads

curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh

sudo bash nodesource_setup.sh

sudo apt-get install -y nodejs

node -v

# v12.22.12
```