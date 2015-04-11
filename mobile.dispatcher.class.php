<?php
/**
 * @file  mobile.dispatcher.class.php
 * @brief Redirect a mobile device to the dedicated App for a specific usage
 *
 * @mainpage
 *
 * MobileDispatcher PHP class is a GNU LGPL class to redirect a mobile device
 * to the dedicated App for this family of mobile devices.
 *
 * Thanks to this dispatcher, you can now distribute a single QRcode with the
 * same URL inside to distribute an App for various mobile device families
 * (for example: http://go.6co.ch/?a=otpauth).
 *
 * If the family of a device is not detected, the list of the Apps for all
 * families is displayed instead.
 *
 *
 * PHP 5.3.0 or higher is supported.
 *
 * @author    Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
 * @version   2.0.0.0
 * @date      2015-01-23
 * @since     2014-03-03
 * @copyright (c) 2014-2015 SysCo systemes de communication sa
 * @license   GNU Lesser General Public License
 * @link      http://www.multiotp.net/
 *
 *//*
 *
 * LICENCE
 *
 *   Copyright (c) 2014-2015 SysCo systemes de communication sa
 *   SysCo (tm) is a trademark of SysCo systemes de communication sa
 *   (http://www.sysco.ch/)
 *   All rights reserved.
 * 
 *   MobileDispatcher PHP class is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU Lesser General Public License as
 *   published by the Free Software Foundation, either version 3 of the License,
 *   or (at your option) any later version.
 * 
 *   MobileDispatcher PHP class is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU Lesser General Public License for more details.
 * 
 *   You should have received a copy of the GNU Lesser General Public
 *   License along with MobileDispatcher PHP class.
 *   If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * Usage
 *
 *   Check mobile.dispatcher.demo.php for a full implementation example.
 *
 *
 * Change Log
 *
 *   2015-01-23 2.0.0.0 SysCo/al Class enhanced and cleaned
 *   2014-03-03 1.0.0.0 SysCo/al Initial release
 *********************************************************************/


class MobileDispatcher
/**
 * @class     MobileDispatcher
 * @brief     Class definition for MobileDispatcher handling.
 *
 * @author    Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
 * @version   2.0.0.0
 * @date      2015-01-23
 * @since     2014-03-03
 */
{
    var $_dispatcher_array = array();


    function detectMobileFamily(
        $agent = ''
    )
    /**
     * @brief   Detect the mobile device family
     *          (User agent based on http://www.useragentstring.com/pages/Mobile%20Browserlist/)
     *
     * @param   string $agent  User agent (will be extracted automatically if empty)
     * @retval  string         Detected mobile family
     *                         (Android, iOS, WindowsPhone, BlackBerry, PalmOS, Other)
     *
     * @author  Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
     * @version 2.0.0.0
     * @date    2015-01-23
     * @since   2014-03-03
     */
    {
        $family = 'Other';
        
        $user_agent = (trim($agent) != '')?trim($agent):(isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'');
        
        if ((FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'Android'))) {
            $family = 'Android';
        }
        elseif ((FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'iPhone')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'iPad')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'iPod'))) {
            $family = 'iOS';
        }
        elseif ((FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'Windows Phone')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'Windows Mobile')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'IEMobile'))) {
            $family = 'WindowsPhone';
        }
        elseif ((FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'BlackBerry')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'BB10')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'RIM Tablet')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'PlayBook'))) {
            $family = 'BlackBerry';
        }
        elseif ((FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'PalmSource')) ||
                (FALSE !== stristr($_SERVER['HTTP_USER_AGENT'],'PalmOS'))) {
            $family = 'PalmOS';
        }
        return $family;
    }
    
    function addTopic(
        $topic_alias,
        $topic_description
    )
    /**
     * @brief   Add a new topic with the corresponding description
     *
     * @param   string $topic_alias        Topic alias (like (like otpauth)
     * @param   string $topic_description  Topic description (like TOTP/HOTP code generator)
     * @retval  void
     *
     * @author  Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
     * @version 2.0.0.0
     * @date    2015-01-23
     * @since   2014-03-03
     */
    {
        $this->_dispatcher_array[$topic_alias] = array('Info' => array('txt' => $topic_description));
    }

    
    function addFamilyApp(
        $topic_alias,
        $family,
        $app_url,
        $app_description
    )
    /**
     * @brief   Add a new App corresponding to a family of devices for a specific topic
     *
     * @param   string $topic_alias      Topic alias (like otpauth)
     * @param   string $family           Family of devices (like Android)
     * @param   string $app_url          (Store) URL of the corresponding application
     * @param   string $app_description  Corresponding application description
     * @retval  void
     *
     * @author  Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
     * @version 2.0.0.0
     * @date    2015-01-23
     * @since   2014-03-03
     */
    {
        $this->_dispatcher_array[$topic_alias][$family] = array('url' => $app_url,
                                                                'txt' => $app_description
                                                               );
    }

    
    function topicsArray(
    )
    /**
     * @brief   return the list of all topics in an array
     *
     * @retval  array  an associative array topic => description
     *
     * @author  Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
     * @version 2.0.0.0
     * @date    2015-01-23
     * @since   2014-03-03
     */
    {
        $result_array = array();
        foreach ($this->_dispatcher_array as $one_topic => $one_array) {
            $result_array[$one_topic] = $one_array['Info']['txt'];
        }
        return $result_array;
    }


    function dispatchApp(
        $topic_alias,
        $forced_family = '',
        $mobile_agent = ''
    )
    /**
     * @brief   Call the URL dispatcher for a specific family
     *
     * @param   string $topic_alias    Topic alias (like otpauth)
     * @param   string $forced_family  Forced family of devices (optional)
     * @param   string $mobile_agent   Mobile agent (optional)
     * @retval  void
     *
     * @author  Andre Liechti, SysCo systemes de communication sa, <info@multiotp.net>
     * @version 2.0.0.0
     * @date    2015-01-23
     * @since   2014-03-03
     */
    {
        $family = ('' != trim($forced_family))?trim($forced_family):$this->detectMobileFamily($mobile_agent);

        // WE REALLY DO NOT WANT TO BE CACHED !
        header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
            
        $txt = isset($this->_dispatcher_array[$topic_alias][$family]['txt'])?$this->_dispatcher_array[$topic_alias][$family]['txt']:isset($this->_dispatcher_array[$topic_alias]['Info']['txt'])?$this->_dispatcher_array[$topic_alias]['Info']['txt']:'App URL dispatcher';

        $url = isset($this->_dispatcher_array[$topic_alias][$family]['url'])?$this->_dispatcher_array[$topic_alias][$family]['url']:'';
      
        if ('' != $url) {
            header('Location: '.$url);
        } else {
            $title = $txt;
            $output = "";
            $count_app = 0;
            if (isset($this->_dispatcher_array[$topic_alias])) {
                foreach ($this->_dispatcher_array[$topic_alias] as $device => $one_app) {
                    $url = (isset($one_app['url'])?$one_app['url']:'');
                    $txt = (isset($one_app['txt'])?$one_app['txt']:'');
                    if (('Info' != $device) && ('' != $url)) {
                        $count_app++;
                        if ('' == $txt) {
                            $txt = $title;
                        }
                        $output.= "<li>$device: <a href=\"$url\">$txt</a></li>\n";
                    }
                }
            }
            if (0 < $count_app) {
                $output="<ul>\n".$output."</ul>\n";
            } else {
                $output.= "No match for this app ($topic_alias)";
            }
            $output = "<html>\n<title>$title</title>\n<body><h1>$title</h1>".$output;
            $output.= "</body>\n</html>";
            echo $output;
        }
    }
}
