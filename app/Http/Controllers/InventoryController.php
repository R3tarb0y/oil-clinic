<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $inventories = Inventory::where('nama', 'LIKE', "%$keyword%")
            ->orWhere('jenis', 'LIKE', "%$keyword%")
            ->orWhere('kategori', 'LIKE', "%$keyword%")
            ->orWhere('jumlah', 'LIKE', "%$keyword%")
            ->orWhere('status', 'LIKE', "%$keyword%")
            ->get();

        return view('inventories.index', ['inventories' => $inventories, 'keyword' => $keyword]);
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer',
            'status' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk gambar
        ]);

        $inventory = new Inventory;
        $inventory->nama = $request->nama;
        $inventory->jenis = $request->jenis;
        $inventory->kategori = $request->kategori;
        $inventory->jumlah = $request->jumlah;
        $inventory->status = $request->status;

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/gambar');
            $inventory->gambar = $gambarPath;
        }

        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Inventory created successfully.');
    }


    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'nama' => 'required|string',
            'jenis' => 'required|string',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer',
            'status' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Menambah validasi untuk gambar
        ]);

        $data = $request->all();

        // Handle image update
        if ($request->hasFile('gambar')) {
            // Delete existing image
            Storage::disk('public')->delete($inventory->gambar);

            $imagePath = $request->file('gambar')->store('gambar_inventory', 'public');
            $data['gambar'] = $imagePath;
        }

        $inventory->update($data);

        return redirect()->route('inventories.index')
            ->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        // Delete the image if it exists
        if ($inventory->gambar) {
            Storage::disk('public')->delete($inventory->gambar);
        }

        $inventory->delete();

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory deleted successfully.');
    }

    public function generateBarcode($id)
    {
        $inventory = Inventory::find($id);

        // Generate barcode menggunakan library milon/barcode (misalnya, barcode128)
        $barcodeData = 'INV-'.$inventory->id; // Misalnya, format barcode INV-1
        $barcodePath = public_path('barcodes/'.$inventory->id.'.png');

        $barcode = DNS1D::getBarcodePNG($barcodeData, 'C128', 2, 40);

        // Simpan barcode di public/barcodes
        file_put_contents($barcodePath, $barcode);

        return redirect()->route('inventories.index')->with('success', 'Barcode berhasil di-generate dan disimpan.');
    }

    public function printBarcode($id)
    {
        $inventory = Inventory::find($id);

        // Generate barcode menggunakan library milon/barcode (misalnya, barcode128)
        $barcodeData = 'INV-'.$inventory->id; // Misalnya, format barcode INV-1
        $barcodePath = public_path('barcodes/'.$inventory->id.'.png');

        $barcode = DNS1D::getBarcodePNG($barcodeData, 'C128', 2, 40);

        // Simpan barcode di public/barcodes
        file_put_contents($barcodePath, $barcode);

        // Menggunakan fungsi header() untuk mengirimkan gambar sebagai respons
        header('Content-Type: image/png');
        readfile($barcodePath);
    }
}
