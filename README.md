[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-3.0.en.html)  

# Formidable Challenge
**Tags:** Formidable, Challenge

**License:** GPLv3 or later

**License URI:** http://www.gnu.org/licenses/gpl-3.0.html

A plugin that will display the data coming from an API in the style of the admin page of the WordPress plugin Formidable Forms (in version 4.0+) that includes the Logo and header.

### Description

The plugin will show a table with a list of users coming from an external API (_http://api.strategy11.com/wp-json/challenge/v1/1_), which when called always returns the data, but regardless of when/how many times it is called should not request the data from the server more than 1 time per hour.

The table can be shown whether the user is logged out or in. In order to display the data in the frontend is necessary to add the shortcode `[formidable_challenge]` in the desired page content.

You can also:
  - Use WP CLI command that can be used to force the refresh of this data the next time the AJAX endpoint is called. The command is:
    ```
    wp frmchal refresh
    ``` 

### Tech

* [jQuery] - JavaScript Library which greatly simplifies JavaScript programming.
* [Ajax] - AJAX allows web pages to be updated asynchronously by exchanging data with a web server behind the scenes.
* [PHPUnit] - A programmer-oriented testing framework for PHP.

### Testing
1. Go to the plugin root **../wp-content/plugins/formidable-challenge**
2. Create a test database called **frmchal_test** by running the following command: 
    ```
    bash bin/install-wp-test.sh frmchal_test root '' localhost
    ```
    User should be 'root' and password should be empty. In case this is not possible change the settings in **../formidable-challenge/tests/wordpress-tests-lib/wp-tests.config.php** to your desired database.

3. Run the following command in the plugin root:
    ```
    phpunit
    ```
![Screenshot 3](images/test-results.png)

### Requirements

* WordPress 5.4.
* PHP 7.2 or higher.
* PHPUnit 7.5 _(refrain from using a higher versions)_.
* 
## Screenshots
![Screenshot 1](images/admin-view.png)

![Screenshot 2](images/public-side-view.png)
### License
----

GNU GPL v3

   [jQuery]: <http://jquery.com>
   [ajax]: <https://api.jquery.com/jquery.ajax/>
   [PHPUnit]: <https://phpunit.de/>
