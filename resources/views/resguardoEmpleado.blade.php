<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>RESGUARDO</title>
        <style>
        table, tr, th, td{
        border: 1px solid #000000;
        text-align: center;
            }
        #titulo{
          position: fixed;
          font-size: 24px;
          right: 50px;
        }
        #fondo{
          position: fixed;
          width: 600px;
          height: 300px;
          right: 60px;
          top: 350px;
          opacity: 0.1;
        }
        #imageEmpleado
        {
          position: fixed;
          width: 150px;
          height: 180px;
          top: 185px;
          right: 1px;
        }
        #logoMatrix{
          position: fixed;
          width: 150px;
          height: 60px;
        }
        #encabezado{
          width: 250px;
          height: 120px;
          position: fixed;
          right: -45px;
          top: -45px;
          }
          #pieFoto{
          width: 400px;
          height: 180px;
          position: fixed;
          bottom: -45px;
          left: -45px;
          }
          #hr1{
            position: relative;
            height: 1px;
            background-color: red;
            top:57px;
        }
        #fecha{
        position: relative;
        text-align: center;
        top:55px;
        font-family: sans-serif;
        }
        .contenido{
        position: relative;
        font-size: 14px;
        line-height : 18px;
        text-align: justify;
        margin: 120px 37px;
        top: -70px;
        margin-bottom: -35px;
        font-family: sans-serif;
        }
        #p01{
        position: relative;
        top: -10px; 
        margin-right: 150px;
        font-size: 12px;
        }
        #p37{
          position: relative;
          top: -10px;
          text-align: center;
          font-weight: bold;
          font-size: 20px;
        }
        #p38{
          position: relative;
          top: 2px;
          text-align: center;
          font-weight: bold;
          font-size: 20px;
        }
        #tableResguardo{
          position: relative;
          align-items: center;
          top: -10px;
        }
        #campoTable{
          font-size: 12px;
        }
        #pieDocumento{
          font-size: 9px;
        }
        #pnombrefirma{
          position: relative;
          top: -10px;
          text-align: center;
          font-weight: bold;
          font-size: 20px;
        }
        #p43{
          position: relative;
          margin-top: 15px;
          margin-right: 60%;
          font-size: 13px;
          text-align: center;
        }
        #p44{
          position: relative;
          margin-top: -50px;
          margin-left: 60%;
          font-size: 13px;
          text-align: center;
        }
        #hr2{
          height: .5px;
          background-color: black;
          margin-top: 5px;
          margin-left: 60%;
          margin-right: 1%;
        }
        #hr3{
          height: .5px;
          background-color: black;
          margin-top: -10px;
          margin-left: 1%;
          margin-right: 60%;
        }
        #p39{
          position: relative;
          margin-top: -5px;
          margin-left: 15%;
          font-weight: bold;
        }
        #p40{
          position: relative;
          margin-top: -35px;
          margin-left: 73%;
          font-weight: bold;
        }
        #hr4{
          height: .5px;
          background-color: black;
          margin-top: 110px;
          margin-left: 60%;
          margin-right: 1%;
        }
        #hr5{
          height: .5px;
          background-color: black;
          margin-top: -10px;
          margin-left: 1%;
          margin-right: 60%;
        }
        #p41{
          position: relative;
          margin-top: -5px;
          margin-left: 7%;
          font-weight: bold;
        }
        #p42{
          position: relative;
          margin-top: -35px;
          margin-left: 73%;
          font-weight: bold;
        }
    </style>
    </head>
    <body>
        <img src="images/Contratos/logo.png" id="logoMatrix" >
        <img src="images/Contratos/encabezado.png" id="encabezado" >
        <img src="images/Contratos/pieFoto.png" id="pieFoto" >
        <img src="images/Contratos/logo.png" id="fondo" >
        <h1 id="titulo">RESGUARDO DE EQUIPOS DE COMPUTO</h1>
        <hr id="hr1">
        <p id="fecha">
            Tuxtla Gutiérrez, Chiapas a <b>{{ $fecha }}</b>
        </p>
        <div class="contenido">
          <img src="http://186.96.33.206:8080/{{$fotoEmpleado}}" id="imageEmpleado" >
          
            <p id="p38">
            E M P L E A D O
            </p>
            <p id="p01">
            NIP: <b><u>{{ $nip }}</u></b>                 Empleado: <b><u>{{ strtoupper($empleado) }}</u></b>
            </p>
            <p id="p01">
            Dirección: <b><u>{{ strtoupper($direccion) }}</u></b>
            </p>
            <p id="p01">
            Celular: <b>{{ $telefono }}</b> UDN: <b><u>{{ strtoupper($nameSucursal) }}</u></b>           
            </p>
            <p id="p01">
            Departamento: <b><u>{{ strtoupper($nameDepartamento) }}</u></b>              Puesto: <b><u>{{ strtoupper($namePuesto) }}</u></b>
            </p>
            <p id="p37">
            R E S G U A R D O S
            </p>
            <table id="tableResguardo">
              <thead>
                  <tr>
                      <th> #</th>
                      <th> Equipo</th>
                      <th> Marca  </th>
                      <th> Modelo </th>
                      <th> Serie </th>
                      <th> Fecha </th>
                      <th> Estado </th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($resguardos as $resguardo)
                    <tr>
                        <td id="campoTable" style="width:20px ;"> {{$resguardo->id}} </td>
                        <td id="campoTable"> {{$resguardo->equipo}} </td>
                        <td id="campoTable"> {{$resguardo->marca}} </td>
                        <td id="campoTable"> {{$resguardo->modelo}} </td>
                        <td id="campoTable"> {{$resguardo->serie}} </td>
                        <td id="campoTable" style="width:70px ;"> {{$resguardo->fecha}} </td>
                        <td id="campoTable" style="width:40px ;"> {{$resguardo->estado}} </td>
                    </tr>
                  @endforeach
            </tbody>
          </table>

            <p id="pnombrefirma">
            NOMBRE Y FIRMAS
            </p>
            <p id="p43">
            {{ strtoupper($admin) }}
            </p>
            <p id="p44">
            {{ strtoupper($empleado) }}
            </p>
            <hr id="hr2">
            <hr id="hr3">
            <p id="p39">
            ÁREA DE T.I.
            </p>
            <p id="p40">
            EMPLEADO
            </p>
            <p id="pieDocumento">
              Certifico que tengo a mi resguardo los equipos de computo que aparecen en la tabla, los cuales serán utilizados exclusivamente para las actividades 
              de la empresa, haciéndome responsable de notificar oportunamente al Departamento de T.I., todos los servicios preventivos y/o correctivos que se requieran, 
              así mismo me responsabilizo de no prestar el equipo a ninguna persona, ya que ante cualquier irregularidad soy responsable económicamente.
              En caso de robo o mal uso del equipo notificaré de inmediato al departamento de T.I., y me haré responsable de los costos que esto conlleve. 
              La firma de este documento <b>CANCELA</b> cualquier resguardo anterior a la fecha de su firma
            </p>
          </div>
            <!--<p style="page-break-before: always;"></p>
            <hr id="hr1">
            <p id="fecha">
                Tuxtla Gutiérrez, Chiapas a <b>{{ $fecha }}</b>
            </p>
            <div class="contenido">
              <p id="p38">
                <b><u>A N E X O S</u></b>
              </p>
            <?php 
            $array = array();
            foreach ($resguardos as $resguardo) 
            {
              $dir_path = "images/resguardos/".$resguardo->id."/";
              $extensions_array = array('jpg','png','jpeg');
              //echo "File Name -> $dir_path<br>";
              if(is_dir($dir_path))
              {
                  $files = scandir($dir_path);
                  for($i = 0; $i < count($files); $i++)
                  {
                      if($files[$i] !='.' && $files[$i] !='..')
                      {
                          // get file name
                          echo "Equipo: #$resguardo->id $resguardo->equipo<br>";
                          
                          // get file extension
                          $file = pathinfo($files[$i]);
                          $extension = $file['extension'];
                          
                        // check file extension
                          if(in_array($extension, $extensions_array))
                          {
                          // show image
                          echo "<img src='$dir_path$files[$i]' style='width:300px;height:300px;'><br>";
                          //array_push($array, $dir_path.$files[$i]);
                          }
                      }
                  }
              }
            }
          ?>
        </div>
          -->
    </body>
</html>