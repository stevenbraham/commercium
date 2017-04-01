<?php
/**
 * @var \commercium\models\User $user
 */
use framework\components\base\Html;

?>
<div class="row">
    <div class="col-md-12">
        <?php
        echo Html::openForm('users/store');
        require_once "_form.php";
        ?>
        <input type="submit" class="btn btn-success" value="Save"/>
        </form>
    </div>
</div>