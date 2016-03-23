.. include:: Images.txt

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


Introduction
------------

What does it do?
^^^^^^^^^^^^^^^^

This extension simulates Backend Login for FE Users. It works by
associating a BE User with a FE User. When the FE User logs in to the
frontend, a fake BE Session is created for the associated BE User. The
BE Session is automatically deleted when the FE User logs out.

Screenshots
^^^^^^^^^^^

|img-1|

