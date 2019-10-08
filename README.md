# Payserver

This is a guide to installing and configuring Electrum-Personal-server with NGINX, using simple PHP/HTML payment page on OpenSUSE Raspberry Pi.

Create user **web** which will be the main user within this project.

## Installation base software as root

Install required software with package manager [zypper](https://en.opensuse.org/Portal:Zypper) to install wget python3-setuptools python3-pip nginx php7 php7-curl php7-fpm

```bash
zypper in wget python3-setuptools python3-pip nginx php7 php7-curl php7-fpm
```

## Install Electrum-Personal-Server and Requests

```bash
pip3 install electrum-merchant requests
```

## Firewall

Configure firewall to allow service http and port 7777
```bash
firewall-cmd --add-service=http --permanent --zone=public && firewall-cmd --add-port=7777/tcp --permanent --zone=public && firewall-cmd --reload
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
