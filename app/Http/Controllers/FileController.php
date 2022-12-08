<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\File;
use App\Models\Group;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // upload a file
    public function upload(Request $request, $group_id){
        $request->validate([
            'src' => 'required',
            'title' => 'required',
        ]);
        

        if ($request->src->isValid()) {
            
            $filename = time().'_'.$request->src->getClientOriginalName();

            $group = Group::find($group_id);

            $src = $request->src->storeAs('public/files/classe/'.$group->classe->id.'/group'.'/'.$group_id.'/'.$request->title, $filename);
            
            File::create([
                'title' => $request->title,
                'src' => $src,
                'group_id' => $group_id
            ]);

            return redirect()->back()->with('success', 'Fichier ajouté avec succès..');

        }else {
            return redirect()->back()->with('fail', 'Fichier invalide..');
        }
        
    }

    // download a file
    public function download($id, $group_id){
        // i invert the id and group_id because i want to use the group_id as a parameter in the route
        $file = File::find($group_id);

        Download::create([
            'file_id' => $group_id,
            'user_id' => auth()->user()->id,
        ]);

        return response()->download(storage_path('app/'.$file->src));
    }
}
