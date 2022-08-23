 <html>
        <head>
            <meta http-equiv="Content-Type" content="charset=utf-8" />
            <meta charset="UTF-8">
            <title>PDF Upn</title>
            <style type="text/css">
            .bg-image 
            {
            background-image:url('/images/pdf/1.png');
            background-repeat:no-repeat;
            width:100%;
            height:100%;
            background-size: cover;
            }
            .page-break 
            {
                page-break-after: always;
            }
            .box
            {
                position: relative;
                display: inline-block; /* Make the width of box same as image */
            }
            .box .numero-solicitud
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 450px;
                font-size: 12px;
                top: 14.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }            

            .box .nombre-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 22.8%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .cuit-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 25.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                       
            .box .dni-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 23%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .condicion-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 290px;
                font-size: 12px;
                top: 25.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            } 
            .box .ocupacion-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 520px;
                font-size: 12px;
                top: 25.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            } 
            .box .lugar-nacimiento-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 28.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .fecha-nacimiento-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 300px;
                font-size: 12px;
                top: 28.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            } 
            .box .edad-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 420px;
                font-size: 12px;
                top: 28.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                         
            .box .masculino
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 570px;
                font-size: 12px;
                top: 28.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                         
            .box .femenino
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 650px;
                font-size: 12px;
                top: 28.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                             
            .box .nacionalidad-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 31%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                                                          
            .capitalize
            {
                text-transform:capitalize;
            } 

            .box .zurdo
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 420px;
                font-size: 12px;
                top: 31%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }               

            .box .estado-civil-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 520px;
                font-size: 12px;
                top: 31%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            } 
            .box .domicilio-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 33.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                          
            .box .localidad-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 36%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                                                          
            .box .provincia-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 300px;
                font-size: 12px;
                top: 36%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .email-asegurado
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 38.6%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }               
            .box .familia-nombre-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 44.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-nombre-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 45.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .familia-nombre-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 47.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-nombre-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 48.6% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-nombre-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 50% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-nombre-5
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 51.5% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }      

            .box .familia-parentesco-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 44.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-parentesco-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 45.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .familia-parentesco-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 47.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-parentesco-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 48.6% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-parentesco-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 50% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-parentesco-5
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 51.5% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }      
            .box .familia-dni-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 44.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-dni-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 45.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .familia-dni-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 47.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-dni-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 48.6% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-dni-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 50% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-dni-5
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 51.5% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }            

            .box .familia-fecha-nacimiento-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 44.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-fecha-nacimiento-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 45.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .familia-fecha-nacimiento-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 47.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-fecha-nacimiento-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 48.6% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-fecha-nacimiento-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 50% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-fecha-nacimiento-5
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 51.5% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }              
            .box .familia-telefono-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 44.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-telefono-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 45.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .familia-telefono-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 47.2% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .familia-telefono-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 48.6% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-telefono-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 50% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .familia-telefono-5
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 51.5% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            } 
            .box .cobertura_prestacional
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 63.5px;
                font-size: 12px;
                top: 55.9%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                    
            .box .reintegro_gastos
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 364px;
                font-size: 12px;
                top: 55.9%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                       
            .box .inicio-vigencia
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 63.5px;
                font-size: 12px;
                top: 58.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }           
            .box .plazo_carencia
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 364px;
                font-size: 12px;
                top: 58.5%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                    
            .box .facturacion-mensual
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 80px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .facturacion-trimestral
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 140px;
                font-size: 12px;
                top: 61.2%%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .facturacion-cuatrimestral
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 200px;
                font-size: 12px;
                top: 61.2%%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .facturacion-semestral
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 270px;
                font-size: 12px;
                top: 61.2%%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .facturacion-anual
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 320px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }        
            .box .cuotas-mensual
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 390px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .cuotas-trimestral
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 450px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .cuotas-cuatrimestral
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 520px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .cuotas-semestral
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                
            .box .cuotas-anual
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 640px;
                font-size: 12px;
                top: 61.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            } 
            .box .beneficiario-nombre-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 75.9% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-nombre-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 77.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .beneficiario-nombre-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 78.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-nombre-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 80.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .beneficiario-nombre-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 81.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     

            .box .beneficiario-parentesco-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 75.9% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-parentesco-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 77.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .beneficiario-parentesco-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 78.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-parentesco-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 80.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .beneficiario-parentesco-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 260px;
                font-size: 12px;
                top: 81.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     

            .box .beneficiario-dni-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 75.9% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-dni-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 77.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .beneficiario-dni-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 78.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-dni-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 80.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .beneficiario-dni-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 400px;
                font-size: 12px;
                top: 81.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
       
            .box .beneficiario-prioridad-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 75.9% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-prioridad-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 77.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .beneficiario-prioridad-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 78.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-prioridad-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 80.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .beneficiario-prioridad-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 510px;
                font-size: 12px;
                top: 81.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
           
            .box .beneficiario-porcentaje-0
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 75.9% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-porcentaje-1
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 77.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }   
            .box .beneficiario-porcentaje-2
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 78.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }
            .box .beneficiario-porcentaje-3
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 80.3% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     
            .box .beneficiario-porcentaje-4
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 590px;
                font-size: 12px;
                top: 81.8% /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }     

            .box .nombre-productor
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 70px;
                font-size: 12px;
                top: 29.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }             
                                  
            .box .codigo-productor
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 380px;
                font-size: 12px;
                top: 29.2%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }           
            .box .imagen-firma
            {
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                color:red;
                padding-left: 335px;
                font-size: 12px;
                top: 35%; /* Adjust this value to move the positioned div up and down */
                text-align: left;
                width: 60%; /* Set the width of the positioned div */
            }                 
                                 
                                   
            </style>
        </head>
        <body>
            <div class="box">
                <div class="page-break">
                    <img style="width:100%" src="images/pdf/1.png">
                    <div class="numero-solicitud">
                        <span class="">{{$poliza->id}}</span>
                    </div>                    
                    <div class="nombre-asegurado">
                        <span class="">{{\Illuminate\Support\Str::limit($asegurable->nombre_asegurable, 30, $end='...')}}</span>
                    </div>
                    <div class="dni-asegurado">
                        <span>{{$asegurable->dni_asegurable}}</span>
                    </div>
                    <div class="cuit-asegurado">
                        <span>{{$asegurable->cuit_asegurable}}</span>
                    </div> 
                    <div class="condicion-asegurado">
                        <span>{{$asegurable->condicion_iva}}</span>
                    </div>
                    <div class="ocupacion-asegurado">
                        <span class="capitalize">{{\Illuminate\Support\Str::limit($asegurable->ocupacion, 17, $end='...')}}</span>
                    </div>   
                    <div class="lugar-nacimiento-asegurado">
                        <span>{{\Illuminate\Support\Str::limit($asegurable->lugar_nacimiento_asegurable, 25, $end='...')}}</span>
                    </div>        
                    <div class="fecha-nacimiento-asegurado">
                        <span>{{str_replace(".","/",$asegurable->fecha_nacimiento_asegurable)}}</span>
                    </div>   
                    <div class="edad-asegurado">
                        <span>{{$asegurable->edad_asegurable}} años</span>
                    </div> 

                    @if($asegurable->sexo_asegurable === "masculino")
                    <div class="masculino">
                        <span>X</span>
                    </div> 
                    @else                    
                    <div class="femenino">
                        <span>X</span>
                    </div>     
                    @endif

                    <div class="nacionalidad-asegurado">
                        <span>{{$asegurable->nacionalidad_asegurable}}</span>
                    </div>
                    <div class="zurdo">
                        @if($asegurable->mano_habil == 1)
                        <span>NO</span>
                        @else
                        <span>SI</span>
                        @endif
                    </div> 


                    <div class="capitalize estado-civil-asegurado">
                        <span>{{$asegurable->estado_civil}}</span>
                    </div>       
                    <div class="domicilio-asegurado">
                        <span>{{$asegurable->domicilio_asegurable}}</span>
                    </div>
                    <div class="localidad-asegurado">
                        <span>{{\Illuminate\Support\Str::limit($asegurable->city->name, 28, $end='...')}}</span>
                    </div>       
                    <div class="provincia-asegurado">
                        <span>{{\Illuminate\Support\Str::limit($asegurable->province->name, 12, $end='...')}}</span>
                    </div>     
                    <div class="email-asegurado">
                        <span>{{$asegurable->email_asegurable}}</span>
                    </div>
                    @foreach($familia->slice(0,6) as $familiar)            
                    <div class="capitalize familia-nombre-{{$loop->index}}">
                        <span class="">{{\Illuminate\Support\Str::limit($familiar->nombre_familia, 27, $end='...')}}</span>
                    </div>
                    <div class="capitalize familia-parentesco-{{$loop->index}}">
                        <span class="">{{$familiar->parentesco_familiar}}</span>
                    </div>  
                    <div class="capitalize familia-dni-{{$loop->index}}">
                        <span class="">{{$familiar->dni_familia}}</span>
                    </div>         
                    <div class="capitalize familia-fecha-nacimiento-{{$loop->index}}">
                        <span class="">{{str_replace(".","/",$familiar->fecha_nacimiento_familia)}}</span>
                    </div>   
                    <div class="capitalize familia-telefono-{{$loop->index}}">
                        <span class="">{{$familiar->celular_familia}}</span>
                    </div>                                            
                    @endforeach 

                    @if($poliza->tipo_cobertura === "cobertura_prestacional")
                        <div class="cobertura_prestacional">
                            <span>X</span>
                        </div> 
                    @else                    
                        <div class="reintegro_gastos">
                            <span>X</span>
                        </div>     
                    @endif 

                    <div class="inicio-vigencia">
                        <span>{{str_replace(".","/",$poliza->inicio_vigencia)}}</span>
                    </div>         
                    <div class="plazo_carencia">
                        <span>{{$poliza->plazo_carencia}} días</span>
                    </div>       
                    @if($poliza->facturacion === "mensual")
                        <div class="facturacion-mensual">
                            <span>X</span>
                        </div>
                        @elseif($poliza->facturacion === "trimestral")    
                            <div class="facturacion-trimestral">
                                <span>X</span>
                            </div>
                        @elseif($poliza->facturacion === "cuatrimestral")    
                            <div class="facturacion-cuatrimestral">
                                <span>X</span>
                            </div>
                        @elseif($poliza->facturacion === "semestral")    
                            <div class="facturacion-semestral">
                                <span>X</span>
                            </div>
                        @elseif($poliza->facturacion === "anual")                                                                                    
                            <div class="facturacion-anual">
                                <span>X</span>
                            </div>
                    @endif  

                        @if($poliza->cuotas === "mensual")
                            <div class="cuotas-mensual">
                                <span>X</span>
                            </div>
                        @elseif($poliza->cuotas === "trimestral")    
                            <div class="cuotas-trimestral">
                                <span>X</span>
                            </div>
                        @elseif($poliza->cuotas === "cuatrimestral")    
                            <div class="cuotas-cuatrimestral">
                                <span>X</span>
                            </div>
                        @elseif($poliza->cuotas === "semestral")    
                            <div class="cuotas-semestral">
                                <span>X</span>
                            </div>
                        @elseif($poliza->cuotas === "anual")                                                                         
                            <div class="cuotas-anual">
                                <span>X</span>
                            </div>
                        @endif

                    @foreach($beneficiarios->slice(0,5) as $beneficiario)            
                    <div class="capitalize beneficiario-nombre-{{$loop->index}}">
                        <span class="">{{\Illuminate\Support\Str::limit($beneficiario->nombre_beneficiario, 27, $end='...')}}</span>
                    </div>
                    <div class="capitalize beneficiario-parentesco-{{$loop->index}}">
                        <span class="">{{$beneficiario->parentesco_beneficiario}}</span>
                    </div>  
                    <div class="capitalize beneficiario-dni-{{$loop->index}}">
                        <span class="">{{$beneficiario->dni_beneficiario}}</span>
                    </div>         
                    <div class="capitalize beneficiario-prioridad-{{$loop->index}}">
                        <span class="">{{$beneficiario->prioridad_beneficiario}}</span>
                    </div>   
                    <div class="capitalize beneficiario-porcentaje-{{$loop->index}}">
                        <span class="">{{$beneficiario->porcentaje_beneficiario}}%</span>
                    </div>                                            
                    @endforeach                     
                                                                                                                                                                 
                </div>
                <div class="box">
                    <div class="page-break">
                        <img style="width:100%" src="images/pdf/2.png">

                        <div class="capitalize nombre-productor">
                            <span>{{\Illuminate\Support\Str::limit($productor->nombre_productor, 38, $end='...')}}</span>
                        </div>                          
                        <div class="capitalize codigo-productor">
                            <span>{{$productor->codigo}}</span>
                        </div>

                        <img class="imagen-firma" style="width:50%" src="{{$asegurable->firma}}">                   

                    </div>
                </div>
            </div>
        </body>
    </html>