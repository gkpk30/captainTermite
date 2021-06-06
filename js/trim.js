//Example 1: How to Trim Spaces off the beginning of a string

var ltrim = function( text ) {
	var start = 0;
while ( text.charAt (start) == " "){
	start++;
}
return text.substring(start);
}
var result = ltrim(address);




// Example 2: How to trim spaces off the end of a string

var rtrim = function( text ) {
var end = text.length -1;
while ( text.charAt(end) == " "){
end --;
}
return text.substring(0, end + 1);
}
var result = rtrim(address); // result is "JavaScript"




//Example 3: How to combine ltrim and rtrim to trim all spaces

var trim = function( text ) {
	return ltrim( rtrim(text) );
}
var result = trim(address);  // result is "JavaScipt"

