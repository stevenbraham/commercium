<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 21-05-17
 * Time: 17:47
 */

namespace commercium\controllers;


use framework\components\base\Helpers;
use framework\components\Controller;
use framework\traits\IsLoginProtected;
use function mail;

class HelpController extends Controller {
    use IsLoginProtected;

    public function actionIndex() {
        $this->layoutParams['title'] = "Tech support";
        return $this->render("index");
    }

    public function actionSend() {
        $name = Helpers::getInputParameter("name", "post");
        $email = Helpers::getInputParameter("email", "post");
        $question = Helpers::getInputParameter("question", "post");
        if (!empty($name) && !empty($email) && !empty($question)) {
            //send confirmation to user
            $message = "Hi " . $name . ",\n\nWe have received the following question from you:\n\n"
                . '"' . $question . '"'
                . "\n\nWe will try to help you asap.\n\nRegards, the Commercium team";

            /**
             * The if statement will either return a redirect to the confirmation page or throw a 500 depending on the result of the mail function
             * I choose for redirect after , because then the request will be turned into a GET request and thus the mail action can't be repeated by
             * refreshing the page by accident. Because this is fake application for a fake company, there is no actual logic build in to handle the
             * support tickets.
             */
            return mail($email, "A copy of your support ticket", $message, 'From: "Commercium" <commercium@hanze.nl>') ? $this->redirectTo("help", "confirmation") : Helpers::throwHttpError(500, "Can't send email");
        }
        //something went wrong if this line is reached
        return Helpers::throwHttpError(400, "Required parameters missing. Check your input");
    }

    public function actionConfirmation() {
        $this->layoutParams['title'] = "We have received your ticket";
        return $this->render("confirmation");
    }
}