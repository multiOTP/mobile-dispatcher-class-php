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

Current build: 2.0.0.0 (2015-01-23)


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
