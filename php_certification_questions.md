# PHP Certification Questions (All 60)

This file consolidates all 60 PHP certification questions and answers in sequence.

---

This file contains questions 1 to 10 with code snippets, alternatives, and answers.

---

## Question 1
An HTML form contains this form element:

```html
<input type="file" name="myFile">
```

When this form is submitted, the following PHP code gets run:

```php
move_uploaded_file(
    $_FILES['myFile']['tmp_name'],
    'uploads/' . $_FILES['myFile']['name']
);
```

**Alternatives:**  
a) Check the charset encoding of the HTTP request.  
b) Use $HTTP_POST_FILES instead of $_FILES.  
c) Check with is_uploaded_file() whether the uploaded file is valid.  
d) Sanitize the file name in $_FILES['myFile']['name'].

**Answer:** 👉 d) Sanitize the file name.

---

## Question 2
```php
namespace PHP;

enum Category {
    case Info;
    case Warning;
    case Error;
};

function log(string $message, Category $category) {
    echo "$message {$category->name}";
}

log("My message", ***);
```

**Alternatives:**  
a) Category['Info']  
b) Category.Info  
c) Category::Info  
d) Category->Info

**Answer:** 👉 c) Category::Info

---

## Question 3
How can you create an HTTP POST request in PHP without installing or activating an extension?

**Alternatives:**  
a) file_get_contents()  
b) curl_exec()  
c) PHP only supports GET requests  
d) http_build_query()

**Answer:** 👉 a) file_get_contents()

---

## Question 4
Which approaches are recommended to protect a site against CSRF? (Choose 2)

**Alternatives:**  
a) Use the SameSite flag for cookies.  
b) Add an additional token to the HTTP request.  
c) Validate the IP address of the user.  
d) Use POST instead of GET.  
e) Disable sessions.

**Answer:** 👉 a) and b)

---

## Question 5
Which of the following tasks can be achieved by using magic methods? (Choose 3)

**Alternatives:**  
a) Creating an iterable object.  
b) Processing access to undefined methods or properties.  
c) Initializing or uninitializing object data.  
d) Creating a new stream wrapper.  
e) Converting objects to string representation.  
f) Overloading operators like +, *, etc.

**Answer:** 👉 b), c), e)

---

## Question 6
```php
namespace MyNamespace;

class Test {}

echo Test::class;
```

**Alternatives:**  
a) parse error  
b) empty string  
c) MyNamespace\Test  
d) Test

**Answer:** 👉 c) MyNamespace\Test

---

## Question 7
Which of the following is a package manager that allows adding dependencies to a PHP project?

**Alternatives:**  
a) PHAR  
b) Composer  
c) Maven  
d) TAR

**Answer:** 👉 b) Composer

---

## Question 8
Your User class has a $role property. Code must retrieve it publicly, but only the class itself can change it.

```php
class User
{
    public(get) private(set) string $role;
}
```

**Answer:** 👉 This satisfies the requirement.

---

## Question 9
What is the benefit of using persistent database connections in PHP? (Choose 2)

**Alternatives:**  
a) Allows connection settings to persist.  
b) Allows for resumption of transactions across requests.  
c) Ensures only a single connection is open.  
d) Reduces connection & authentication overhead.

**Answer:** 👉 a) and d)

---

## Question 10
Which regex matches these formats?  
(000) 555-1234, 000 555 1234, 000-555-1234, 000.555.1234

**Alternatives:**  
a) /^.*\d{3}.\d{3}.\d{4}$/  
b) /^(\d{3}).\d{3}.\d{4}$/  
c) /^.*(\d{3}.\d{3}.\d{4})$/  
d) /^(\d{3}).\d{3}.\d{4}$/

**Answer:** 👉 d) /^(\d{3}).\d{3}.\d{4}$/

---


This file contains questions 11 to 20 with code snippets, alternatives, and answers.

---

## Question 11
Which function returns an array containing all matches from a given string using a regex?

**Alternatives:**  
a) preg_match()  
b) preg_split()  
c) preg_match_all()  
d) preg_grep()

**Answer:** 👉 c) preg_match_all()

---

## Question 12
Which class provides an object-oriented interface for file handling in PHP?

**Alternatives:**  
a) FileObject  
b) FileHandler  
c) SplFileObject  
d) FileResource

**Answer:** 👉 c) SplFileObject

---

## Question 13
What is the output of the following code?

```php
$array = [1, 2, 3];
echo $array[3] ?? 'default';
```

**Alternatives:**  
a) Notice error  
b) 3  
c) default  
d) null

**Answer:** 👉 c) default

---

## Question 14
Which operator is used to suppress errors in PHP?

**Alternatives:**  
a) #  
b) @  
c) !  
d) ~

**Answer:** 👉 b) @

---

## Question 15
Which function is used to determine if a variable is an array?

**Alternatives:**  
a) is_var()  
b) is_array()  
c) var_type()  
d) check_array()

**Answer:** 👉 b) is_array()

---

## Question 16
What is the difference between `==` and `===` in PHP?

**Answer:** 👉
- `==` checks for equality of values (with type juggling).
- `===` checks for equality of both value and type (strict comparison).

---

## Question 17
What is the result of the following code?

```php
$a = '123abc';
$b = 123;
var_dump($a == $b);
var_dump($a === $b);
```

**Answer:** 👉
- `$a == $b` → true (string converted to number).
- `$a === $b` → false (different types).

---

## Question 18
Which function returns the number of elements in an array?

**Alternatives:**  
a) sizeof()  
b) length()  
c) count()  
d) both a and c

**Answer:** 👉 d) both a and c

---

## Question 19
Which function is used to check if a variable has been set and is not NULL?

**Alternatives:**  
a) empty()  
b) is_null()  
c) isset()  
d) defined()

**Answer:** 👉 c) isset()

---

## Question 20
What is the output of the following code?

```php
$array = [10, 20, 30];
array_shift($array);
print_r($array);
```

**Alternatives:**  
a) [20, 30]  
b) [10, 20]  
c) [30]  
d) [10]

**Answer:** 👉 a) [20, 30]

---


This file contains questions 21 to 30 with code snippets, alternatives, and answers.

---

## Question 21
Which function is used to include and evaluate a specified file during script execution?

**Alternatives:**  
a) require_once()  
b) eval()  
c) include()  
d) load()

**Answer:** 👉 c) include()

---

## Question 22
What is the output of the following code?

```php
$a = [1, 2, 3];
$b = $a;
$b[] = 4;
print_r($a);
```

**Alternatives:**  
a) [1, 2, 3, 4]  
b) [1, 2, 3]  
c) [4]  
d) Error

**Answer:** 👉 b) [1, 2, 3]

---

## Question 23
Which of the following is used to define a constant in PHP?

**Alternatives:**  
a) let()  
b) const or define()  
c) var()  
d) set()

**Answer:** 👉 b) const or define()

---

## Question 24
What is the output of the following code?

```php
define("PI", 3.14);
echo PI * 2;
```

**Answer:** 👉 6.28

---

## Question 25
Which superglobal contains information about headers, paths, and script locations?

**Alternatives:**  
a) $_POST  
b) $_GET  
c) $_SERVER  
d) $_FILES

**Answer:** 👉 c) $_SERVER

---

## Question 26
Which function is used to check if a file exists?

**Alternatives:**  
a) file_exist()  
b) exists_file()  
c) file_exists()  
d) is_file()

**Answer:** 👉 c) file_exists()

---

## Question 27
Which function is used to terminate script execution in PHP?

**Alternatives:**  
a) end()  
b) terminate()  
c) exit() or die()  
d) stop()

**Answer:** 👉 c) exit() or die()

---

## Question 28
What is the output of the following code?

```php
$x = 5;
$y = &$x;
$y = 10;
echo $x;
```

**Answer:** 👉 10

---

## Question 29
Which of the following functions can be used to sort an array by values in ascending order?

**Alternatives:**  
a) ksort()  
b) sort()  
c) asort()  
d) b and c

**Answer:** 👉 d) b and c

---

## Question 30
Which of the following PHP functions can be used to start a new session?

**Alternatives:**  
a) start_session()  
b) begin()  
c) session_start()  
d) open_session()

**Answer:** 👉 c) session_start()

---


This file contains questions 31 to 40 with code snippets, alternatives, and answers.

---

## Question 31
Which of the following functions can be used to hash a string using the default algorithm?

**Alternatives:**  
a) hash_string()  
b) password_hash()  
c) crypt_string()  
d) encrypt()

**Answer:** 👉 b) password_hash()

---

## Question 32
Which of the following functions can be used to verify that a password matches a hash created by `password_hash()`?

**Alternatives:**  
a) password_verify()  
b) hash_equals()  
c) verify_password()  
d) strcmp()

**Answer:** 👉 a) password_verify()

---

## Question 33
Which of the following magic methods is triggered when trying to access inaccessible or non-existing properties?

**Alternatives:**  
a) __call()  
b) __isset()  
c) __get()  
d) __invoke()

**Answer:** 👉 c) __get()

---

## Question 34
Which of the following functions is used to serialize a PHP value into a storable representation?

**Alternatives:**  
a) json_encode()  
b) serialize()  
c) pack()  
d) store()

**Answer:** 👉 b) serialize()

---

## Question 35
Which of the following functions is used to revert a serialized string back to PHP data?

**Alternatives:**  
a) json_decode()  
b) unserialize()  
c) unpack()  
d) restore()

**Answer:** 👉 b) unserialize()

---

## Question 36
What is the output of the following code?

```php
$a = 5;
$b = "5";
var_dump($a == $b);
var_dump($a === $b);
```

**Answer:** 👉
- `$a == $b` → true
- `$a === $b` → false

---

## Question 37
Which function is used to filter variables with a specified filter?

**Alternatives:**  
a) filter_input()  
b) var_filter()  
c) filter_var()  
d) a and c

**Answer:** 👉 d) a and c

---

## Question 38
What is the output of the following code?

```php
echo (int) ( (0.1+0.7) * 10 );
```

**Answer:** 👉 7

---

## Question 39
Which of the following functions can be used to parse a URL and return its components?

**Alternatives:**  
a) parse_str()  
b) parse_url()  
c) explode_url()  
d) str_split()

**Answer:** 👉 b) parse_url()

---

## Question 40
Which of the following functions can be used to split a string by a regular expression?

**Alternatives:**  
a) preg_split()  
b) split()  
c) explode()  
d) str_split()

**Answer:** 👉 a) preg_split()

---


This file contains questions 41 to 50 with code snippets, alternatives, and answers.

---

## Question 41
Which of the following functions can be used to remove whitespace (or other characters) from the beginning and end of a string?

**Alternatives:**  
a) strip()  
b) trim()  
c) cut()  
d) ltrim() and rtrim() only

**Answer:** 👉 b) trim()

---

## Question 42
Which function can be used to get the current Unix timestamp?

**Alternatives:**  
a) time()  
b) date()  
c) now()  
d) mktime()

**Answer:** 👉 a) time()

---

## Question 43
What is the output of the following code?

```php
echo date("Y-m-d", strtotime("next Monday"));
```

**Answer:** 👉 The date of the next Monday in `YYYY-MM-DD` format.

---

## Question 44
Which function is used to set the default timezone in PHP?

**Alternatives:**  
a) set_timezone()  
b) date_default_timezone_set()  
c) timezone_set()  
d) ini_set("timezone")

**Answer:** 👉 b) date_default_timezone_set()

---

## Question 45
Which of the following functions is used to send a raw HTTP header in PHP?

**Alternatives:**  
a) http_send()  
b) header()  
c) response_header()  
d) set_header()

**Answer:** 👉 b) header()

---

## Question 46
Which superglobal contains HTTP POST variables?

**Alternatives:**  
a) $_SERVER  
b) $_POST  
c) $_GET  
d) $_REQUEST

**Answer:** 👉 b) $_POST

---

## Question 47
Which function is used to end output buffering and send the output?

**Alternatives:**  
a) ob_end_flush()  
b) ob_clean()  
c) flush()  
d) ob_end_clean()

**Answer:** 👉 a) ob_end_flush()

---

## Question 48
Which function can be used to send an email in PHP?

**Alternatives:**  
a) send_mail()  
b) smtp_send()  
c) mail()  
d) email()

**Answer:** 👉 c) mail()

---

## Question 49
Which of the following functions can be used to check if a variable is of type integer?

**Alternatives:**  
a) is_int()  
b) is_integer()  
c) is_long()  
d) All of the above

**Answer:** 👉 d) All of the above

---

## Question 50
Which error control operator suppresses error messages?

**Alternatives:**  
a) #  
b) @  
c) !  
d) ~

**Answer:** 👉 b) @

---


This file contains questions 51 to 60 with code snippets, alternatives, and answers.

---

## Question 51
Which of the following functions can be used to read a line from a file?

**Alternatives:**  
a) file_get_contents()  
b) fgets()  
c) fread()  
d) getline()

**Answer:** 👉 b) fgets()

---

## Question 52
Which function can be used to write a string to a file?

**Alternatives:**  
a) fwrite()  
b) file_put_contents()  
c) echo >> file  
d) a and b

**Answer:** 👉 d) a and b

---

## Question 53
Which function can be used to lock a file in PHP?

**Alternatives:**  
a) flock()  
b) file_lock()  
c) lock_file()  
d) fopen() with mode l

**Answer:** 👉 a) flock()

---

## Question 54
Which of the following is the correct way to define a namespace in PHP?

**Alternatives:**  
a) package MyApp;  
b) namespace MyApp;  
c) module MyApp;  
d) using namespace MyApp;

**Answer:** 👉 b) namespace MyApp;

---

## Question 55
Which function returns the name of the class of an object?

**Alternatives:**  
a) get_object_name()  
b) class_name()  
c) get_class()  
d) object_class()

**Answer:** 👉 c) get_class()

---

## Question 56
Which of the following keywords is used to inherit a class in PHP?

**Alternatives:**  
a) inherits  
b) extend  
c) extends  
d) use

**Answer:** 👉 c) extends

---

## Question 57
Which of the following methods is called when creating a new object of a class?

**Alternatives:**  
a) __construct()  
b) __create()  
c) __new()  
d) __init()

**Answer:** 👉 a) __construct()

---

## Question 58
Which function can be used to check if a class exists?

**Alternatives:**  
a) class_exist()  
b) class_exists()  
c) exists_class()  
d) isset_class()

**Answer:** 👉 b) class_exists()

---

## Question 59
Which of the following functions can be used to check if a method exists in a class?

**Alternatives:**  
a) method_exists()  
b) class_method_exists()  
c) has_method()  
d) function_exists()

**Answer:** 👉 a) method_exists()

---

## Question 60
Which function is used to check if a function exists?

**Alternatives:**  
a) func_exists()  
b) function_exists()  
c) exists_function()  
d) has_function()

**Answer:** 👉 b) function_exists()

---

