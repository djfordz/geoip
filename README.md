Test for Trellis.

Two ways to install, either install code manually in 

`app/code/Dford/Geoip`

or use composer.

Manual install:

```
mkdir app/code/Dford/Geoip
cd app/code/Dford/Geoip
git clone https://github.com/djfordz/geoip.git .

# all modes
bin/magneto module:enable Dford_Geoip
bin/magneto setup:upgrade

# if in production mode
bin/magento setup:di:compile
bin/magento setup:static-content:deploy

# all modes
bin/magento cache:flush
```

Install with composer

add following to your root composer.json

```
# ensure module is listed under require
"require": {
        "dford/geoip": "*"
}

# change minimum stability to dev
"minimum-stability": "dev"

# add repository url
"repositories": [
        {
            "type": "composer",
            "url": "https://repo.magento.com/"
        },
        {
            "type": "vcs",
            "url": "https://github.com/djfordz/geoip"
        }
    ]

# once added to composer.json in magento root run below:

composer update

# all modes
bin/magneto module:enable Dford_Geoip
bin/magneto setup:upgrade

# if in production mode
bin/magento setup:di:compile
bin/magento setup:static-content:deploy

# all modes
bin/magento cache:flush
```

<img src="https://github.com/djfordz/geoip/blob/master/preview.png" />
<img src="https://github.com/djfordz/geoip/blob/master/preview2.png" />
