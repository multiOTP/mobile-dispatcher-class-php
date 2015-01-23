<?php
/**
 * @file  mobile.dispatcher.demo.php
 * @brief MobileDispatcher LGPLv3 PHP class demo implementation
 *
 *
 * Change Log
 *
 *   2015-01-23 2.0.0.0 SysCo/al Class enhanced and cleaned
 *   2014-03-03 1.0.0.0 SysCo/al Initial release
 *********************************************************************/

    require_once('mobile.dispatcher.class.php');

    $mobile_dispatcher = new MobileDispatcher();

    $mobile_dispatcher->addTopic(
        'otpauth',
        'TOTP/HOTP code generator'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'Android (web)',
        'https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2',
        'Google Authenticator'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'Android',
        'market://details?id=com.google.android.apps.authenticator2',
        'Google Authenticator'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'iOS',
        'https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8',
        'Google Authenticator'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'WindowsPhone',
        'http://www.windowsphone.com/en-us/store/app/authenticator/e7994dbc-2336-4950-91ba-ca22d653759b',
        'Authenticator'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'BlackBerry',
        'http://appworld.blackberry.com/webstore/content/29401059/',
        '2 Steps Authenticator'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'Java',
        'http://lwuitgauthj2me.googlecode.com/files/GoogleAuthenticatorJ2ME_1.2.0.jar',
        'GoogleAuthenticatorJ2ME'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'PalmOS',
        'http://gauthj2me.googlecode.com/files/gauth.prc',
        'Google Authenticator for Palm OS'
    );

    $mobile_dispatcher->addFamilyApp(
        'otpauth',
        'Web',
        'http://blog.tinisles.com/2011/10/google-authenticator-one-time-password-algorithm-in-javascript/',
        'Google Authenticator One-time Password Algorithm in Javascript'
    );

    $mobile_dispatcher->addTopic(
        'motp',
        'Mobile-OTP code generator'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'Android (web)',
        'https://play.google.com/store/apps/details?id=net.marinits.android.droidotp',
        'DroidOTP'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'Android',
        'market://details?id=net.marinits.android.droidotp',
        'DroidOTP'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'iOS',
        'https://itunes.apple.com/us/app/mobile-otp/id328973960&mt=8',
        'iOTP'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'WindowsPhone',
        'http://www.windowsphone.com/en-us/store/app/motp7/38ae10a5-2686-e011-986b-78e7d1fa76f8',
        'motp7'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'BlackBerry',
        'http://motp.sourceforge.net/MobileOTP.jar',
        'Mobile-OTP Token (Java)'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'Java',
        'http://motp.sourceforge.net/MobileOTP.jar',
        'Mobile-OTP Token (Java)'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'PalmOS',
        'http://motp.sourceforge.net/MobileOTP-1.1.zip',
        'Mobile-OTP token client for PalmOS'
    );

    $mobile_dispatcher->addFamilyApp(
        'motp',
        'Web',
        'http://motp.sourceforge.net/',
        'Mobile-OTP website'
    );


    $topic = isset($_GET['a'])?$_GET['a']:'';
    if ('' != $topic) {
        $mobile_dispatcher->dispatchApp($topic);
    } else {
        echo "<h1>Available application dispatchers</h1>";
        echo "<ul>";
        foreach ($mobile_dispatcher->topicsArray() as $one_topic => $one_description) {
            echo "<li><a href=\"?a=$one_topic\">$one_description</a></li>";
        }
        echo "</ul>";
    }
