<div class="container">
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Please enter your login details.</h1>
                </div><!-- div.panel-heading -->
                <div class="panel-body">
                    <form method="POST" id="formSignin" onsubmit="return false;">
                        <div class="alert alert-danger hidden"></div>
                        <div class="form-group">
                            <label class="text-muted">Username</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" placeholder="Username" id="user_signin" autofocus="true">
                            </div><!-- div.input-group -->
                        </div><!-- div.form-group -->
                        <div class="form-group">
                            <label class="text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" placeholder="Password" id="pass_signin">
                            </div><!-- div.input-group -->
                        </div><!-- div.form-group -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div><!-- div.text-right -->
                    </form><!-- form#formSignin -->
                </div><!-- div.panel-body -->
            </div><!-- div.panel panel-default -->
        </div><!-- div.col-sm-offset-4 col-sm-4 -->
    </div><!-- div.row -->
</div><!-- div.container -->