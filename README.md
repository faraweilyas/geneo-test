# GENEO Application - PHP Exercise

This is a contact form that has the following functionalities:

- Has form fields of Name, Email, Message, and ability to upload a File.
- All fields except File Upload are required.
- Accepted file formats are .pdf, .xlsx and .csv. All other formats are declined.
- It makes sure email is valid.
- It doesn't allow the same user whom has used the form in the last 5 minutes to submit a message then displays a message telling them to wait before they can send a new message.
- Has unit tests to validate save message feature.
- Where necessary it displays a message to the user informing them about failures or a successful submission.
- Has a concise README file that summarises what the app does and includes detailed set up instructions.

# Install with composer
------------

The best way to add the library to your project is using [composer](http://getcomposer.org).
```bash
composer create-project faraweilyas/geneo-test
```
or

# Clone this repo

```bash
git clone https://github.com/faraweilyas/geneo-test.git
```
# Install dependencies

Run the bash command below in the app directory of your terminal to install dependencies
```bash
composer install
```

# Configuration
-------------

Process to set up application

- Find the sql databse structure file in the root dir named `geneo-database.sql` and upload it on your database environment.
- Find `app/Config/database.php` and provide your database configuration parameters on `line 67` that looks like the example below:
```php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'password',
		'database' => 'geneo',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'password',
		'database' => 'geneo_test',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
}
```
- Go to your browser and fire up your application using the server link depending on your server configurations, example of mine is: `localhost/geneo-test/messages/add`
- Fill the form to submit a message.
- You can also run test cases by going to: `localhost/geneo-test/test.php`


I hope you're able to set it up without any issues but if any issue arises please feel free t contact me: faraweilyas@gmail.com or @[faraweilyas.com](https://faraweilyas.com), cheers 🥂.
