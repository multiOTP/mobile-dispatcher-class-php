MobileDispatcher PHP class
==========================

MobileDispatcher PHP class is a GNU LGPL class to redirect a mobile device
to the dedicated App for this family of mobile devices.

Thanks to this dispatcher, you can now distribute a single QRcode with the
same URL inside to distribute an app for various mobile device families
(for example: http://go.6co.ch/?a=otpauth).

If the family of a device is not detected, the list of the Apps for all
families is displayed instead.


(c) 2014-2015 SysCo systemes de communication sa  
http://developer.sysco.ch/php/  

Current build: 2.0.0.1 (2015-08-06)


# Usage
    
    <?php

        require_once('mobile.dispatcher.class.php');
        $mobile_dispatcher = new MobileDispatcher();

        $mobile_dispatcher->addTopic(
            'otpauth',
            'TOTP/HOTP code generator'
        );

        $mobile_dispatcher->addFamilyApp(
            'otpauth',
            'Android',
            'market://details?id=com.google.android.apps.authenticator2',
            'Google Authenticator'
        );

        $mobile_dispatcher->dispatchApp('otpauth');

    ?>


  Check mobile.dispatcher.demo.php for a full implementation example.


You can support our open source projects with donations and sponsoring.
Sponsorships are crucial for ongoing and future development!
If you'd like to support our work, then consider making a donation, any support
is always welcome even if it's as low as $1!
You can also sponsor the development of a specific feature. Please contact
us in order to discuss the detail of the implementation.

[![Donate via PayPal](https://img.shields.io/badge/donate-paypal-87ceeb.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&currency_code=USD&business=paypal@sysco.ch&item_name=Donation%20for%20mobile-dispatcher%20project)
*Please consider supporting this project by making a donation via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&currency_code=USD&business=paypal@sysco.ch&item_name=Donation%20for%20mobile-dispatcher%20project)*  

And for more PHP classes, have a look on [PHPclasses.org](http://syscoal.users.phpclasses.org/browse/), where a lot of authors are sharing their classes for free.
