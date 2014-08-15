# cms-kit 

Path: backend/wizards/filemanager

## Description

This Wizard adds a File-Manager to upload & manage Files in accessible Folders (defined via some Right-Management) and lets you select a File-Path as String.



# cms-kit Wizard Filemanager

Path: cms-kit/backend/wizards/filemanager

## Description

This Wizard adds a Filemanager to a Field

## Installation

### manual Installation

1. download and extract this Folder into backend/wizards/

### Installation via package management

* *Input-Type:* String with Wizard (VARCHAR) or call from other Wizards
* *Include-Code:* filemanager
* *Input:* nothing (just returns something)
* *Return:* File-Path
* *Credits:* [elFinder](http://elfinder.org) 3-clauses BSD license



## Installation

### manual Installation

1. download and extract this Folder into backend/wizards/

### Installation via package management




## Upgrade

To work smoothly you should run compressor/compress.php and inlude 2 files

1. create/purge a Folder called "min/"
2. comment the "exit" in compress.php
3. check the dependencies in the ...src.html
   1. copy css- + js-References to the XML-Section of compress.php + delete html-comments
   2. check the code for correct XML-Syntax (self-closing CSS-Links)
4. place actual "js/" and "css/" Folders in "filemanager/" (you can delete the src-files after successfull compression)
5. copy "js/i18n/" to "filemanager/"
5. run compressor/compress.php and check the files
6. test the App (if there are JS-Errors switch from compression to concatenation
7. uncomment the "exit" after use


License
-------

elFinder is issued under a 3-clauses BSD license.

<pre>
Copyright (c) 2009-2012, Studio 42
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of the Studio 42 Ltd. nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL "STUDIO 42" BE LIABLE FOR ANY DIRECT, INDIRECT,
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
</pre>
