# PHPSimpleJWT
PHPSimpleJWT is a minimalist and powerful JSON Web Token manager

[![oFahel](https://i.imgur.com/hSyuS32.png)](https://github.com/ofahel/)

## 🎉 Installation/Usage

Download the jwt.php and put on your project folder.

```php
<?php
include("jwt.php");

//JWT Secret Key
$secret_key = '123';

//JWT Payload data
$content = [
  'iss' => '',  //Issuer of the JWT
  'sub' => '',  //Subject of the JWT (the user)
  'aud' => '',  //Recipient for which the JWT is intended
  'exp' => '',  //Time after which the JWT expires
  'nbf' => '',  //Time before which the JWT must not be accepted for processing
  'iat' => '',  //Time at which the JWT was issued; can be used to determine age of the JWT
  'jti' => '',  //Unique identifier; can be used to prevent the JWT from being replayed (allows a token to be used only once)
  'data' => '', //JWT data what you want
];

//Generate a JWT
$encoded = $JWT->generate($content, $secret_key);
//Return example: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c

//Validate a JWT
$JWT->validate($encoded, $secret_key); //Returns a BOOLEAN

//Decode JWT
$decoded = $JWT->decode($encoded, $secret_key); //Returns a array or BOOLEAN whether false

...

?>
```

## Development

Want to contribute? Great!
You are welcome 🥳

## License

GNU General Public License
