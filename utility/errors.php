<?php
define("ERROR_R_USERNAME_NOTVALID", isNotValidUsername());
define("ERROR_R_USERNAME_EXIST", error("Username already exist!"));
define("ERROR_R_PASSWORD_NOMATCH", error("Passwords do not match!"));
define("ERROR_R_PASSWORD_NOTVALID", isNotValidPassword());
define("ERROR_R_EMAIL_EXIST", error("Email already exist!"));
define("ERROR_R_EMAIL_NOTVALID", error("Email is not a valid!"));
define("ERROR_L_INCORRECT", error("Email or password incorrect!"));
define("ERROR_L_INCORRECT_PASSWORD", error("Password is incorrect!"));
define("ERROR_MUTIPLE_SUBMISSION", error("You can not submit mutiple of times!"));
define("ERROR_NOT_LOGGED_IN", error("You have to login first!"));
define("ERROR_NOT_SUBMITTED", error("You can not visit that page!"));
define("ERROR_NOT_AN_IMAGE", error("Sorry, you can not upload a fake image."));
define("ERROR_NOT_UPLOADED", error("Sorry, you have to upload an image of the item."));
define("ERROR_CHANGE_IMAGE_NAME", error("Sorry, image name already exists, change the image's name."));
define("ERROR_IMAGE_TOO_LARGE", error("Sorry, your image is too large."));
define("ERROR_IMAGE_TYPE", error("Sorry, only PNG files are allowed."));
define("ERROR_COULD_NOT_UPLOAD", error("Sorry, there was an error uploading your file."));
define("ERROR_INCORRECT_ITEM_ID", error("You can only choose items only from here."));

function error($msg) {
    return "<div class='alert alert-danger' role='alert'>" . $msg . "</div>";
}

function isNotValidPassword()
{
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