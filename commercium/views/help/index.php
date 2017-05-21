<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 21-05-17
 * Time: 17:49
 */

use framework\components\base\Html;

?>

<div class="row">
    <div class="col-md-12">
        <h3> Please fill out this form and a tech support representative will reply to you asap.</h3>
        <?= Html::openForm('help/send') ?>
        <div class="form-group">
            <label for="name">Your name:</label>
            <input type="text" id="name" name="name" class="form-control" autofocus required/>
        </div>
        <div class="form-group">
            <label for="email">Your e-mail:</label>
            <input type="email" id="email" name="email" class="form-control" required/>
        </div>
        <div class="form-group">
            <label for="question">Your question:</label>
            <textarea id="question" name="question" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <input type="checkbox" required id="confirm"/> <label for="confirm">Confirm message</label>
        </div>
        <input type="submit" class="btn btn-success" value="Send message"/>
        </form>
    </div>
</div>
