<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Criptografia</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                       <h1>Criptografia</h1>
                </div>
            </div>
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6">       
                <div class="panel panel-default cont">
                  <div >
                    <h2 >Criptografar</h2>
                  </div>
                  <div class="panel-body">
                    <form method="POST" name="crypt" id="crypt">
                        <div class="form-group">
                            <label for="id">Chave do Usuário:</label>
                            <input type="text" class="form-control" id="key_c" name="key_c" placeholder="Key">
                        </div>
                        <div class="form-group">
                            <label for="user">Texto</label>
                            <input type="text" class="form-control" id="text_c" name="text_c" placeholder="texto">
                        </div>
                        <button type="button" class="btn btn-default btn-lg btn-block btn-encrypt"><i class="encrypt-load glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></i> Enviar</button>
                    </form>                    
                  </div>
                  <div id="c_response">
                  </div>    
                </div>                   
                </div>                   
              <div class="col-md-6">     
                <div class="panel panel-default cont">
                  <div>
                    <h2>Descriptografar</h2>
                  </div>
                  <div class="panel-body">
                    <form method="POST" name="crypt" id="crypt">
                        <div class="form-group">
                            <label for="id">Chave do Usuário:</label>
                            <input type="text" class="form-control" id="key_d" name="key_d" placeholder="Key">
                        </div>
                        <div class="form-group">
                            <label for="user">Texto Criptografado</label>
                            <input type="text" class="form-control" id="text_d" name="text_d" placeholder="texto">
                        </div>
                        <button type="button" class="btn btn-default btn-lg btn-block btn-decrypt"><i class="decrypt-load glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none;"></i> Enviar</button>
                    </form>                    
                  </div>
                  <div id="d_response">
                  </div>    
                </div>                                         
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
            .cont{
                           background-color: #ffffff;
                           padding: 0 30px 40px 30px;
                           border-top:5px solid #3498db;
                           color: #6b6262;
            }
            .cont h2{
                           font-size: 24px;
                           margin-bottom: 20px;
                           color: #3498db;
            }
        
            .form-control{
                           border-radius: 0;
                           height: 40px;
            }
            .cont .btn{
                           border-radius: 0;
                           background-color: #3498db;
                           color: #ffffff;
                           border-color: #3498db;
            }
            .cont .btn:active{
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
            
            #c_response, #d_response{
                word-wrap: break-word
            }
        </style>
    
        <script type="text/javascript">
            $( document ).ready(function() {

    
                $('.btn-encrypt').click(function(){
                    
                    var key = $('#key_c').val();
                    var text = $('#text_c').val();
                    
                    var data = {key: key, string: text};
                    
    				$.ajax({
    					url : "api/crypt/encrypt",
    					type : "POST",
    					dataType : "json",
    					data : JSON.stringify(data),
    					contentType : "application/json",
    					success : function(aResponse){
                            
                            var psconsole = $('#output');
                            $('#c_response').html('Texto Criptografado: '+aResponse.ret);
                            
                            $('#key_d').val(key);
                            $('#text_d').val(aResponse.ret);

    					},
    					beforeSend : function(){
    						$(".encrypt-load").show();
    					},
    					complete : function(){
    						$(".encrypt-load").hide();
    					}						
    				});                    
                    
                               
                });
    
                $('.btn-decrypt').click(function(){

                    var key = $('#key_d').val();
                    var text = $('#text_d').val();
                    
                    var data = {key: key, string: text};
                    
    				$.ajax({
    					url : "api/crypt/decrypt",
    					type : "POST",
    					dataType : "json",
    					data : JSON.stringify(data),
    					contentType : "application/json",
    					success : function(aResponse){
                            
                            var psconsole = $('#output');
                            $('#d_response').html('Texto Descriptografado: '+aResponse.ret);
                            
    					},
    					beforeSend : function(){
    						$(".decrypt-load").show();
    					},
    					complete : function(){
    						$(".decrypt-load").hide();
    					}						
    				});                    
                    
                               
                });    
   
            });
        </script>
    
    </body>
</html>
