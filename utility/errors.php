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
define("ERROR_IMAGE_TYPE", error("Sorry, only PNG, JPG or JPEG files are allowed."));
define("ERROR_COULD_NOT_UPLOAD", error("Sorry, there was an error uploading your file."));
define("ERROR_INCORRECT_ITEM_ID", error("You can only choose items only from here."));
define("ERROR_REMOVE_OTHERS_ITEM", error("You can only remove your own items."));
define("ERROR_REMOVE", error("You can only remove from here."));
define("ERROR_MODIFY_REJECT", error("Sorry, your attempt to modify was rejected."));
define("ERROR_NOT_FULLY_FILLED", error("Sorry, you have to fill all the information of the item."));
define("ERROR_PRICE_NOT_A_NUMBER", error("Sorry, you have to fill a valid positive price and its length must not exceed 11."));
define("ERROR_QUANTITY_NOT_A_VALID_NUMBER", error("Sorry, you have to fill a positive number in quantity and its length must not exceed 11."));
define("ERROR_ZIP_NOT_NUMBER", error("Sorry, you have to fill a valid ZIP number and its length must not exceed 7."));
define("ERROR_PHONE_NOT_NUMBER", error("Sorry, you have to fill a valid Phone Number and its length must not exceed 15."));

function error($msg) {
    return "<div class='alert alert-danger' role='alert'>" . $msg . "</div>";
}

function isNotValidPassword() {
    return "<div class='alert alert-danger' role='alert'>
                    <ul>
                        <li>Password may contain letter and numbers</li>
                        <li>Password must contain at least 1 number and 1 letter</li>
                        <li>Password may contain any of these characters: !@#$%</li>
                        <li>Password must be 8-32 characters</li>
                    </ul>
                </div>";
}

function isNotValidUsername() {
    return "<div class='alert alert-danger' role='alert'>
                    <ul>
                        <li>Username may contain english characters and numbers</li>
                        <li>Username's length is 4-32 characters</li>
                    </ul>
                </div>";
}

function getError($error) {
    switch ($error) {
        case"ERROR_R_USERNAME_NOTVALID" : return ERROR_R_USERNAME_NOTVALID;
        break;
        case"ERROR_R_USERNAME_EXIST" : return ERROR_R_USERNAME_EXIST;
        break;
        case"ERROR_R_PASSWORD_NOMATCH" : return ERROR_R_PASSWORD_NOMATCH;
        break;
        case"ERROR_R_PASSWORD_NOTVALID" : return ERROR_R_PASSWORD_NOTVALID;
        break;
        case"ERROR_R_EMAIL_EXIST" : return ERROR_R_EMAIL_EXIST;
        break;
        case"ERROR_R_EMAIL_NOTVALID" : return ERROR_R_EMAIL_NOTVALID;
        break;
        case"ERROR_L_INCORRECT" : return ERROR_L_INCORRECT;
        break;
        case"ERROR_L_INCORRECT_PASSWORD" : return ERROR_L_INCORRECT_PASSWORD;
        break;
        case"ERROR_MUTIPLE_SUBMISSION" : return ERROR_MUTIPLE_SUBMISSION;
        break;
        case"ERROR_NOT_LOGGED_IN" : return ERROR_NOT_LOGGED_IN;
        break;
        case"ERROR_NOT_SUBMITTED" : return ERROR_NOT_SUBMITTED;
        break;
        case"ERROR_NOT_AN_IMAGE" : return ERROR_NOT_AN_IMAGE;
        break;
        case"ERROR_NOT_UPLOADED" : return ERROR_NOT_UPLOADED;
        break;
        case"ERROR_CHANGE_IMAGE_NAME" : return ERROR_CHANGE_IMAGE_NAME;
        break;
        case"ERROR_IMAGE_TOO_LARGE" : return ERROR_IMAGE_TOO_LARGE;
        break;
        case"ERROR_IMAGE_TYPE" : return ERROR_IMAGE_TYPE;
        break;
        case"ERROR_COULD_NOT_UPLOAD" : return ERROR_COULD_NOT_UPLOAD;
        break;
        case"ERROR_INCORRECT_ITEM_ID" : return ERROR_INCORRECT_ITEM_ID;
        break;
        case"ERROR_REMOVE_OTHERS_ITEM" : return ERROR_REMOVE_OTHERS_ITEM;
        break;
        case"ERROR_REMOVE" : return ERROR_REMOVE;
        break;
        case"ERROR_MODIFY_REJECT" : return ERROR_MODIFY_REJECT;
        break;
        case"ERROR_NOT_FULLY_FILLED" : return ERROR_NOT_FULLY_FILLED;
        break;
        case"ERROR_PRICE_NOT_A_NUMBER" : return ERROR_PRICE_NOT_A_NUMBER;
        break;
        case"ERROR_QUANTITY_NOT_A_VALID_NUMBER" : return ERROR_QUANTITY_NOT_A_VALID_NUMBER;
        break;
        case"ERROR_ZIP_NOT_NUMBER" : return ERROR_ZIP_NOT_NUMBER;
        break;
        case"ERROR_PHONE_NOT_NUMBER" : return ERROR_PHONE_NOT_NUMBER;
        break;
    }

    return '';
}