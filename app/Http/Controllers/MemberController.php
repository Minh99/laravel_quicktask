<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->input('name');
        $newMember = new Member();
        $newMember->name = ucwords($name);
        if (!$newMember->save()) {

            return back()->withInput()->with('status', trans('insertFaileMember'));
        }

        return back()->withInput()->with('status', trans('insertSuccessMember'));
    }

    public function delete($id_member)
    {
        $member = Member::find($id_member);
        if (!$member->delete()) {
            
            return back()->withInput()->with('status', trans('deleteFaileMember'));
        }

        return back()->withInput()->with('status', trans('deleteSuccessMember'));;
    }
}
