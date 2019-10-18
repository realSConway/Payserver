### OnionShare

[Resources] (https://github.com/micahflee/onionshare/wiki/Linux-Distribution-Support#opensuse-leap-150)

Add repos
- tor
```
sudo zypper addrepo --check --refresh --name "network" http://download.opensuse.org/repositories/network/openSUSE_Leap_15.0/network.repo

```

- obfs4
```
sudo zypper addrepo --check --refresh --name "obfs4" http://download.opensuse.org/repositories/home:/hayyan71/openSUSE_Leap_15.0/home:hayyan71.repo
```

Install the needed dependencies
```
zypper in python3-Flask python3-stem python3-asn1crypto python3-PySocks python3-qt5 python3-nautilus tor simple-obfs python3-pytest rpm-build
```

Install remaining with pip
```
sudo pip3 install stem pycryptodome flask_httpauth
```
