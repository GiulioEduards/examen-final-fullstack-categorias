<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Categoria::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categoria',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error de validación',
                'errores' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['destacada'] = $request->boolean('destacada');
        $data['slug'] = Str::slug($request->nombre);

        if ($request->hasFile('image')) {
            $imageName = Str::uuid() . '.' . $request->imagen->extension();
            $imagePath = $request->file('image')->storeAs('categoria', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $categoria = Categoria::create($data);

        return response()->json([
            'mensaje' => 'Categoría creada exitosamente',
            'data' => $categoria
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::with('productos')->find($id);

        if (!$categoria) {
            return response()->json([
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        return response()->json([
            'data' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:categoria,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Error de validación',
                'errores' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->has('name')) {
            $data['slug'] = Str::slug($request->nombre);
        }

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($categoria->imagen) {
                Storage::disk('public')->delete($categoria->imagen);
            }

            $imageName = Str::uuid() . '.' . $request->imagen->extension();
            $imagePath = $request->file('image')->storeAs('categoria', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $categoria->update($data);

        return response()->json([
            'mensaje' => 'Categoría actualizada correctamente',
            'data' => $categoria->fresh()
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        // Verificar si tiene productos asociados
        // if ($categoria->productos()->exists()) {
        //     return response()->json([
        //         'mensaje' => 'No se puede eliminar la categoría porque tiene productos asociados'
        //     ], 409);
        // }

        // Eliminar imagen asociada si existe
        if ($categoria->imagen) {
            Storage::disk('public')->delete($categoria->imagen);
        }

        $categoria->delete();

        return response()->json([
            'mensaje' => 'Categoría eliminada correctamente'
        ]);
    }
}
