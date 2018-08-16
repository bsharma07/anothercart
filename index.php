<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>jQuery UI auto-complete tutorial live demo</title>
 
        <!-- include the jquery ui theme css and your own css -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="css/style.css" />
 
    </head>
<body>
 
<!--
    -this is our text box, we didn't use type='text' but type='search' instead
     to have a clear (x) function in case a user wants to easily remove what's in the textbox
    -placeholder='Search firstname or lastname' - is an HTML5 attribute the can give your
     users a clue on what to search or type in the textbox
-->
<div>Try to type "dalisay" below:</div>
<input type='search' id='nameSearch' placeholder='Search firstname or lastname' />
 
<!--
    -now we'll include the jQuery and jQuery UI libraries
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function(){
 
    // this is how to add autocomplete functionality in a textbox
    // source:'results.php' - where it will pass the search term and generates the JSON data
    // minLength:1 - how many characters user enters in order to start search
    $('#nameSearch').autocomplete({
 
        source:'results.php',
        minLength:1,
        select: function(event, ui){
 
            // just in case you want to see the ID
            var accountVal = ui.item.value;
            console.log(accountVal);
 
            // now set the label in the textbox
            var accountText = ui.item.label;
            $('#nameSearch').val(accountText);
 
            return false;
        },
        focus: function( event, ui ) {
            // this is to prevent showing an ID in the textbox instead of name
            // when the user tries to select using the up/down arrow of his keyboard
            $( "#nameSearch" ).val( ui.item.label );
            return false;
        },
 
   });
 
});
</script>