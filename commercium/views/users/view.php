<?php
/**
 * @var \commercium\models\User $user
 */
use framework\components\base\Html;

?>
<div class="row">
    <div class="col-md-12">
        <?php
        echo Html::openForm('users/save');
        require_once "_form.php";
        ?>
        <input type="submit" class="btn btn-success" value="Save"/>
        </form>
        <hr/>
        <?= Html::openForm("users/delete") . Html::inputField("id", $user->id, '', 'hidden') ?>
        <div class="form-group">
            <input type="checkbox" required id="confirm-delete"/> <label for="confirm-delete">Confirm delete</label>
        </div>
        <input type="submit" class="btn btn-success" value="Delete"/>
        </form>
    </div>
</div>