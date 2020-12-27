<!DOCTYPE html>
<html>
<style>
.bg {
  background-image: url("img/bluegradient.jpg");
  height: auto;
  width: 100%;
  background-size: cover;
  background-position: center;
  -moz-background-size: cover;
  -webkit-background-size: cover;
  -o-background-size: cover;
}
.main-section{
    background-size:100% 100%;
    margin: 0px;
    width: 100%;
}
.img-container {
    margin-left:-1%;
    margin-top:-1%;
    float: left;
}
.user-login-header,.login-image-main{
    margin-top: 15px;
}
.user-login-header h1{
    font-size: 45px;
    color:#fff;
}

.user-login-header p,.last-part p{
    color:#0902d6;
}
.user-login-header span{
    color:#fff;
    font-weight: 600;
}
.login-image-main{
    padding: 30px;
    background-color:#fff;
    border-radius:5px;
    box-shadow: 0 0 5px 0 #fff;
}
.user-image-section img{
    background-color: #0902d6;
    height:150px;
    width:150px;
    border: 50%;
}
.user-login-box,.last-part{
    padding:20px;
}
.user-login-box a,.user-login-box a:hover{
    background-color: #0902d6;
    border:1px solid #0902d6;
    width: 100%;
    color:#fff;
    font-weight:600;
}
.button{
    background-color: #0902d6;
    border:1px solid #0902d6;
    width: 100%;
    color:#fff;
    font-weight:600;
    border-radius:5px;
    height: 35px;
}
.last-part a{
    text-decoration: none;
    color:#0902d6;
}
  </style>
<body>
    
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset = "UTF-8" />

</head>
<body>
  <div class = "bg">
    <div class="container main-section">
      <div class="row">
        <div class="col-md-12 text-center user-login-header">
          <h1>Login</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2 login-image-main text-center">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 user-image-section">
              <img src="img/kvpjb.jpg">
                  <div class="col-md-12 col-sm-12 col-xs-12 user-login-box">
                    <div class="form-group">
                      <div class="img-container"> <!-- Block parent element -->
                    <label for="ic"><b>Username:</b></label>
                  </div>
                  <form>
                        <input type="text" class="form-control" placeholder="Enter IC" name="ic" required/>
                    </div>
                    <div class="form-group">
                      <div class="img-container"> <!-- Block parent element -->
                    <label for="pwd"><b>Password:</b></label>
                  </div>
                        <input type="text" class="form-control" placeholder="Password" name="pwd" required/>
                    </div>
                    <div class="img-container"> <!-- Block parent element -->
                    <p ><input type="checkbox" checked="checked" name="remember"> Remember me<br></p>
                  </div><br><br>
            
                    <button type="submit" class="button">Login</a>
                    </form>
                  </div>
              <div class="col-md-12 col-sm-12 col-xs-12 last-part">
                <p><a href="#"> Forget Password?</a></p>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
