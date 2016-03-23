

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


The configuration is not included in my headerData at all!?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You are very likely using another name than "page" for your PAGE
object. So page.headerData.9586 is not referenced.

Just copy page.headerData.9586 to the headerData of your PAGE object.

**Example:**

::

   seite = PAGE
   seite.headerData.9586 < page.headerData.9586

