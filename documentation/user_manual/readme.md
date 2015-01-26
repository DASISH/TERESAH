
Welcome to TERESAH. TERESAH (standing for *Tools E-Registry for E-Social science, Arts and Humanities*) is a web based application for the collection and organisation of data research tools. It was created using funds from the Seventh Framework Programme.

![The TERESAH front page](./../../app/assets/images/user_manual/front_page_scroll_1.png)
*The TERESAH front page*

Signing up and logging in
=========================

Creating an account for TERESAH
-------------------------------

Before starting to use TERESAH, you need an account. It is also possible to log in using so-called federated login providers such as linked-in, but for now, lets create a dedicated account.

On the front page, click on "sign in" in the upper right corner. 

![The top bar (no user currently logged in)](./../../app/assets/images/user_manual/top_bar_logged_out.png)
*The top bar (no user currently logged in)*

Next you will be taken to the login page. Since we are assuming that you don't have an account yet, click on "Sign up" below the "Password" field.

![The sign in form. The link to sign up for a new account is highlighted.](./../../app/assets/images/user_manual/sign_in_no_text.png)
*The sign in form. The link to sign up for a new account is highlighted.*

![The sign up form for creating a new user account](./../../app/assets/images/user_manual/sign_up.png)
*The sign up form for creating a new user account*

Now we need some basic information about you: 

- 1) Your name
- 2) Your prefered locale (currently English and Swedish are available)
- 3) A mail adress 
- 4) The password you want to use. Repeat the password. 

Once you have filled out the fields correctly, click on "Sign Up".

![The mail sent to new users.](./../../app/assets/images/user_manual/welcome_mail.png)
*The mail sent to new users.*

Once your application has been processed, you will get a confirmation mail to the address you used in the previous step.

An important note regarding AdBlock
-----------------------------------

If you (like many people) are using AdBlock, you might want to disable it when using TERESAH. It seems AdBlock interprets the login icons for Google, Facebook etc as ads, and hides some of them. Just disable AdBlock for the TERESAH webpage itself (the best solution), or temporarily turn off AdBlock in full.

Viewing tools
=============

Finding and looking at a tool
-----------------------------

Lets look around the tools already in the TERESAH listings

![The TERESAH front page search box](./../../app/assets/images/user_manual/front_page_search_box.png)
*The TERESAH front page search box*

![The top bar tool browsing menu.](./../../app/assets/images/user_manual/browse_tools_menu.png)
*The top bar tool browsing menu.*

- 1) Search for a tool by its name
- 2) Browse the complete TERESAH listings in alphabetical order
- 3) Browse through the different facet listings
- 4) See a listing of the most popular tools

![The search page](./../../app/assets/images/user_manual/search_page.png)
*The search page*

- 1) The number of tools on the current page and the total amount of tools matching your currently selected search filters (3)
- 2) General search box.
- 3) Facet search filters. By selecting one or more of these facets, only tools matching those specific facets are shown
- 4) Alphabetical listing of all tools matching your selected search filters from (3)
- 5) Page switcher, showing how many full pages are needed to show the listings in (4).

![Browsing the alphabetical listing of all tools](./../../app/assets/images/user_manual/browse_all_tools_page.png)
*Browsing the alphabetical listing of all tools*

- 1) The number of tools, on the current page and the total amount of tools matching your currently selected letter.
- 2) Alphabetical selection. Click on a letter to show only tools beginning with that initial.
- 3) Tools listing
- 4) Page selector

![Browsing tools by Facet](./../../app/assets/images/user_manual/browse_tools_by_facet_page.png)
*Browsing tools by Facet*

Here you can browse tools by their facet.

- 1) Developer - who created the tool?
- 2) Keyword - the free-form keywords associated with the tool
- 3) License - under what license is the tool released? (eg. Creative Commons, GPL, Properitary...)
- 4) Platform - what system does the tool require to run? (eg. Windows, Linux, the web...)
- 5) Standards - which technical standards does the tool support? (eg. XML, JSON, HTTP...)
- 6) Tool type - just what kind of tool is this? (eg. text, graphics, audio...)

![Viewing a specific tool](./../../app/assets/images/user_manual/viewing_a_tool.png)
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

![Going to the administrative section of TERESAH from the user menu](./../../app/assets/images/user_manual/going_to_admin_mode.png)
*Going to the administrative section of TERESAH from the user menu*

![The TERESAH administrative section tool listing](./../../app/assets/images/user_manual/administrative_section_tool_listing.png)
*The TERESAH administrative section tool listing*

As the banner across the top of the page now says, *please do be careful*. Use your administrative powers responsibly.

In order to leave admin mode and go back to just browsing TERESAH, click on "Browse TERESAH" in the user menu. You will be back in non-admin broser mode, and the banner across the top of the screen will go away.

![Going back to browsing mode](./../../app/assets/images/user_manual/leaving_admin_mode.png)
*Going back to browsing mode in the user menu*

Adding a new tool 1: Create the tool
------------------------------------

So far we have only looked at tools put into TERESAH by other people, or taken from external data sources. Now we will create one ourselves.

First, go to the administrative section as described above.

![The TERESAH administrative section tool listing](./../../app/assets/images/user_manual/administrative_section_tool_listing.png)
*The TERESAH administrative section tool listing*

Click on "Add new tool"

![The button "Add new tool"](./../../app/assets/images/user_manual/add_a_tool_button.png)
*The button "Add new tool"*

You will see the "Add new tool" dialog.

![The dialog "Add new tool"](./../../app/assets/images/user_manual/add_a_tool_dialog.png)
*The dialog for adding a new tool*

- 1) Fill out the name of the tool..
- 2) ..and click "add tool"

The new tool will be created, and you will be taken to its page. Note that this only creates an "empty" tool - there in no information in it, and no data sources connected to it. That will be added in the next step.

!["Tool successfully added" message](./../../app/assets/images/user_manual/newly_created_tool.png)
*The message informing you of a new tool beeing successfully added*

As you can see, there are no data sources connected to this tool. Now we will add one.

Adding a new tool 2: Add a data source
--------------------------------------

![The data sources menu of a recently created tool](./../../app/assets/images/user_manual/data_source_menu.png)
*The data sources menu of a recently created tool*

You can either use the "Add Data Source" link, or pick "Add Data Source" in the "Data Sources" menu. Later, once you have added a data source, only the menu will be available.

![The "Attach a data source" dialog](./../../app/assets/images/user_manual/attach_a_data_source.png)
*The "Attach a data source" dialog*

Just pick a data source from the menu and click "Attach data source"...

![Data source successfully attached](./../../app/assets/images/user_manual/new_data_source_attached.png)
*Data source successfully attached*

...and you have added a new source.

Adding a new tool 3: Add data to a source
-----------------------------------------

Now let's add some data to the new source

![Add data to empty data source](./../../app/assets/images/user_manual/add_data_to_empty_source.png)
*Add data to empty data source*

Either click on the link "Add tool data" or pick "Add tool data" in the menu for the data source in question. Once you have added some data, only the menu will be available.

![Adding a piece of data to a data source](./../../app/assets/images/user_manual/add_data_field_to_data_source.png)
*Adding a piece of data to a data source*

- 1) Pick the kind of data you want to add (eg. description, developer or platform)
- 2) Fill out the data
- 3) Click "Add data" to save

If we look at the tool (first leaving adminin mode), we can se our newly added data.

![Viewing a newly added data field](./../../app/assets/images/user_manual/viewing_a_new_data_field.png)
*Viewing our newly added data*


Editing an existing tool
------------------------

First you need to find the the tool in the admin section listings. Here we will use the tool we added earlier as an example.

![Editing a tool in the admin section listing](./../../app/assets/images/user_manual/selecting_a_tool_in_the_admin_section_listing.png)
*To view/edit a tool, just click on its name in the admin section listing*

- 1) Click on the name of the tool to view it...
- 2) ...or you can click on the "i" symbol
- 3) To change the name of the tool, click on the "pen" symbol

Removing an existing tool
-------------------------

Removing an existing tool is, quite understandably, even easier than adding a new one. First, make sure you are in admin mode:

![The TERESAH administrative section tool listing](./../../app/assets/images/user_manual/administrative_section_tool_listing.png)
*The TERESAH administrative section tool listing*

Find the tool you want to delete and click on the small "x" icon in the rightmost column

![The TERESAH administrative section tool listing](./../../app/assets/images/user_manual/deleting_a_tool.png)
*The "delete tool" button*

You will be asked if you really want to delete the tool. Click "OK".

![Tool deletion warning dialog](./../../app/assets/images/user_manual/tool_deletion_warning.png)
*The tool deletion warning dialog*

A message bar will show that the tool has been deleted.

![Tool deletion confirmation](./../../app/assets/images/user_manual/tool_successfully_deleted.png)
*Confirmation of tool deletion*


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
:   *JavaScript Object Notation* - a standardized file format for storage and exchange of data. Intentionally simpler than XML.

JSONLD
:   *JSON for Linking Data* - a standard using JSON for transporting Linked Data. 

RDF
:   *Resource Description Framework* - a system for modeling metadata relations. Quite a big subject, so see [Wikipedia article here](https://en.wikipedia.org/wiki/Resource_Description_Framework)

TERESAH
:   *Tools E-Registry for E-Social science, Arts and Humanities* - in case you missed what the acronym itself means.

TURTLE
:   *Terse RDF Triple Language* a language/format designed for describing RDF triples. See [Wikipedia article here](https://en.wikipedia.org/wiki/Turtle_%28syntax%29)

Tool
:   In TERESAH, a *tool* refers to a specific piece of software (and its page in TERESAH) that might be useful to researchers.

XML
:   *eXtensible Markup Language* - a standardized and widely used file format for storage and exchange of data.


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
