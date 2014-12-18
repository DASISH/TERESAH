---
author:
- Akira Olsbänning
date: '2014-12-08'
title: Manual for TERESAH
...

Introduction to TERESAH
=======================

Welcome to TERESAH. TERESAH (standing for *Tools E-Registry for E-Social science, Arts and Humanities*) is a web based application for the collection and organisation of data research tools. It was created using funds from the Seventh Framework Programme.

![The TERESAH front page](./images/front_page_scroll_1.png)
*The TERESAH front page*

The license of this document
----------------------------

This manual (like the contents of TERESAH itself) is licensed under the [Creative Commons CC-BY-SA 4.0 license.](http://creativecommons.org/licenses/by-sa/4.0/)

Signing up and logging in
=========================

Creating an account for TERESAH
-------------------------------

Before starting to use TERESAH, you need an account. It is also possible to log in using so-called federated login providers such as linked-in, but for now, lets create a dedicated account.

On the front page, click on "sign in" in the upper right corner. 

![The top bar (no user currently logged in)](./images/top_bar_logged_out.png)
*The top bar (no user currently logged in)*

Next you will be taken to the login page. Since we are assuming that you don't have an account yet, click on "Sign up" below the "Password" field.

![The sign in form. The link to sign up for a new account is highlighted.](./images/sign_in_no_text.png)
*The sign in form. The link to sign up for a new account is highlighted.*

![The sign up form for creating a new user account](./images/sign_up.png)
*The sign up form for creating a new user account*

Now we need some basic information about you: 

- 1) Your name
- 2) Your prefered locale (currently English and Swedish are available)
- 3) A mail adress 
- 4) The password you want to use. Repeat the password. 

Once you have filled out the fields correctly, click on "Sign Up".

![The mail sent to new users.](./images/welcome_mail.png)
*The mail sent to new users.*

Once your application has been processed, you will get a confirmation mail to the address you used in the previous step.

Viewing tools
=============

Finding and looking at a tool
-----------------------------

Lets look around the tools already in the TERESAH listings

![The TERESAH front page search box](./images/front_page_search_box.png)
*The TERESAH front page search box*

![The top bar tool browsing menu.](./images/browse_tools_menu.png)
*The top bar tool browsing menu.*

- 1) Search for a tool by its name
- 2) Browse the complete TERESAH listings in alphabetical order
- 3) Browse through the different facet listings
- 4) See a listing of the most popular tools

![The search page](./images/search_page.png)
*The search page*

- 1) The number of tools on the current page and the total amount of tools matching your currently selected search filters (3)
- 2) General search box.
- 3) Facet search filters. By selecting one or more of these facets, only tools matching those specific facets are shown
- 4) Alphabetical listing of all tools matching your selected search filters from (3)
- 5) Page switcher, showing how many full pages are needed to show the listings in (4).

![Browsing the alphabetical listing of all tools](./images/browse_all_tools_page.png)
*Browsing the alphabetical listing of all tools*

- 1) The number of tools, on the current page and the total amount of tools matching your currently selected letter.
- 2) Alphabetical selection. Click on a letter to show only tools beginning with that initial.
- 3) Tools listing
- 4) Page selector

![Browsing tools by Facet](./images/browse_tools_by_facet_page.png)
*Browsing tools by Facet*

Here you can browse tools by their facet.

- 1) Developer - who created the tool?
- 2) Keyword - the free-form keywords associated with the tool
- 3) License - under what license is the tool released? (eg. Creative Commons, GPL, Properitary...)
- 4) Platform - what system does the tool require to run? (eg. Windows, Linux, the web...)
- 5) Standards - which technical standards does the tool support? (eg. XML, JSON, HTTP...)
- 6) Tool type - just what kind of tool is this? (eg. text, graphics, audio...)

![Viewing a specific tool](./images/viewing_a_tool.png)
*Viewing a specific tool*

- ​1) The name of the tool. As you can see, each tool has one or more initials inside the cicle to the left. Tools with a name made up from more than one word has more letters in the circle.
- 2) Data sources. In this screenshot, TERESAH's own source is selected. You can also get data from dirtdirectory.org, and more sources may be added in the future.
- 3) Data about this tool, from the source choosen above.
- 4) Information about the currently selected data source.
- ​5) Data export. Here you can get the data for the tool in the format of your choice.
- 6) Similar tools. Tools similar to the current one that you also might find interesting/relevant.

Exporting tool RDF info
-----------------------

When viewing a tool in TERESAH, you can export information about it in RDF format. Depending of what you want to use the RDF for, you can export it in different languages.

- RDF/JSONLD - A JSON dialect for exchange of links
- RDF/TURTLE - Terse RDF Triple Language
- RDF/XML - Plain XML (using the RDF namespace)

Just click on the format you want, and your browser should either show it in a separate page or let you download and save it in a file.

Adding or removing tools
========================

Entering and leaving admin mode
-------------------------------

In order to actually add or remove a tool, you need to enter "Admin Mode". To do this, you need to have a user type of *Collaborator*, *Supervisor* or *Administrator*. See the [reference section on user types](#types of users) for more info. 

First, go to the administrative section of TERESAH. Choose "Manage TERESAH" from the user menu.

![Going to the administrative section of TERESAH from the user menu](./images/going_to_admin_mode.png)
*Going to the administrative section of TERESAH from the user menu*

![The TERESAH administrative section tool listing](./images/administrative_section_tool_listing.png)
*The TERESAH administrative section tool listing*

As the banner across the top of the page now says, *please do be careful*. Use your administrative powers responsibly.

In order to leave admin mode and go back to just browsing TERESAH, click on "Browse TERESAH" in the user menu. You will be back in non-admin broser mode, and the banner across the top of the screen will go away.

![Going back to browsing mode](./images/leaving_admin_mode.png)
*Going back to browsing mode in the user menu*

Adding a new tool
-----------------

So far we have only looked at tools put into TERESAH by other people, or taken from external data sources. Now we will create one ourselves.

First, go to the administrative section as described above.

![The TERESAH administrative section tool listing](./images/administrative_section_tool_listing.png)
*The TERESAH administrative section tool listing*

Click on "Add new tool"

![The button "Add new tool"](./images/add_a_tool_button.png)
*The button "Add new tool"*

You will see the "Add new tool" dialog.

![The dialog "Add new tool"](./images/add_a_tool_dialog.png)
*The dialog for adding a new tool*

Fill out the name of the tool and click on "add tool"

!["Tool successfully added" message](./images/tool_successfully_added_message.png)
*The message informing you of a new tool beeing successfully added*

You will be returned to the admin section tool listing, and shown a message bar informing you that the new tool has been added. Note that this only creates an "empty" tool - there in no information in it, and no data sources connected to it. That will be added in the next step.

Adding information to a new tool
--------------------------------

First you need to find the the tool in the admin section listings. Here we will use "WordVenture" as an example.

![Editing a tool in the admin section listing](./images/selecting_a_tool_in_the_admin_section_listing.png)
*To view/edit a tool, just click on its name in the admin section listing*

You should se a very "bare-bones" tool, like this:

![A recently created tool, without data sources](./images/bare_tools.png)
*A recently created tool, without data sources*

As you can see, there are no data sources connected to this tool. Now we will add one.

![A recently created tool, without data sources](./images/bare_tools.png)
*A recently created tool, without data sources*


Removing an existing tool
-------------------------

Removing an existing tool is, quite understandably, even easier than adding a new one. First, make sure you are in admin mode:

![The TERESAH administrative section tool listing](./images/administrative_section_tool_listing.png)
*The TERESAH administrative section tool listing*

Find the tool you want to delete and click on the small "x" icon in the rightmost column

![The TERESAH administrative section tool listing](./images/deleting_a_tool.png)
*The "delete tool" button*

The tool will now be deleted.


The TERESAH API
===============

Since this manual is aimed at non-programmers, we will not cover the TERESAH API here. For up-to-date information regarding the API, se the folder TERESAH/documentation/api/v1/ in the git repository.

Reference
=========

Special terms and assorted acronyms
-----------------------------------

TERESAH uses some specific terminology and technical words that you may or may not be familiar with. Here we will attempt to clarify things.

API
:   *Application Programming Interface* - a defined way for programs to "speak" to each other.

API-key
:   A "password" or authentication that allows you to use the TERESAH API.

DiRT
:   *Digital Research Tools*. See also "dirtdirectory.org"

dirtdirecory.org
:   One of the external data sources used in TERESAH

Facette
:   A *facette* is a category that is used to sort different tools. Facettes include (for example) the developer of the tool, or the platform it runs on.

Federated Login
:   Logging in to a web page (or other net service) using a third party, such as Google or Facebook

JSON
:   *JavaScript Object Notation*

JSONLD
:   *JSON for Linking Data*

RDF
:   *Resource Description Framework*

TERESAH
:   *Tools E-Registry for E-Social science, Arts and Humanities*

TURTLE
:   *Terse RDF Triple Language* a language/format designed for describing RDF triples. See [Wikipedia article here](https://en.wikipedia.org/wiki/Turtle_%28syntax%29)

Tool
:   In TERESAH, a *tool* refers to a specific piece of software (and its page in TERESAH) that might be useful to researchers.

XML
:   *eXtensible Markup Language*


Types of users
--------------

Different users have different rights in TERESAH. These are the types of user, and what rights they have.

Authenticated user
:   User with registered account. Can edit own profile and create lists of tools. This is the "basic" type of user - all the other types of user "builds" on this type.

Collaborator
:   Authenticated user with collaborator status. Can add and edit tools and data types

Supervisor
:   Authenticated user with supervisor status. Can add, edit and remove tools, data types, data sources, list activities, and harvest other data sources.

Administrator
:   Authenticated user with administrator status. Has full access to all administrative functions.
