<!DOCTYPE html>
<html>
<head>
<style>
* {
    font-family: sans-serif;
}
#customers {
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid black;
  padding: 8px;
}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  color: black;
}
#header {
  margin: 20px 0;
  text-align: center;
}
.id-mesin {
  margin: 10px 0;
}
#document-title {
  font-size: 14pt; font-weight: 700;
}
#header-extra {
  font-size: 10pt;
}
</style>
</head>
<body>
<div id="header">
  <div id="document-title">REPORT PRODUKSI CANGKANG TELUR</div>
  <div id="header-extra" class="id-mesin">ID Mesin: {{ $data["machineid"] }}</div>
  <div id="header-extra">Di export pada: {{ now()->setTimezone("Asia/Jakarta")->locale("id")->isoFormat("dddd[,] D MMMM YYYY HH[:]mm[:]ss") }}</div>
</div>

<table id="customers">
  <tr>
    <th style="text-align: center">Berat (Gram)</th>
    <th style="text-align: center">Waktu Produksi</th>
  </tr>
  @foreach ($data["stats"] as $each)
    <tr>
        <td style="text-align: center">{{ $each->weight }} gr</td>
        <td style="text-align: center">{{ $each->created_at }}</td>
    </tr>
  @endforeach
</table>

</body>
</html>