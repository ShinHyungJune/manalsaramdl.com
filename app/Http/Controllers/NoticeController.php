<?php

namespace App\Http\Controllers\Shopping;

use App\Enums\FaqType;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoticeResource;
use App\Models\Faq;
use App\Models\Notice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "word" => "nullable|string|max:500"
        ]);

        $notices = new Notice();

        if($request->word)
            $notices = $notices->where("title", "LIKE", "%".$request->word."%")
                ->orWhere("description", "LIKE", "%".$request->word."%");

        $notices = $notices->orderBy("important", "desc")->paginate(10);

        return Inertia::render("Shopping/Notices/Index", [
            "notices" => NoticeResource::collection($notices),
            "word" => $request->word
        ]);
    }
}
