public function index()
{
    $kontrakans = [
        [
            'nama' => 'Kontrakan Pak Riko',
            'alamat' => 'Bogor',
            'harga' => 1500000
        ],
    ];

    return view('kontrakan.index', compact('kontrakans'));
}