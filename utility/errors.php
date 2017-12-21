<?php
define("ERROR_R_USERNAME_NOTVALID", isNotValidUsername());
define("ERROR_R_USERNAME_EXIST", error("Username already exist!"));
define("ERROR_R_PASSWORD_NOMATCH", error("Passwords do not match!"));
define("ERROR_R_PASSWORD_NOTVALID", isNotValidPassword());
define("ERROR_R_EMAIL_EXIST", error("Email already exist!"));
define("ERROR_R_EMAIL_NOTVALID", error("Email is not a valid!"));
define("ERROR_L_INCORRECT", error("Email or password incorrect!"));
define("ERROR_MUTIPLE_SUBMISSION", error("You can not submit mutiple of times!"));
define("ERROR_NOT_LOGGED_IN", error("You have to login first!"));

function error($msg) {
    return "<div class='alert alert-danger' role='alert'>" . $msg . "</div>";
}

function isNotValidPassword()
{
    //TODO check special characters
    return "<div class='alert alert-danger' role='alert'>
                    <ul>
                        <li>Password may contain letter and numbers</li>
                        <li>Password must contain at least 1 number and 1 letter</li>
                        <li>Password may contain any of these characters: !@#$%</li>
                        <li>Password must be 8-32 characters</li>
                    </ul>
                </div>";
}

function isNotValidUsername()
{
    //TODO check special characters
    return "<div class='alert alert-danger' role='alert'>
                    <ul>
                        <li>Username may contain english characters and numbers</li>
                        <li>Username's length is 4-32 characters</li>
                    </ul>
                </div>";
}