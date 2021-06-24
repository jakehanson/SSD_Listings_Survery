## SSD Notes

Let's try to change the attribute of a PHP class using an HTML checkbox. It looks like if I use a form in HTML, the action of the form can be to run/submit a PHP file. It also looks like variables in the php file can be modified using HTML checkboxes.

**To Do:**

- [ ] Split form across multiple HTML pages using session variables

- [ ] Figure out how to store the checkboxes

- [ ] Do the final page that submits the information

- [ ] Update SQL Database with the correct entries

- [x] I want to style my next and previous buttons better!

- [x] Create my SQL database

- [x] "Creating an SQL database from a form". SQL lets you create and manipulate a relational database.

- [ ] Make sure all the pages follow the setup for pages 1,2 and 16 (with the div) and content. Click on the stuff below to see the HTML.

  - [ ] <div class="container">

  <div class="page-header">
    <h1>Example Page Header</h1>      
  </div>
  <p>This is some text.</p>      
  <p>This is another text.</p>      

  </div>

- [ ] Figure out followup page

- [ ] Web Hosting

#### Summary

`index.html` has a form that executes `/update_table.php`. In `/update_table.php` I create a connection with the server, then I pass the results from the form to a SQL database on the server.



#### Followup Questions Page

I think the followup questions page will just be a huge HTML list with nested elements. I will just set the visibility of the elemnts based on the download of the checked boxes array from the database. I will also set some alerts based on logic if the listing is fully or partially satisfied.  

#### Splitting an HTML form across multiple pages using session variables

Session variables allow you to return information across multiple pages. A multi-page form in PHP can be created using sessions, that are used to retain values of a form and can transfer them from one page to another. Here is a [good reference](https://html.form.guide/php-form/php-order-form/).

It sounds like *sessions* are variables that keep their values as the user navigates pages of a site. On the second page, we need to store the submitted data from the first page in the sesson. We store the variable as `$_SESSION['variable_name']`. The last page submits all the `$_SESSION` variables to the database. If it is from the previous page, you can use the `$_POST` array (e.g., `$_POST['name'])`. So session works just like post, but it lasts over multiple pages.

```php
// Fetching all values posted from second page and storing it in variable.
 foreach ($_POST as $key => $value) {
 $_SESSION['post'][$key] = $value;
 }
```

I'm going to need to go back as well as forward. The forward button may be the traditional submit, while the backward button may execute a different command using the `formaction` button.

#### Creating a Client Database in PHP MyAdmin

I will now create the database that I will use to store records for Sarah's clients. The user name will be `SSD_DB` with password `disability12!`. Next, I create a database called `clients`. It is a table with 5 columns: name, email, phone, disability, and ID. The ID is the primary key and should be autoassigned.

>```sql
>INSERT INTO client (name, email, phone, disability) VALUES ('Jake Hanson', 'jakehansn@email.com', '12344355', 'None');
>```

To connect to this database using HTML, I make a connect file called `mysqli_connect.php` with the following information:

```php
<?php
DEFINE('DB_USER', 'SSD_DB');
DEFINE('DB_PASSWORD', 'disability12!');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME','Clients');
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' . 
mysqli_connect_error());
?>
```

Then, I can query this database in the html with a file called `testdb.php`, which contains the following:

```php
<?php
require_once('mysqli_connect.php');
$query = "SELECT name FROM client";
$response = @mysqli_query($dbc, $query);
if($response){
	while($row = mysqli_fetch_array($response)){
		echo $row['name'];
	}
}
?>
```

The result is the name of all the people in the `Clients` database.

#### Adding Clients to Database Using HTML Form

Submitting a form to a PHP page means you can access the form variables using `$_POST['variable_name']$`.  This, in turn, means that you will be able to send these values to the SQL database in the PHP code. This is how checkboxes can be used to populate fields!

The action of a form will be to run the `update_table.php` page. On submit, the form elements will be sent to the database. To use the form variables I set the method of the form to post, and I can call them with `''$_POST[var_name]'`. I will also connect to the database in the same file window, just for clarity.

```php
<?php
$servername = "localhost";
$username = "SSD_DB";
$password = "disability12!";
$dbname = "Clients";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// var_dump($_POST['name']); //Returns an array of all the check boxes that were clicked


$sql = "INSERT INTO client (name, email, phone, disability)
VALUES ('$_POST[name]', '$_POST[email]',  '$_POST[phone]', '')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  echo "<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br>";
}

// Print all the clients
$query = "SELECT name FROM client";
$response = @mysqli_query($conn, $query);
if($response){
	while($row = mysqli_fetch_array($response)){
		echo $row['name'];
		echo "<br>";
	}
}

$conn->close();
?>
```

#### \PHP Form Handling

Note, to access the names of all the listings that are checked, I can use something like the following:

```php
<?php
var_dump($_POST['level']); //Returns an array of all the check boxes that were clicked
?>
```

#### Connecting to the Database

Now we know how to create an SQL database using the myPhpAdmin through XAMPP. Now, I can put my SSD project into the htdocs folder of the XAMPP directory, and it will have access to any database in myPhpAdmin, assuming I connect the databases properly. This should allow me to get forms with PHP up and running.

#### Forms in HTML

I think I want to go back to creating records in a SQL database. If a box is checked, how do I send that to the SQL database? 

If a box is checked, just change the is_hidden property of an HTML/CSS class on the last page. And send the input to the database.

#### PHP Classes and Objects

A class is a template for an object and an object is an instance of a class.

I could perhaps make a class that stores the listing number as well as an attribute for whether it is satisfied. Would I really want to do this in PHP? 

We could have a class called LISTING with the following description:

```php
<?php
class Listing {
  public $number;
  public $description;
  public $is_satisfied;
  public function __construct($number, $description, $is_satisfied) {
    $this->number = $number;
    $this->description = $description;
    $this->is_satisfied = $is_satisfied;

  }
  public function message() {
    if ($this->is_satisfied) {
          return "Listing " . $this->number . " " . $this->description; 
    }
  }
}

$listing001 = new Listing("001", "Schizophrenia", false);
echo $listing001 -> message();
echo "<br>";
$listing002 = new Listing("002", "Autism", true);
echo $listing002 -> message();
?>
```

We will definitely want a class like this somewhere in the code, either in HTML or PHP.

Will the `Listing` class also exist in the SQL database? The user is going to be filling out a form that determines  the value of the `is_satisfied` attribute of the class. For the sublisting class, we have just three attributes: listing, description, and is_satisfied. The main listing class has a partially satisfied attribute in addition to the is_satisfied attribute. In addition, the main listing class will have a *method* that looks to see if the relevant sublistings are satisfied. This means it needs an attribute with the relevant sublistings.

- [ ] How do we map the user input to the relevant attribute?

If we made our class in HTML, then we could create a function that runs with the name of the listing and changes that attribute

```python
def change_attribute(listing_number):
  class_member(listing_number).attribute == True
  
if check:
  change_attribute(checked_number)
```

So it's possible to imagine that the check box maps to an attribute of a class in HTML.

#### Mapping a checkbox to a class attribute in HTML

I can create classes in Javascript. They look very similar to classes in PHP. I can also have methods. The methods could contain the logic. What is the logic? A or B. A and B. A or C. 

#### Running PHP Locally

PHP is crucial for dynamic HTML sites. Usually, the servers run the PHP code, but you can set it up locally as well. All you need is a "local web server", such as XAMPP. After installing XAMPP, when you run localhost in the browser it takes you to the htdocs folder of XAMPP. Putting your project in there will allow you to navigate to it and run it in the browser like a real website.

If I type in localhost in the browser it loads the `XAMPP/htdocs`. 

Going to `localhost/phpmyadmin` loads the admin page.

XAMPP control panel allows you to configure servers. You can manage databases easily through phpMyAdmin application.

Works like a website on own computer. XAMPP allows you to explore a folder as if it was a website. The `localdisk/htdocs/` folder is what xampp has access to. Anything below that is off limits. So I will need to put my files into the htdocs folder.

> Opening [index.html] from my local file system isn't really a real website.

Need to open it with XAMPP! I see how this is going to work. Copy my project into htdocs and it'll all be good.

#### Creating an SQL Database

Make sure the servers are running in XAMPP. I can put the IP address (127.0.0.1) into a browser window and it will take me to the htdocs directory. For `localhost/phpMyAdmin`, the root username is: `root` with password `RootPass47!`.

In phpMyAdmin, which can be accessed using `localhost/phpmyadmin`, you click on databases and create a new database. Note, I have already created a user named `studentdb` with password `studentpass1212`. All this user can do is select, insert, and update information (three priveleges). 

Here is a good resource: https://www.youtube.com/watch?v=EK_AUTzV7OI.

Then I create a table with 8 pieces of data. VARCHAR means string. I added 8 rows, and made the ID field the primary index. I also autoincrement the ID, so everyone should get a unique ID.

Now, in the SQL tab of the phpMyAdmin page, I can insert information into the student database.

```sql
INSERT INTO student (f_name, l_name, street, city, state, email, phone) VALUES ('Jake', 'Hanson', '123 Main St.', 'Paradise Valley', 'AZ', 'xyz@email.com', '123-456-7899');
```

After I have the SQL database created on myPhPAdmin, I can connect to it through files locally. Here, myPhPAdmin is playing the role of the *server* where the database lives, and now I can create files (like html files) that connect to this database. The file I will create to connect to the database is called `mysqli_connect.php` and is located in the `htdocs` directory.

I then put the user and password information into the connect file. I beleive the purpose of the new user was so you can work on projects as a new user without granting root access. It is probably just good practice to create a new user for each of the database projects you will be managing.

Last, we make `testdb.php` to do some stuff with our SQL connection.

#### Connecting Forms to a Database

Connecting forms to a database is a two step process. First, you create an entry form capable of passing information to a secondary file. Next, you create a hypertext Perprocessor PHP file to insert the form data into the database. The transactions needed to store information in the database require Sttructured Query Langauge SQL commands inside of the PHP script. 

OK, so the PHP script allows us to connect and manipulate the database. I put the name of the server in a mysql_connect function, which PHP knows what to do with.

#### Web Hosting

I'm going to need to host my website somewhere. Github pages does not support PHP! It only supports static HTML which, by definition, does not support PHP.

>Dynamic websites generate content live per each request. The request is delegated to a running web-application that builds the content.

I need to host my website on a server. 

It looks like I can run PHP stuff locally with XAMPP. If I do that, I will still need to host the website somewhere. Otherwise, the HTML code won't run on any computer that doesn't have XAMPP installed. That is the concern from before.

#### PHP and Databases

PHP code is executed on the *server*. So I need to have a server.

>PHP can be [used](https://www.php.net/manual/en/install.php) on all major operating systems, including Linux, many Unix variants (including HP-UX, Solaris and OpenBSD), Microsoft Windows, macOS, RISC OS, and probably others. PHP also has support for most of the web servers today. This includes Apache, IIS, and many others. And this includes any web server that can utilize the FastCGI PHP binary, like lighttpd and nginx. PHP works as either a module, or as a CGI processor.

So I can choose my server. I also get to choose my database.

>Writing a database-enabled web page is incredibly simple using one of the database specific extensions (e.g., for [mysql](https://www.php.net/manual/en/book.mysqli.php)), or using an abstraction layer like [PDO](https://www.php.net/manual/en/book.pdo.php), or connect to any database supporting the Open Database Connection standard via the [ODBC](https://www.php.net/manual/en/book.uodbc.php) extension. Other databases may utilize [cURL](https://www.php.net/manual/en/book.curl.php) or [sockets](https://www.php.net/manual/en/book.sockets.php), like CouchDB.

Probably going to use mySQL.

What will the records look like? Name, Age, Sex, Comments, *Boxes Checked*

The boxes checked will be the crucial input from the form. We do something like, **for each box checked, print the relevant listing!** That will require a different database. We would have a *relational database*. The customer information is linked to their checked boxes. The checked boxes are in turn related to the listings satistfied.

- [ ] "Creating an SQL database from a form". SQL lets you create and manipulate a relational database.

There are different types of programming. Procedural (imperative), object-oriented, declarative, and functional. We are not interested in *how* we want the job done, but *what* we want to obtain. For procedural langauges, like C or Java, you do step one, then two, then three. In a declarative langauge, you just say what you want to achieve. I have sensed this from the beginning. That the output is the most important. All we want is the listings that are fully/partially satisfied. 

#### Forms and PHP

I am designing a form in HTML. I just realized that's what it's called. It looks like forms can have an *action* so that when you submit them something happens. How the input is processed is explained in the [PHP tutorial](https://www.w3schools.com/php/default.asp). I need this, since I will be processing input on the backend.

#### Div vs Span vs Label

They all put things in containers. I guess label makes it so if you click anywhere in the container the variable is active. 

>```
>The label element does not render as anything special for the user. However, it provides a usability improvement for mouse users, because if the user clicks on the text within the label element, it toggles the control.
>```

Put differently, the `<label>` tag inside a form is linked with its associated `<input>`. 

The `<div>` tag defines a division or a section in an HTML document.

The `<div>` tag is used as a container for HTML elements - which is then styled with CSS or manipulated with JavaScript.

The `<div>` tag is easily styled by using the class or id attribute.

#### Bootstrap

Bootstrap is designed to be mobile first. There are two container classes: fixed width and full width. The full width will span the entire viewport.

It looks like you put the class in a div element. Do I want to put the questions in a fixed width container or a fluid container?

Bootstrap has headers (<h1>-<h6>), so I need to make sure those don't conflict either.

If I'm committing to bootstrap, then I need to redo my checkboxes.

#### Checkboxes

I want the checkboxes to be labeled so that the followup page can say if checkbox 1.11 was checked, display all these other checkboxes. Would those be child checkboxes? Also, I want this to be in a loop for all parents.

The logic is as follows:

```python
for each in parent_checkboxes:
  if parent_checkbox.is_checkes():
    display(child_checkboxes)
```

#### Styles

I want nice looking things so I'm going to use the [bootstrap package](https://www.w3schools.com/bootstrap/default.asp). This will give me pagers and buttons and stuff. 

#### Buttons

I want buttons that look nice, so I will use the Bootstrap package. Then, I have access to all of their prestyled classes. The concern with using multiple style sheets is that there is no clear rule for what to do if they conflict. I'll jsut have to make sure that the classes in my CSS file are named something very unique, so they don't conflict with Bootstrap's classes.

How many pages are there? Well, a page for each class, then a followup page and a summary report. So a home page, then 14 listings, a followup page, and a summary page. That's a total of 17 pages.

```html
  <ul class="pager">
    <li><a href="1_musculoskeletal.html">Previous</a></li>
    <li><a href="2_speech.html">Next</a></li>
    <li><a href="3_respiratory.html">Previous</a></li>
    <li><a href="4_cardiovascular.html">Next</a></li>
    <li><a href="5_digestive.html">Previous</a></li>
    <li><a href="6_genitourinary.html">Next</a></li>
    <li><a href="7_hematological.html">Previous</a></li>
    <li><a href="8_skin.html">Next</a></li>
    <li><a href="9_endocrine.html">Previous</a></li>
    <li><a href="10_congenital.html">Next</a></li>
    <li><a href="11_neurological.html">Previous</a></li>
    <li><a href="12_mental.html">Next</a></li>
    <li><a href="13_cancer.html">Previous</a></li>
    <li><a href="14_immune.html">Next</a></li>
    <li><a href="15_followup.html">Previous</a></li>
    <li><a href="16_summary.html">Next</a></li>
  </ul>
```

#### Creating Separate HTML Files for each page

The idea here is I want a `page1.html` and a `page2.html` and then maybe an `index.html` that navigates between them with next and back buttons.

This is a well-known problem; there is a good reference [here](https://www.youtube.com/watch?v=MwxAwQdpft4). These references are all working. 

#### Nested Lists

**Update: ** Turns out I don't really like nested checkboxes. I can use the earlier protoyping of something like Page 12 (mental disorders) to see how nested checkboxes work. Going forward, however, I would like to use a followup questions page instead.

`$('input:checkbox')` will select all checkboxes on the page. I can use this to say if any checkbox is checked, then dispay the nested attributes. I'm leaning towards using the visible command, so how does that work?

You can show and hide HTML elements using the jQuery `show()` and `hide()` methods. If the box is checked I can show or hide stuff. You can grab the element using jquery then hide or display it. But I will need the notion of a Parent element, since checking the parent element displays the child element. Nested elements are children of the parent elements.

I can maybe do something like:

`$(this).children.show()` 

The problem is that I'm struggling to grab the child element. I want to do the following:

1) Select the child element

2) Display the child element

I can hide an entire class. For example, if I have `<ul class="nested">` then I can do the following:

`$("div.nested".hide())`

But what is div here? I guess best practice is to hide the element with the css file:

`.nested{display: none;}`

OK. That's what I do. Then I need to somehow change the display using javacript.

```js
$(function(){
    $('.nested').show();
});
```

That worked but it displayed *all* nested lists, rather than the specific one belonging to the parent. Also, it doesn't toggle.

How do I get just the specific nested list to display? The following works:

```javascript
/* function to display child elements on click */
$('input:checkbox').click(function () {    
    this.parentElement.querySelector(".nested").classList.toggle("active");
});
```

The parent element is `<label class="container"></label>`. So it's the container. Then, I use querySelector to get the `nested` class of the parent element. The key is that I've chained the `.nested` to this specific parent element via `this.parentElement.querySelector(".nested")`. However, there is an error that shows up when I check the box *in the hidden section*. The error is that it cannot read the ClassList property. What is the class list property?

Well, the classList method returns the class name(s) of an element. So if I call this method on "container" elements it should return container as the class list. But its not... it's saying that there are zero class names. That's because the checkbox itself doesn't have a class. It's in a container which has a class, but it doesn't have one.

The solution has to do with the fact that `.nested` doesn't exist for the hidden elements. So it's returning null. I can do an if statement conditioned on whether or not .nested exists. Do they have different parent elements? The parent element of the nested list is container. The parent element of the hidden stuff should be the nested list... but I'm not sure it is.

To solve the problem I had to make a new class for the hidden checkboxes. That way, I can differentiate between checkboxes that potentially have nested lists and those that don't.

OK, I've basically got it working.



Front end OR Front and backend Can people see the logic… 

There is the HTML file (`index.html`) and the script (`app.js`). The *script* manipulates content on the page.



What an **ACTION** does on the form is submit it to the backend or another page as a POST. Javascript is handling all the processsing so don't make it submit (action="#")



W3m gives you code for things like checkbox. 

Jquery is a package that lets you grab elements off the page a little more effectively. 



You don't have to download javascript packages. You can just include them in your HTML. Put the snippits in and inport the packages (e.g. jquery is imported via google ajax library). 

- In jquery you can select elements by id. "#page1form"


#### Misc

Submit button. Where does it go? When you click submit it goes somewhere. It does the ACTION. So your submit button will do action = "#". 

Give the form a name 

I can create HTML code from markdown using pandoc:

`pandoc -o index.html index.md`

#### Questions

Add entry for name

How to go from local to website

- Need a place to host it. AWS. GODADDY. DREAMHOST. You pay for server to be running a web server. It will route incoming traffic to the server. The domain name opens up index.html. Set the DNA records so that domain name connects IP address to server. The domain looks for index.html. Returns contents back.

Would it be easy enough to style it with CSS. By the time I'm done with the form as I'm setting it up now I just need to set up dimensions and colors with. 

Whats the difference between `let` vs `const` for variable types. There was also `var` but it had scoping problems so they made let and const. The former is modifiable and the latter is not. Prefer let and const over.

#### Refs

- A full youtube playlist devoping a multipage form is here: https://www.youtube.com/watch?v=J9VGqk8Gm2k&list=PLpxd8S-CfPhM9Wr8jrxKvVVm9Sg3DM-OW
- PHP Multi Page Forms
  - https://www.formget.com/multi-page-form-php/
  - https://html.form.guide/php-form/php-order-form/
