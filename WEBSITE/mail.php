*<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 13:16
 */
if(mail("dominique.michel98@yahoo.fr", "test", "this is an automated test"))
    echo "mail has been sent";
else
    echo "mail has not been sent";