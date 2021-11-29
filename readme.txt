Programmer : Mahdi Norouzi


How to Work This Project?

in postman :

1 - register user :

    go to -> localhost/Register.php
    in input BODY and then RAW :
        {
            "name":"mahdi"
            "email":"m73@gmail.com"
            "password":"123456"
        }

------------------------------------------------------------------------
2 - login user :

      go to -> localhost/Login.php
          in input BODY and then RAW :
              {
                  "email":"m73@gmail.com"
                  "password":"123456"
              }
       ---------------------------------------------------
       output is : Token long string

--------------------------------------------------------------------------
3 - using of Main endpoint:

      go to -> localhost/Main.php

                in input Header type :

                    Authorization : Bearer your_token
                ---------------------------------------------------
                in input Body in post parameters:

                    type = create , update ,delete , getUrl
                    url = your address url - update , create
                    short_code = address short generate by system for update or delete or get url



