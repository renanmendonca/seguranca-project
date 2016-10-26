<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Auditoria</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                       <h1>Auditoria de Arquivos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">       
                <div class="panel panel-default cont">
                  <div >
                    <h2 >Listagem de Arquivos</h2>
                  </div>
                  <div class="panel-body">
                    <div class="table-responsive">
						<table class="table mb-none">
							<thead>
								<tr>
									<th>#</th>
									<th>Arquivo</th>
									<th>Tamanho</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody id="files_table">
							</tbody>
						</table>
					</div>                      
                    <div id="uploadFileInputHolder" class="center">
                        <span class="btn btn-default btn-lg btn-block" style="width: 100%;">
                            Upload de Arquivo<input id="printFileInput" type="file">
                        </span>
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

                function get_files(){
                    
                    var table = $('#files_table');
                    
                    // Get Files
    				$.ajax({
    					url : "api/upload/file",
    					type : "GET",
    					dataType : "json",
    					contentType : "application/json",
    					success : function(aResponse){
    					    
        					$.each(aResponse.ret, function(i, val) {
        					    console.log(val);
        					    var listItem = $('<tr />')				        
        					        .html('<td>'+(i+1)+'</td><td>' + val.name + '</td><td style="text-align: center;">' + val.size + '</td><td class="actions"><a href=""><i class="fa fa-pencil"></i></a><a href="" class="delete-row"><i class="fa fa-trash-o"></i></a></td>')
        					        .appendTo(table);
        					});	    					    
                            
    					},
    					beforeSend : function(){
    						table.html('');
    					}			
    				});                    
                };                
                  
                get_files();

                $(document).on("change", "#printFileInput", function (e) {
                               var file = e.target.files[0];
                               var formData = new FormData();

                               formData.append('file', file, $('#printFileInput').val());

                               $.ajax({
                                  url: "api/upload/fileUpload",
                                  type: "POST",
                                  processData: false,
                                  contentType: false,
                                  data: formData,
                                  success: function (data) {
                                      alert(data.ret);
                                  },
                                  error: function (err) {
                                    alert("Erro ao fazer upload do arquivo, por favor, tente novamente.");
                                  },
                				  complete : function(){
                					 get_files();
                				  }
                               });                                                       
                });

            });
        </script>
    
    </body>
</html>
