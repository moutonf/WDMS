<!--
To change this template, choose Tools | Templates
and open the template in the editor.
GSAHFJASFA
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Requirements</title>
        <link href="MyCSS.css" rel="stylesheet">
    </head>
    <body>
        <?php
        // put your code here

        $url = "/Original/Register.php";

            function GoBackRegister (){
                if (headers_sent()){
                    die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
                        }else{
                              header('Location: ' . $url);
                         die();
                        }
            }
        ?>

            <div class ="container">
            <div class ="row main">
                <div class ="main-login main-center">
                    <h2>Sign Up</h2>
                    <form name="login" action="/Original/Register.php" method="POST">


                        <div class ="form-group">
                            <label for="" class="cols-sm-2 control-label">User doesn't exist</label>
                        </div>

                        <div class ="form-group">
                            <input type="submit" value="Sign Me Up Now" name="Sign Me Up Now" id="button" class="btn btn-primary btn-lg btn-block login-button" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
