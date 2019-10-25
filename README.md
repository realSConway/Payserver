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


#### Enabling php
- Make backup of config file
```
cp /etc/php7/fpm/php-fpm.conf.default /etc/php7/fpm/php-fpm.conf
```

- Edit Config and add below to file in order to write log to location: `/var/log/php-fpm.log` 
```
error_log = /var/log/php-fpm.log
```

- Make a copy of `/php.ini`
```
cp /etc/php7/cli/php.ini /etc/php7/fpm/
```

- Edit `/php.ini`, uncomment or add following:
```
cgi.fix_pathinfo=0
```

- Then copy `php.ini` over to `conf.d/`
```
cp /etc/php7/fpm/php.ini /etc/php7/conf.d/
```

- Make a copy of `/www.conf.default`
```
cp /etc/php7/fpm/php-fpm.d/www.conf.default /etc/php7/fpm/php-fpm.d/www.conf
```

- Finally restart nginx service and enable/start php-fpm service
```
systemctl restart nginx && systemctl enable php-fpm && systemctl start php-fpm  
```


### Installation and Configuration as web

- Change to user web, `su - web`

#### Download verify Electrum.

- create electrum directory and download [Electrum Wallet](https://electrum.org/#download).

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

### Configuring Electrum

- Set Electrum configs and restore zpub public key:
```
electrum setconfig requests_dir /srv/www/payment/ \
electrum setconfig url_rewrite "[ 'file:///srv/www/', '//localhost/' ]" \
electrum setconfig rpcuser USERNAME \
electrum setconfig rpcpassword PASSWORD \
electrum setconfig rpcport 7777\

# restore public key
electrum restore zpub
```

#### Install Electrum-Merhcant
```
python3 -m electrum-merchant
```

### Electrum commands
- Finally start Electrum, I connect to my own node with:
```
electrum daemon start --oneserver --server pi3-3:50002:s
```

- Test connection:
```
curl --data-binary '{"id":"curltext","method":"addrequest","params":{"amount":"3.14","memo":"test"}}' http://USERNAME:PASSWORD@127.0.0.1:7777

```

- Stopping electrum daemon
```
electrum daemon stop
```

- Load wallet
```
electrum daemon load_wallet
```
---

## ToDo's
- [ ] SSL cert
- [ ] OnionShare
- [ ] Make page more dynamic
- [ ] Update electrum service to work for user web.

---

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[NA]()
