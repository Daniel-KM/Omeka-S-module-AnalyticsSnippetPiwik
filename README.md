Analytics Snippet Piwik / Matomo (module for Omeka S)
=====================================================

> __New versions of this module and support for Omeka S version 3.0 and above
> are available on [GitLab], which seems to respect users and privacy better
> than the previous repository.__

[Analytics Snippet Piwik] / Matomo is a sub-module of [Analytics Snippet] for [Omeka S]
that allows to track the not only the public and/or admin pages, but json (in
particular for the Omeka S Api) and XML.

Note: XML from the module [OAI-PMH Repository] is not supported yet.


Installation
------------

Install [Analytics Snippet] first.

Then, uncompress files and rename module folder `AnalyticsSnippetPiwik`. Then
install it like any other Omeka module and follow the config instructions.

See general end user documentation for [Installing a module].


Warning
-------

Use it at your own risk.

It’s always recommended to backup your files and your databases and to check
your archives regularly so you can roll back if needed.


Troubleshooting
---------------

See online issues on the [module issues] page on GitLab.


License
-------

This module is published under the [CeCILL v2.1] license, compatible with
[GNU/GPL] and approved by [FSF] and [OSI].

This software is governed by the CeCILL license under French law and abiding by
the rules of distribution of free software. You can use, modify and/ or
redistribute the software under the terms of the CeCILL license as circulated by
CEA, CNRS and INRIA at the following URL "http://www.cecill.info".

As a counterpart to the access to the source code and rights to copy, modify and
redistribute granted by the license, users are provided only with a limited
warranty and the software’s author, the holder of the economic rights, and the
successive licensors have only limited liability.

In this respect, the user’s attention is drawn to the risks associated with
loading, using, modifying and/or developing or reproducing the software by the
user in light of its specific status of free software, that may mean that it is
complicated to manipulate, and that also therefore means that it is reserved for
developers and experienced professionals having in-depth computer knowledge.
Users are therefore encouraged to load and test the software’s suitability as
regards their requirements in conditions enabling the security of their systems
and/or data to be ensured and, more generally, to use and operate it in the same
conditions as regards security.

The fact that you are presently reading this means that you have had knowledge
of the CeCILL license and that you accept its terms.

### Libraries

The module uses the library [matomo-php-tracker], released under the [BSD]
license.


Copyright
---------

* Copyright Daniel Berthereau, 2017-2021 (see [Daniel-KM] on GitLab)


[Analytics Snippet Piwik]: https://gitlab.com/Daniel-KM/Omeka-S-module-AnalyticsSnippetPiwik
[Analytics Snippet]: https://gitlab.com/Daniel-KM/Omeka-S-module-AnalyticsSnippet
[OAI-PMH Repository]: https://github.com/biblibre/omeka-s-module-OaiPmhRepository
[Omeka S]: https://omeka.org/s
[Installing a module]: http://dev.omeka.org/docs/s/user-manual/modules/#installing-modules
[module issues]: https://gitlab.com/Daniel-KM/Omeka-S-module-AnalyticsSnippetPiwik/-/issues
[CeCILL v2.1]: https://www.cecill.info/licences/Licence_CeCILL_V2.1-en.html
[GNU/GPL]: https://www.gnu.org/licenses/gpl-3.0.html
[FSF]: https://www.fsf.org
[OSI]: http://opensource.org
[matomo-php-tracker]: https://github.com/matomo-org/matomo-php-tracker
[BSD]: http://www.opensource.org/licenses/bsd-license.php
[GitLab]: https://gitlab.com/Daniel-KM
[Daniel-KM]: https://gitlab.com/Daniel-KM "Daniel Berthereau"
