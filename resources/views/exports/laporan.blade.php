<table>
    <thead>
    <tr>
        <th>Tupoksi</th>
        <th>Durasi</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $pekerjaan)
        <tr>
            <td><b>{{ $pekerjaan->nama }}</b></td>
        </tr>
        @foreach($pekerjaan->subPekerjaan as $subpekerjaan)
        <tr>
            <td>{{ $subpekerjaan->nama }}</td>
            <td>{{ $subpekerjaan->durasi }}</td>
            <td>{{ $subpekerjaan->tanggal }}</td>
        </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
