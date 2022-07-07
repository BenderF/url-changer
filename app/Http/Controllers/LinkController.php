<?php

namespace App\Http\Controllers;

use App\LinkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function createLink(Request $request)
    {
        try {
            $link = new LinkModel();
            $link->name = $request->get('name');
            $link->link = $request->get('link');
            $link->max_uses = $request->get('max_uses');
            $link->limit_date = $request->get('limit_date');
            $link->save();

            return $link;
        } catch (\Throwable $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function getLink($name)
    {
        try {
            $validateUse = LinkModel::where('name', '=', $name)->first()->max_uses;
            $validateDate = LinkModel::where('name', '=', $name)->first()->limit_date;

            if ($validateUse > 0 && $validateDate < date('Y-m-d')) {
                $link = LinkModel::where('name', '=', $name)->first()->link;
                DB::table('links')->where('name', $name)->update(['max_uses' => $validateUse-1]);
                return redirect($link);
            } else {
                return redirect(LinkModel::where('name', '=', 'default')->first()->link);
            }
        } catch (\Throwable $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    public function listLinks()
    {
        return LinkModel::all();
    }

    public function editLink(Request $request)
    {
        $name = $request->get('name');

        $teste = DB::table('links')->where('name', '=', $name)->update([
            'name' => $request->get('newName'),
            'link' => $request->get('link'),
            'max_uses' => $request->get('max_uses'),
            'limit_date' => $request->get('limit_date')
        ]);
        return $teste;
    }
}
