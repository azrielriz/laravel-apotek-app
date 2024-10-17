<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
class Medicinecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //mengambil data medicines
        //mengambil semua data : naman  model ::all()
        //namamodel sesuiakan dengan data apa yang mau diambil
        $medicine = Medicine::where('name','LIKE','%'.$request->search.'%')->orderBy('name','ASC')->simplePaginate(5);
        //compact : mengirim data ke blade :compact('namavariabel')
        return view('medicine.index', compact('medicine'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data agar pengguna mengisi input from ga asal asalan.required : wajib diisi input yang mana nya itu
        $request->validate([
            'type'=>'required',
            'name'=>'required|min:5|max:15',
            'price'=>'required|numeric',
            'stock'=>'required'
        ], [
            'type.required'=>'jenis obat wajib diisi',
            'name.required'=>'nama obat wajib diisi',
            'name.min'=>'nama obat minimal 5 karakter',
            'name.max'=>'nama obat maximal 15 karakter',
            'price.required'=>'harga obat wajib diisi',
            'price.numeric'=>'harga obat harus berupa angka',
            'stock.required'=>'stock obat wajib diisi'
        ]);
        // validasi required berguna agar tidak boleh kosong/harus berisi
        //mebambahkan data ke database
        // 'name_field_migration =>$request->name_input_form
        $proses = Medicine::create([
            'type'=>$request->type,
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock
        ]);

        if ($proses) {
            return redirect()->route('medicine')->with('success','data obat berhasil ditambahkan');
        } else {
            return redirect()->route('medicine.add')->with('failed','gagal menambahkan data obat');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medicine = Medicine::where('id', $id)->first();
        return view(view: 'medicine.edit', data: compact(var_name:'medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'type'=>'required',
            'name'=>'required|min:5|max:15',
            'price'=>'required|numeric',
            'stock'=>'required'
        ], [
            'type.required'=>'jenis obat wajib diisi',
            'name.required'=>'nama obat wajib diisi',
            'name.min'=>'nama obat minimal 5 karakter',
            'name.max'=>'nama obat maximal 15 karakter',
            'price.required'=>'harga obat wajib diisi',
            'price.numeric'=>'harga obat harus berupa angka',
            'stock.required'=>'stock obat wajib diisi'
        ]);
        // validasi required berguna agar tidak boleh kosong/harus berisi
        //mebambahkan data ke database
        // 'name_field_migration =>$request->name_input_form
        // $proses = Medicine::create([
        //     'type'=>$request->type,
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        //     'stock'=>$request->stock
        // ]);

        $medicineBefore = Medicine::where('id',$id)->first();

        if((int)$request->stock < (int)$medicineBefore->stock ){
            return redirect()->back()->with('failed', 'stock baru tidak boelh kurang dari stock sebelumnya');
        }

        $proses = $medicineBefore->update([
            'type' => $request -> type,
            'name' => $request -> name,
            'price' => $request -> price,
            'stock' => $request -> stock
           
            
        ]);

        if ($proses) {
            return redirect()->route('medicine')->with('success','data obat berhasil dirubah');
        } else {
            return redirect()->route('medicine.add')->with('failed','gagal merubah data obat');
        }
    }

    public function stockEdit(Request $request, $id)
    {
        // if(!isset($Request->stock )){
        //     return response()->json(['failed'=>'stock tidak boleh kosong'],400);
        // }
        $medicine = Medicine::findOrFail(id: $id);
        $medicine->stock = $request->input('stock');
        $medicine->save();
        return response()->json(['success' => 'stok berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = Medicine::where('id',$id)->delete();
        if ($proses) {
            return redirect()->back()->with('success','data obat berhasil dihapus!');
        } else {
            return redirect()->bcak()->with('failed', 'gagal menghapus data obat!');
        }
        
        //
    }
}
