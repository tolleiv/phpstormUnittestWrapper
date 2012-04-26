Wrapper for the "PHPUnit on Server" runner from PHPStorm for the TYPO3 cli_dispatched PHPUnit.

Setup
=====

* Clone this repository into your document root (e.g. under /var/www/<host>/htdocs/tests )
* Add this line to your .htaccess: ``RewriteRule ^(.+)/_intellij_phpunit_launcher\.php$ /tests/_ij.php``
* Configure your deployment mappings properly - including the WebPath, even if it doesn't make sense to run single extensions from their subfolders.
* Update the default settings for the "PHPUnit on Server" runner and select the correct server for it.

Running the tests
=================

* Use the context menu for Unittest folders or files to trigger the tests on the server.
* See them running

Requirements
============

* Make sure you're using the most recent version of PHPUnit
* Make sure your mod_rewrite setup is working properly

Known issues
============

* Location hints don't seem to work
* Running single test methods is not supported by the phpunit command line interface

License
=======

Copyright (C) 2012 Tolleiv Nietsch <info@tolleiv.de>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
