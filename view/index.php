<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Terminal</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
               <div class="col-md-4 col-md-offset-4">
                   <h1>SSH System</h1>
               </div>
               <div class="col-md-4 col-md-offset-4 cont-login">
                    <h2>Login to your Account</h2>
                    <form method="POST" name="login" id="login">
                        <div class="form-group">
                            <label for="id">IP Address</label>
                            <input type="text" class="form-control" id="server" name="server" placeholder="IP address">
                        </div>
                        <div class="form-group">
                            <label for="user">User Name</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="button" class="btn btn-default btn-lg btn-block btn-connect">Conectar</button>
                    </form>
               </div>
            </div>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Terminal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" id="output" placeholder="output" readonly="true" style="font-family: Consolas"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="command"  placeholder="Command">
                                <div class="input-group-addon btn-go" id="btn-go"><i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></i><i class="glyphicon glyphicon-play"></i></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-close">Close</button>
                    </div>
            </div>
          </div>
        </div>
    
        <script src=https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
        <style type="text/css">
            h1{
                           text-align: center;
                           margin-bottom: 30px;
                           margin-top: 40px;
            }
            body{
                           background-color: #f5f5f5;
                           font-family: 'Raleway', sans-serif;
        
            }
            .cont-login{
                           background-color: #ffffff;
                           padding: 0 30px 40px 30px;
                           border-top:5px solid #3498db;
                           color: #6b6262;
            }
            .cont-login h2{
                           font-size: 24px;
                           margin-bottom: 20px;
                           color: #3498db;
            }
        
            .form-control{
                           border-radius: 0;
                           height: 40px;
            }
            .cont-login .btn{
                           border-radius: 0;
                           background-color: #3498db;
                           color: #ffffff;
                           border-color: #3498db;
            }
            .cont-login .btn:active{
                           background-color: #2980b9;
                           color: #ffffff;
        
            }
            #output{
                           height: 200px;
            }
            .btn-go:hover{
                           cursor: pointer;
            }
            .btn-go:active{
                           background-color: #dedede
            }
            .glyphicon-refresh-animate {
                -animation: spin .7s infinite linear;
                -webkit-animation: spin2 .7s infinite linear;
            }
            
            @-webkit-keyframes spin2 {
                from { -webkit-transform: rotate(0deg);}
                to { -webkit-transform: rotate(360deg);}
            }
            
            @keyframes spin {
                from { transform: scale(1) rotate(0deg);}
                to { transform: scale(1) rotate(360deg);}
            }                
        </style>
    
        <script type="text/javascript">
            $( document ).ready(function() {
               $(".btn-connect").click(function(){
                               $('#myModal').modal({backdrop: 'static', keyboard: false});  
               });
    
    
                $('#btn-go').click(function(){
                    
                    var cmd = $('#cmd').val();
                    $('#cmd').val('');
                    
                    var server = $('#server').val();
                    var user = $('#user').val();
                    var password = $('#password').val();
                    var command = $('#command').val();
                    
                    var data = {server: server, user: user, password: password, command: command};
                    
    				$.ajax({
    					url : "api/ssh/command",
    					type : "POST",
    					dataType : "json",
    					data : JSON.stringify(data),
    					contentType : "application/json",
    					success : function(aResponse){
                            
                            var psconsole = $('#output');
                            psconsole.val($('#output').val() +'\nUser: '+$('#command').val() +'\n'+ aResponse.ret);
                            
                            if(psconsole.length)
                            psconsole.scrollTop(psconsole[0].scrollHeight - psconsole.height());
                            $('#command').val('');
                            
    					},
    					beforeSend : function(){
    						$(".glyphicon-play").hide();
    						$(".glyphicon-refresh-animate").show();
    					},
    					complete : function(){
    						$(".glyphicon-refresh-animate").hide();
    						$(".glyphicon-play").show();
    					}						
    				});                    
                    
                               
                });
    
                $('.btn-close').click(function(){
                               if(confirm('Deseja realmente sair?')){
                                               $('#myModal').modal('hide');
                               }
                               return false;
                });
                
            });
        </script>
    
    </body>
</html>
