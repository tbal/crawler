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


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   WhatDoesItDo/Index
   WhatsNew/Index
   Screenshots/Index

What to document!
^^^^^^^^^^^^^^^^^

* How to setup the scheduler Tasks
* Update the Screenshots, and consider what actually to show with that section. I would consider moving it and adding the screenshots needed to the documentation where needed.
* Decide whether What's new will be remove or changed to change-log.
* Extend the HTTP Authentication section, it's a little thin right now. Perhaps it cannot be extended much, but we should consider something
* Executing the queue: Should be extended as well, not much information to gain here.
* Features: We should consider what we want to present here, if anything. I would tend to skip this section.
* FAQ: Extend or skip
* The AOE way: Update to reflect the current situation with Travis, Scrutinizer etc.
* Target for cross referencing, why is that even in the documentation.