<?php

namespace App\Http\Controllers;

use App\Enums\AlarmType;
use App\Enums\ChatType;
use App\Enums\MessageType;
use App\Events\ChatEnter;
use App\Events\ChatLeave;
use App\Events\ChatUpdated;
use App\Events\MessageCleared;
use App\Events\MessageCreated;
use App\Http\Resources\ChatMiniResource;
use App\Http\Resources\ChatResource;
use App\Http\Resources\FollowingToUserResource;
use App\Http\Resources\FollowResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserMiniResource;
use App\Http\Resources\UserResource;
use App\Models\Alarm;
use App\Models\Chat;
use App\Models\Dating;
use App\Models\Invitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function show(Dating $dating)
    {
        $chat = Chat::where("dating_id", $dating->id)->first();

        if(!$chat){
            $chat = Chat::create([
                "dating_id" => $dating->id
            ]);

            $chat->users()->attach($dating->women->id);
            $chat->users()->attach($dating->men->id);
        }

        $chat->users()->updateExistingPivot(auth()->id(), [
            "has_new_message" => 0
        ]);

        $messages = $chat->messages()->orderBy("created_at", "asc")->paginate(300);

        return Inertia::render("Chats/Show", [
            "chat" => ChatResource::make($chat),
            "messages" => MessageResource::collection($messages),
        ]);
    }
}
