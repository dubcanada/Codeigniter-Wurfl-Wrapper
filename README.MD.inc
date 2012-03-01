Codeigniter WURFL API Wrapper
=============================

Original wrapper by simonmaddox, this was upgraded to the newest API. I also am fairly bad at OOP in PHP so if someone wants to refactor it, PLEASE DO!

https://github.com/simonmaddox/codeigniter-wurfl

Instructions
------------
Needs the WURFL API from:
http://wurfl.sourceforge.net/nphp/

Put the WURFL directory into your system directory.

Move examples/resources to the WURFL directory in the system directory. So it looks like

/system/WURFL/resources/*

Then go get the latest WURFL file from http://wurfl.sourceforge.net/wurfl_download.php and put it in 

Set the config values in WURFL if you want to change anything (in my system I choose to support In Memory Config vs XML.)

You will also need to define where wurfl.xml and
web_browsers_patch.xml are located.

You can use the following code:

<?php
$this->load->library('wurfl');
$this->wurfl->load('USER_AGENT_HERE');
?>

You can also pass the $_SERVER variable to $this->wurfl->load()

To get capabilities, you should do the following:
$this->wurfl->getCapability('max_data_rate');
OR
$this->wurfl->getAllCapabilities();

There are other methods available, which should be 
fairly self explanatory.