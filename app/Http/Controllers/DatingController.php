<?php

namespace App\Http\Controllers;

use App\Enums\Sex;
use App\Http\Resources\DatingResource;
use App\Models\Dating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DatingController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "state" => "nullable|string|max:500"
        ]);

        $request["state"] = $request->state ?? "진행중";

        $datings = auth()->user()->datings()->latest();

        if($request->state == "진행중")
            $datings = $datings->where("scheduled_at", ">", Carbon::now())->orWhere("scheduled_at", null);

        if($request->state == "완료")
            $datings = $datings->where("scheduled_at", "<=", Carbon::now())->where("scheduled_at", "!=", null);

        $datings = $datings->paginate(60);

        $latestUnreadDating = auth()->user()->datings()->latest()->where(auth()->user()->getReadColumn(), false)->first();

        return Inertia::render("Datings/Index", [
            "state" => $request->state,
            "datings" => DatingResource::collection($datings),
            "latestUnreadDating" => $latestUnreadDating ? DatingResource::make($latestUnreadDating) : "",
        ]);
    }

    public function read(Dating $dating)
    {
        $dating = auth()->user()->datings()->find($dating->id);

        if($dating)
            $dating->update([
                auth()->user()->getReadColumn() => 1
            ]);

        return redirect()->back()->with("success", "");
    }
}
