

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


Configuration
-------------

Reference
^^^^^^^^^

You can use the following option in the Setup field of your TypoScript
Template.

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         allow
   
   Data type
         boolean
   
   Description
         Turns backend simulation on and off.
         
         **Example** :
         
         ::
         
              # Activate simulatebe
            plugin.tx_simulatebe_pi1 {
                allow = 1
            }
   
   Default
         1


.. ###### END~OF~TABLE ######

[TS Template Setup: plugin.tx\_simulatebe\_pi1]

