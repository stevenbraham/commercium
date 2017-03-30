<div class="row">
    <div class="col-md-12">
        <form action="<?= \framework\components\base\Helpers::getUrl("login/login") ?>" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" autofocus/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control"/>
            </div>
            <input type="submit" value="Login" class="btn btn-success"/>
        </form>
    </div>
</div>