<?php

namespace App\Http\Controllers\props;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\prop\Property;
use Illuminate\Validation\Rule;
use App\Models\prop\PropImage;
use App\Models\prop\AgentRequest;
use App\Models\prop\Request as PropRequest;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{
    public function index()
    {
        $props = Property::select()->take(9)->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('index', compact('props'));
    }


    public function single($id)
    {
        $singleProp = Property::find($id);

        $propImages = PropImage::where('prop_id', $id)->get();

        //select related properties (exclude the current property)
        $relatedProp = Property::select()->take(3)
            ->where('id', '!=', $singleProp->id)
            ->where('home_type', $singleProp->home_type)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('props.single', compact('singleProp', 'propImages', 'relatedProp'));
    }

    public function insertRequests(Request $request)
    {
        $insertRequest = $request->validate([
            'prop_id' => 'required',
            'agent_name' => 'required',
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
        ]);

        $insertRequest = $request->validate([
            'prop_id' => 'required', $request->prop_id,
            'agent_name' => 'required', $request->prop_id,
            'name' => 'required', $request->name,
            'email' => ['required', 'email'], $request->email,
            'phone' => 'required', $request->phone,
        ]);

        AgentRequest::create($insertRequest);

        return back()->with('message', 'Request created successfully!');
    }
}
