# Payserver

Installation and configuring of Electrum-Merhcant with NGINX, using simple PHP/HTML payment page on OpenSUSE Raspberry Pi.


## How to

### Installation and Configuration as root

#### Install base software

- Install required software with package manager [zypper](https://en.opensuse.org/Portal:Zypper)

```bash
zypper in wget python3-setuptools python3-pip nginx php7 php7-curl php7-fpm
```

- Install modules Electrum-Merchant and Requests

```bash
pip3 install electrum-merchant requests
```

- Then create user **web** most services will run under this user.


#### Configure Firewall and NGINX

- Configure firewall to allow service http and port 7777
```bash
firewall-cmd --add-service=http --permanent --zone=public && firewall-cmd --add-port=7777/tcp --permanent --zone=public && firewall-cmd --reload
```

- Configure `/etc/nginx/nginx.conf` for payment requests and QR codes, add within server {}

```
location / {
	root   /srv/www/Payserver/;
	index  index.html index.htm;
						        
}

location /payment/ {
	default_type "application/bitcoin-paymentrequest";
	alias /srv/www/payment/;
}

location ~ \.php$ {
	root /srv/www/;
	include fastcgi_params;
	include fastcgi.conf;
	fastcgi_pass 127.0.0.1:9000;
	fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
																				        
}

location = /favicon.ico {
	log_not_found off;
}
```

### Installation and Configuration as web

Change to user web, `su - web` create electrum directory and download [Electrum Wallet](https://electrum.org/#download).

```
mkdir electrum && cd ./electrum
```
- Download Electrum and gpg keys
```
wget https://download.electrum.org/3.3.8/Electrum-3.3.8.tar.gz \
https://download.electrum.org/3.3.8/Electrum-3.3.8.tar.gz.asc \
https://raw.githubusercontent.com/spesmilo/electrum/master/pubkeys/ThomasV.asc
```
- Import Thomasv.asc gpg key and verify \*tar.gz 
```
gpg --import ThomasV.asc && gpg --verify Electrum*.tar.gz.asc Electrum*.tar.gz
```
- Result should return: 
> gpg: Good signature from "Thomas Voegtlin (https://electrum.org) <thomasv@electrum.org>" [unknown]

- Install Electrum with python3
`python3 -m pip install --user Electrum*.tar.gz`

- If message regarding PATH, add `/home/web/.local/bin` to *~/.profile*. 
```
echo 'export PATH="$PATH:/home/web/.local/bin/"' >> ~/.profile && source ~/.profile
```

##### Electrum wallet creation on airlocked computer

- Create segwit wallet on airlocked pc (with Tails OS for example)
```
electrum create --segwit --encrypt_file=true -W "Password"<Paste>
```
- Export zpub key
```electrum getmpk -w ./path/to/wallet/default_wallet
```
### Configuring electrum-merchant

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[NA]()
