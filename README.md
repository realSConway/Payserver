# Payserver

This is a guide to installing and configuring Electrum-Merhcant with NGINX, using simple PHP/HTML payment page on OpenSUSE Raspberry Pi.

Create user **web** which will be the main user within this project.

## Installation and Configuration as root

### Install bas software

Install required software with package manager [zypper](https://en.opensuse.org/Portal:Zypper)

```bash
zypper in wget python3-setuptools python3-pip nginx php7 php7-curl php7-fpm
```

### Install modules Electrum-Merchant and Requests

```bash
pip3 install electrum-merchant requests
```

### Configure Firewall

Configure firewall to allow service http and port 7777
```bash
firewall-cmd --add-service=http --permanent --zone=public && firewall-cmd --add-port=7777/tcp --permanent --zone=public && firewall-cmd --reload
```

### Configure nginx.config

```bash
vim /etc/nginx/nginx.conf

```
And add following within server tag, then reload nginx:
```
location /payment/ {
	default_type "application/bitcoin-paymentrequest";
	alias /srv/www/payment/;
}
```

## Installation and Configuration as web

Change user to web, `su - web`

### Download/install Electrum

Create electrum installer directories. 
```
mkdir electrum && cd ./electrum
```
Download [Electrum Wallet](https://electrum.org/#download).

```
wget https://download.electrum.org/3.3.8/Electrum-3.3.8.tar.gz \
https://download.electrum.org/3.3.8/Electrum-3.3.8.tar.gz.asc \
https://raw.githubusercontent.com/spesmilo/electrum/master/pubkeys/ThomasV.asc

```
Import Thomasv.asc gpg key and verify 
```
gpg --import ThomasV.asc && gpg --verify Electrum*.tar.gz.asc Electrum*.tar.gz
```

Result should return: 
> gpg: Good signature from "Thomas Voegtlin (https://electrum.org) <thomasv@electrum.org>" [unknown]

Then we can install Electrum Wallet with python3
`python3 -m pip install --user Electrum*.tar.gz`

You may get a message RE PATH, in this case you need to add `/home/web/.local/bin` to *~/.profile*. 
```
echo 'export PATH="$PATH:/home/web/.local/bin/"' >> ~/.profile
```
After adding path, you will need to activate path with by running `source ~/.profile`


### If required, create Electrum wallet

Create segwit wallet on airlocked pc (with Tails OS for example)

`electrum create --segwit --encrypt_file=true -W "Password"<Paste>`
Then export zpub key.
`electrum getmpk -w ./path/to/wallet/default_wallet`

### Configuring electrum-merchant

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[NA]()
