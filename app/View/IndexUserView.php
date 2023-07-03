<div>
  <h1>Homeview de usuarios</h1>
  <p>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis expedita, quibusdam distinctio dolor soluta placeat ipsum nesciunt consectetur tenetur harum iste. Expedita ab itaque amet animi qui accusantium totam distinctio?
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptatum itaque, asperiores minima iusto, odit quam omnis commodi nihil similique quidem obcaecati culpa? Rem nisi, perferendis omnis doloribus voluptatem quod.
  </p>
  <p>
    <a href="http://localhost/php3a/?c=UserController&m=CallFormAdd">Agregar nuevo usurio</a>
  </p>
  <br>
  <table border=1>
    <thead>
      <tr><td>Nombre</td>
      <td>A Paterno</td>
      <td>A Materno</td>
      <td>Usuario</td>
      <td>Acciones</td>
      </tr>
    </thead>
    <tbody>
      <?php
       foreach($datos as $dato){
        echo "<tr>";
        echo "<td>" . $dato['Nombre'] ."</td>";
        echo "<td>" . $dato['ApPaterno'] ."</td>";
        echo "<td>" . $dato['ApMaterno'] ."</td>";
        echo "<td>" . $dato['Usuario'] ."</td>";
        echo "<td> <a href=''> Editar </a><br><a href=''> Eliminar </a>  </td>";
        echo "</tr>";
       }
      ?>
    </tbody>
  </table>

  
</div>
