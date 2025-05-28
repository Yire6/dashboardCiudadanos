<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
 
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 4px; border: 1px solid #666; }
    th { background: #f0f0f0; }
  </style>
</head>
<body>
  <h1>Reporte de Ciudades</h1>
  <table>
    <thead>
      <tr>
        <th>Ciudad</th>
        <th># Ciudadanos</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cities as $city)
        <tr>
          <td>{{ $city->name }}</td>
          <td>{{ $city->citizens_count }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
