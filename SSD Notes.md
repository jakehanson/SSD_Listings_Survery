## SSD Notes

The file that is up to date is the prototyping prototype_1 stuff. There is an index, a style and an app.js.

Let's start by putting each of the 12 classes onto its own page. Preferrably with its own index.html file

**Overview:** I don't like the look of dropdown check boxes. I think that we should split those out into a "Follow Up Questions" page. It may be something like for all the checkboxes that are checked display the hidden classes. There are also problems with hovering. I also think I like the spacing of asking the question followed by checkboxes.

**To Do:**

- [ ] Problems with conflicting classes
- [ ] Fix problems with hovering and the container (everything is highlighted)

- [ ] Split follow-up questions into a "follow-up page"
- [ ] Github Pages

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

- ```html
  console.log($(#page1form").Html);
  
  ## This is the form:
  #("#page1form").on('submit',function(e) {console.log('form was submitted')}
  ```





I could also do e.preventDefault(); # 

```html
(function() {
	$'#page1form').on('submit',function(e) {
e.preventDefault();
let condtion1 = $("#condition1").prop('checked');
let condition2 = $("#condtion2".prop('checked');

if (condition1) {
message += "Condition 1 is True";
}
)
})
let condtion1 = $()
})
```



Make Form 2 in the HTML. THE BENEFITS FORM. On the hidden page we have a form that's just hidden. 

- IDs are unique classes are NOT unique. page2.back will take you to the back button on page three. 
  - $("#page2.back").on('click', {
  - $(#)
  - })



let Conditions = {

}

^^ Creates an object. Which is a data structure with properties. We are checking the properties on page 1 that alter this data structure.

For a form like this we might want to go with templated type structure. There are weebly, wordpress, etc. They all have backend PHP that does lots of heavy lifting. You can also do a STATIC generator e.g. HUGO and JECKEL. HUGO takes markdown and converts them to HTML and formates them. It has templated language to create language - you can still EMBED javascript and EMBED HTML.

#### Mapping between conditions and benefits.

BenefitA: function () {

returns 

}



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

#### To Do



### Misc

IMAGEN - Julia package for continuous time series. For permutation testing I can either permute the time series OR permute the source/target repetoires. JIDT has something.